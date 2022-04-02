<?php

namespace App\Event\Presupuesto;

use App\Entity\Presupuesto;

class PresupuestoSolicitadoEvent extends PresupuestoEvent
{
    public const NAME = 'presupuesto.solicitado';
    protected Presupuesto $presupuesto;

    public function __construct(Presupuesto $presupuesto) {
        $this->presupuesto = $presupuesto;
    }

    public function getPresupuesto(): Presupuesto {
        return $this->presupuesto;
    }
}