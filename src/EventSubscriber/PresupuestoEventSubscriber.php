<?php

namespace App\EventSubscriber;

use App\Event\Presupuesto\PresupuestoAprobadoEvent;
use App\Event\Presupuesto\PresupuestoSolicitadoEvent;
use App\Services\EmailService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PresupuestoEventSubscriber implements EventSubscriberInterface
{
    private EmailService $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public static function getSubscribedEvents() : array
    {
        return [
            PresupuestoSolicitadoEvent::NAME => [
                ['onPresupuestoSolicitado', 10]
            ],
            PresupuestoAprobadoEvent::NAME => [
                ['onPresupuestoAprobado', 10]
            ]
        ];
    }

    public function onPresupuestoSolicitado(PresupuestoSolicitadoEvent $event) : void
    {
        $presupuesto = $event->getPresupuesto();
        $this->emailService->enviarCorreosSolicitudPresupuesto($presupuesto);
    }

    public function onPresupuestoAprobado(PresupuestoAprobadoEvent $event) : void
    {
        $presupuesto = $event->getPresupuesto();
        $this->emailService->enviarCorreosPresupuestoAprobado($presupuesto);
    }
}
