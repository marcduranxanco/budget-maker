<?php

namespace App\Controller;

use App\Entity\Tarea;
use App\Event\Tarea\TareaEvent;
use App\EventSubscriber\TareaEventSubscriber;
use App\Form\TareaType;
use App\Repository\TareaRepository;
use App\Services\EmailService;
use Psr\EventDispatcher\EventDispatcherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tarea")
 * @Security("is_granted('ROLE_EMPLEADO', 'ROLE_JEFEPROYECTO')")
 */
class TareaController extends AbstractController
{
    private EventDispatcherInterface $eventDispatcher;
    private EmailService $emailService;

    public function __construct(EventDispatcherInterface $eventDispatcher, EmailService $emailService)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->emailService = $emailService;
    }

    /**
     * @Route("/", name="app_tarea_index", methods={"GET"})
     */
    public function index(TareaRepository $tareaRepository): Response
    {
        return $this->render('tarea/index.html.twig', [
            'tareas' => $tareaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_tarea_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TareaRepository $tareaRepository): Response
    {
        $tarea = new Tarea();
        $form = $this->createForm(TareaType::class, $tarea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tareaRepository->add($tarea);
            $this->dispatchEvents($tarea);
            return $this->redirectToRoute('app_tarea_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tarea/new.html.twig', [
            'tarea' => $tarea,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_tarea_show", methods={"GET"})
     */
    public function show(Tarea $tarea): Response
    {
        return $this->render('tarea/show.html.twig', [
            'tarea' => $tarea,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_tarea_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Tarea $tarea, TareaRepository $tareaRepository): Response
    {
        $form = $this->createForm(TareaType::class, $tarea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tareaRepository->add($tarea);
            $this->dispatchEvents($tarea);
            return $this->redirectToRoute('app_tarea_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tarea/edit.html.twig', [
            'tarea' => $tarea,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_tarea_delete", methods={"POST"})
     */
    public function delete(Request $request, Tarea $tarea, TareaRepository $tareaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tarea->getId(), $request->request->get('_token'))) {
            $tareaRepository->remove($tarea);
        }

        return $this->redirectToRoute('app_tarea_index', [], Response::HTTP_SEE_OTHER);
    }

    private function dispatchEvents(Tarea $tarea): void
    {
        $event = new TareaEvent($tarea);
        $this->eventDispatcher->addSubscriber(new TareaEventSubscriber($this->emailService));
        if(null !== $tarea->getUser()){
            $this->eventDispatcher->dispatch($event, TareaEvent::ASIGNAR_TECNICO);
        }
        if($tarea->getEstado() == Tarea::TAREA_STATE['Terminada']){
            $this->eventDispatcher->dispatch($event, TareaEvent::TAREA_TERMINADA);
        }
    }
}
