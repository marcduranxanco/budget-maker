<?php

namespace App\Tests\src\Event;

use App\Event\Presupuesto\PresupuestoSolicitadoEvent;
use App\Presupuesto\SolicitudPresupuesto;
use PHPUnit\Framework\TestCase;

class PresupuestoSolicitadoEventTest extends TestCase
{
    private PresupuestoSolicitadoEvent $presupuestoSolicitadoEvent;
    private SolicitudPresupuesto $solicitudPresupuesto;

    protected function setUp(): void
    {
        $this->solicitudPresupuesto = new SolicitudPresupuesto();
        $this->presupuestoSolicitadoEvent = new \App\Event\Presupuesto\PresupuestoSolicitadoEvent($this->solicitudPresupuesto);
    }

    public function testGetPresupuesto(): void
    {
        $this->setUp();
        $this->assertEquals($this->presupuestoSolicitadoEvent->getPresupuesto(), $this->solicitudPresupuesto);
    }
}
