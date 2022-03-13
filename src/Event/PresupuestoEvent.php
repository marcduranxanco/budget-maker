<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

abstract class PresupuestoEvent extends Event
{
    protected $presupuesto;

    public function __construct($presupuesto)
    {
        $this->presupuesto = $presupuesto;
    }

    public function getPresupuesto()
    {
        return $this->presupuesto;
    }
}