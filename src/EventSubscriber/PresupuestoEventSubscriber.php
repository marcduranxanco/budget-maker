<?php

namespace App\EventSubscriber;

use App\Entity\Proyecto;
use App\Event\Presupuesto\PresupuestoAprobadoEvent;
use App\Event\Presupuesto\PresupuestoSolicitadoEvent;
use App\Services\EmailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PresupuestoEventSubscriber implements EventSubscriberInterface
{
    private EmailService $emailService;
    private EntityManagerInterface $entityManager;

    public function __construct(EmailService $emailService, EntityManagerInterface $entityManager)
    {
        $this->emailService = $emailService;
        $this->entityManager = $entityManager;
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

        $proyecto = new Proyecto();
        $proyecto->setPresupuesto($presupuesto);
        $fechaEntrega = new \DateTime();
        $fechaEntrega->modify('+1 year');
        $proyecto->setFechaEntrega($fechaEntrega);
        $this->entityManager->persist($proyecto);
        $this->entityManager->flush();
    }
}
