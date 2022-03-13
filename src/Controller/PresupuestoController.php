<?php

namespace App\Controller;

use App\Event\PresupuestoAprobadoEvent;
use App\Event\PresupuestoSolicitadoEvent;
use http\Env\Request;
use http\Env\Response;
use Psr\EventDispatcher\EventDispatcherInterface;

class PresupuestoController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
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