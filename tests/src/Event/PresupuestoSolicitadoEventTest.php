<?php

namespace App\Tests\src\Event;

use App\Event\PresupuestoSolicitadoEvent;
use App\Presupuesto\SolicitudPresupuesto;
use PHPUnit\Framework\TestCase;

class PresupuestoSolicitadoEventTest extends TestCase
{
    private PresupuestoSolicitadoEvent $presupuestoSolicitadoEvent;
    private SolicitudPresupuesto $solicitudPresupuesto;

    protected function setUp(): void
    {
        $this->solicitudPresupuesto = new SolicitudPresupuesto();
        $this->presupuestoSolicitadoEvent = new PresupuestoSolicitadoEvent($this->solicitudPresupuesto);
    }

    public function testGetPresupuesto(): void
    {
        $this->setUp();
        $this->assertEquals($this->presupuestoSolicitadoEvent->getPresupuesto(), $this->solicitudPresupuesto);
    }
}
