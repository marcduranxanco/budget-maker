<?php

namespace App\EventSubscriber;


use App\Event\Proyecto\ProyectoEvent;
use App\Services\EmailService;

class ProyectoEventSubscriber implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{

    private EmailService $emailService;

    /**
     * @param EmailService $emailService
     */
    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            ProyectoEvent::NAME_CAMBIO_ESTADO => [
                [ 'onProyectoCambioEstado', 10 ]
            ]
        ];
    }

    public function onProyectoCambioEstado(ProyectoEvent $event): void
    {
        $proyecto = $event->getProyecto();
        $this->emailService->enviarCorreosCambioEstadoProyecto($proyecto);
    }
}