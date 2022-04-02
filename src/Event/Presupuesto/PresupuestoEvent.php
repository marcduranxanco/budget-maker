<?php

namespace App\Event\Presupuesto;

use App\Entity\Presupuesto;
use Symfony\Contracts\EventDispatcher\Event;

abstract class PresupuestoEvent extends Event
{
    protected Presupuesto $presupuesto;

    public function __construct(Presupuesto $presupuesto)
    {
        $this->presupuesto = $presupuesto;
    }

    public function getPresupuesto(): ?Presupuesto
    {
        return $this->presupuesto;
    }
}