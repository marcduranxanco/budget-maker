<?php

namespace App\Controller;

use App\Entity\Proyecto;
use App\Entity\Tarea;
use App\Event\Proyecto\ProyectoEvent;
use App\EventSubscriber\ProyectoEventSubscriber;
use App\Form\ProyectoType;
use App\Repository\ProyectoRepository;
use App\Services\EmailService;
use Psr\EventDispatcher\EventDispatcherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/proyecto")
 * @Security("is_granted('ROLE_JEFEPROYECTO')")
 */
class ProyectoController extends AbstractController
{
    private EventDispatcherInterface $eventDispatcher;
    private EmailService $emailService;

    public function __construct(EventDispatcherInterface $eventDispatcher, EmailService $emailService)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->emailService = $emailService;
    }

    /**
     * @Route("/", name="app_proyecto_index", methods={"GET"})
     */
    public function index(ProyectoRepository $proyectoRepository): Response
    {
        return $this->render('proyecto/index.html.twig', [
            'proyectos' => $proyectoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_proyecto_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProyectoRepository $proyectoRepository): Response
    {
        $proyecto = new Proyecto();
        $form = $this->createForm(ProyectoType::class, $proyecto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $proyectoRepository->add($proyecto);
            return $this->redirectToRoute('app_proyecto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('proyecto/new.html.twig', [
            'proyecto' => $proyecto,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_proyecto_show", methods={"GET"})
     */
    public function show(Proyecto $proyecto): Response
    {
        return $this->render('proyecto/show.html.twig', [
            'proyecto' => $proyecto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_proyecto_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Proyecto $proyecto, ProyectoRepository $proyectoRepository): Response
    {
        $oldEstado = $proyecto->getEstado();
        $form = $this->createForm(ProyectoType::class, $proyecto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if(
                $proyecto->getEstado() == Proyecto::PROYECTO_STATE['Terminado'] &&
                !$this->canCloseProject($proyecto, $proyectoRepository)
            ){
                $this->addFlash('error', 'Este proyecto tiene tareas incompletas y no se puede cerrar todavía');
                return $this->renderForm('proyecto/edit.html.twig', [
                    'proyecto' => $proyecto,
                    'form' => $form,
                ]);
            };

            $proyectoRepository->add($proyecto);

            if($oldEstado !== $proyecto->getEstado())
            {
                $event = new ProyectoEvent($proyecto);
                $this->eventDispatcher->addSubscriber(new ProyectoEventSubscriber($this->emailService));
                $this->eventDispatcher->dispatch($event, ProyectoEvent::NAME_CAMBIO_ESTADO);
            }

            return $this->redirectToRoute('app_proyecto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('proyecto/edit.html.twig', [
            'proyecto' => $proyecto,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_proyecto_delete", methods={"POST"})
     */
    public function delete(Request $request, Proyecto $proyecto, ProyectoRepository $proyectoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$proyecto->getId(), $request->request->get('_token'))) {
            $proyectoRepository->remove($proyecto);
        }

        return $this->redirectToRoute('app_proyecto_index', [], Response::HTTP_SEE_OTHER);
    }

    private function canCloseProject(Proyecto $proyecto, ProyectoRepository $proyectoRepository)
    {
        $tareasPendientes = $proyectoRepository->getTareasPendientes($proyecto);

        foreach ($tareasPendientes as $value) {
            foreach ($value->getTareas() as $tarea) {
                if($tarea->getEstado() != Tarea::TAREA_STATE['Terminada']){
                    return false;
                }
            }
        }

        return true;
    }
}
