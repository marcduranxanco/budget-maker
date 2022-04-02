<?php

namespace App\EventSubscriber;

use App\Event\Tarea\TareaEvent;
use App\Services\EmailService;

class TareaEventSubscriber implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
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
            TareaEvent::ASIGNAR_TECNICO => ['onTecnicoAsignado', 10],
            TareaEvent::TAREA_TERMINADA => ['onTareaTerminada', 10]
        ];
    }

    public function onTecnicoAsignado(TareaEvent $event): void
    {
        $tarea = $event->getTarea();
        $this->emailService->enviarCorreosTareaAsignadaTecnico($tarea, $tarea->getUser());
    }

    public function onTareaTerminada(TareaEvent $event): void
    {
        $tarea = $event->getTarea();
        $this->emailService->enviarCorreosTareaTerminada($tarea);
    }
}