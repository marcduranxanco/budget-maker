<?php

namespace App\Controller;

use App\Entity\Presupuesto;
use App\Event\Presupuesto\PresupuestoAprobadoEvent;
use App\Event\Presupuesto\PresupuestoSolicitadoEvent;
use App\EventSubscriber\PresupuestoEventSubscriber;
use App\Form\PresupuestoType;
use App\Repository\PresupuestoRepository;
use App\Services\EmailService;
use Psr\EventDispatcher\EventDispatcherInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/presupuesto")
 */
class PresupuestoController extends AbstractController
{
    private EventDispatcherInterface $eventDispatcher;
    private EmailService $emailService;

    public function __construct(EventDispatcherInterface $eventDispatcher, EmailService $emailService)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->emailService = $emailService;
    }


    /**
     * @Route("/", name="app_presupuesto_index", methods={"GET"})
     * @Security("is_granted('ROLE_COMERCIAL')")
     */
    public function index(PresupuestoRepository $presupuestoRepository): Response
    {
        return $this->render('presupuesto/index.html.twig', [
            'presupuestos' => $presupuestoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_presupuesto_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PresupuestoRepository $presupuestoRepository): Response
    {
        $presupuesto = new Presupuesto();
        $form = $this->createForm(PresupuestoType::class, $presupuesto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $presupuestoRepository->add($presupuesto);

            $event = new PresupuestoSolicitadoEvent($presupuesto);
            $this->eventDispatcher->dispatch($event, PresupuestoSolicitadoEvent::NAME);

            return $this->redirectToRoute('index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('presupuesto/new.html.twig', [
            'presupuesto' => $presupuesto,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_presupuesto_show", methods={"GET"})
     * @Security("is_granted('ROLE_COMERCIAL')")
     */
    public function show(Presupuesto $presupuesto): Response
    {
        return $this->render('presupuesto/show.html.twig', [
            'presupuesto' => $presupuesto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_presupuesto_edit", methods={"GET", "POST"})
     * @Security("is_granted('ROLE_COMERCIAL')")
     */
    public function edit(Request $request, Presupuesto $presupuesto, PresupuestoRepository $presupuestoRepository): Response
    {
        $form = $this->createForm(PresupuestoType::class, $presupuesto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $presupuestoRepository->add($presupuesto);

            if($presupuesto->getEstado() === Presupuesto::PRESUPUESTO_STATES['Aprobado'])
            {
                $event = new PresupuestoAprobadoEvent($presupuesto);
                $this->eventDispatcher->addSubscriber(new PresupuestoEventSubscriber($this->emailService));
                $this->eventDispatcher->dispatch($event, PresupuestoAprobadoEvent::NAME);
            }

            return $this->redirectToRoute('app_presupuesto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('presupuesto/edit.html.twig', [
            'presupuesto' => $presupuesto,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_presupuesto_delete", methods={"POST"})
     * @Security("is_granted('ROLE_COMERCIAL')")
     */
    public function delete(Request $request, Presupuesto $presupuesto, PresupuestoRepository $presupuestoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$presupuesto->getId(), $request->request->get('_token'))) {
            $presupuestoRepository->remove($presupuesto);
        }

        return $this->redirectToRoute('app_presupuesto_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * Esqueleto del controlador de presupuesto
     * Creado para iniciar los siguiente eventos:
     *  - 1) al crear un presupuesto: 'onPresupuestoSolicitado'
     *      - Llama al método o métodos de envío de correo definidos en los servicios del ejercicio 8.2
     *  - 2) 'onPresupuestoAprobado'
     *      - Llame al método o métodos de envío de correo definidos en los servicios del ejercicio 8.2
     */

    /*
     * Método de creación de presupuesto
     */
    public function nuevo(Request $request, EventDispatcherInterface $dispatcher) : Response
    {
        // TODO: Definición lógica de creación de presupuesto (Form, Api...)
        $presupuesto = ['id' => 1];

        // Cuando acaba correctamente la lógica de aprobación de un presupuesto se dispara el un
        // new PresupuestoSolicitadoEvent
        $event = new PresupuestoSolicitadoEvent($presupuesto);
        $dispatcher->dispatch($event, $event::NAME);

        return $this->json('Presupuesto solicitado ');
    }

    /*
     * Método de aprobación de presupuesto
     */
    public function aprobar(Request $request, EventDispatcherInterface $dispatcher) : Response
    {
        // TODO: Definición lógica de creación de presupuesto (Form, Api...)
        $presupuesto = ['id' => 1];

        // Cuando acaba correctamente la lógica de aprobación de un presupuesto se dispara el un
        // new PresupuestoAprobadoEvent
        $event = new PresupuestoAprobadoEvent($presupuesto);
        $dispatcher->dispatch($event, $event::NAME);

        return $this->json('Presupuesto aprobado');
    }
}
