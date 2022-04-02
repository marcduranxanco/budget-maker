<?php

namespace App\Services;

use App\Entity\Presupuesto;
use App\Entity\Proyecto;

/**
 * Servicio de gestión del envío de correos
 */
class EmailService
{
    /**
     * Envia los correos cuando hay una nueva solicitud de presupuesto
     * @param Presupuesto $presupuesto
     * @return bool
     */
    public function enviarCorreosSolicitudPresupuesto(Presupuesto $presupuesto): bool
    {
        $this->enviarCorreosSolicitudPresupuestoASolicitante($presupuesto);
        $this->enviarCorreosSolicitudPresupuestoAComerciales($presupuesto);
        return true;
    }

    /**
     * Envía un correo a los comerciales con la información de la nueva solicitud
     * Devuelve true si todo ha ido bien o false si no se ha podido enviar el correo
     */
    private function enviarCorreosSolicitudPresupuestoAComerciales(Presupuesto $presupuesto): bool
    {
        dump('Se envía el correo a los comerciales');
        return true;
    }

    /**
     * Envía un correo al solicitante del presupuesto indicando que se ha recibido la solicitud
     * Devuelve true si todo ha ido bien o false si no se ha podido enviar el correo
     */
    private function enviarCorreosSolicitudPresupuestoASolicitante(Presupuesto $presupuesto): bool
    {
        dump('Se envía el correo al solicitante');
        return true;
    }

    /**
     * Informa al solicitante que el presupuesto ha sido aprovado
     */
    public function enviarCorreosPresupuestoAprobado(Presupuesto $presupuesto): bool
    {
        dump('Se envía el correo al solicitante informando presupuesto aprobado');
        dump('Se envía el correo a los jefes de proyecto');
        return true;
    }

    /**
     * Envía un correo a las personas implicadas en una solicitud cuando esta cambia de estado
     * Devuelve true si todo ha ido bien o false si no se ha podido enviar el correo
     * @param SolicitudPresupuesto $solicitud
     * @return bool
     */
    public function enviarCorreosSolicitudCambioDeEstado(Presupuesto $presupuesto): bool
    {
        dump('Se envía el correo al solicitante informando el cmabio de estado');
        return true;
    }

    /**
     * Envía un correo a las personas implicadas en el presupuesto (comerial, solicitante)
     * indicando cambios de estado del presupuesto
     * Devuelve true si todo ha ido bien o false si no se ha podido enviar el correo
     */
    public function enviarCorreosPresupuestoCamioDeEstado(Presupuesto $presupuesto): bool
    {
        dump('Se envía el correo al solicitante informando el cmabio de estado');
        return true;
    }

    /**
     * Envía un correo a un ténico cuando se le asigna una tarea
     * @param Tarea $tarea
     * @param Usuario $tecnico
     * @return bool true cuando el correo ha sido enviado
     */
    public function enviarCorreosTareaAsignadaTecnico(Tarea $tarea, Usuario $tecnico): bool
    {
        return true;
    }

    public function enviarCorreosCambioEstadoProyecto(Proyecto $proyecto): bool
    {
        $this->enviarCorreosCambioEstadoProyectoJefesProyecto($proyecto);
        $this->enviarCorreosCambioEstadoProyectoClientes($proyecto);
        return true;
    }

    private function enviarCorreosCambioEstadoProyectoJefesProyecto(Proyecto $proyecto): bool
    {
        dump('envia correo a jefes proyecto');
        return true;
    }

    private function enviarCorreosCambioEstadoProyectoClientes(Proyecto $proyecto): bool
    {
        dump('envia correo al cliente');
        return true;
    }
}