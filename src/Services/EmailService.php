<?php

namespace App\Services;

use phpDocumentor\Reflection\Types\Boolean;

/**
 * Servicio de gestión del envío de correos
 */
class EmailService
{
    /**
     * Envía un correo a los comerciales con la información de la nueva solicitud
     * Devuelve true si todo ha ido bien o false si no se ha podido enviar el correo
     */
    public function enviarCorreosSolicitudPresupuestoAComerciales(SolicitudPresupuesto $solicitud): boolean
    {
    }

    /**
     * Envía un correo al solicitante del presupuesto indicando que se ha recibido la solicitud
     * Devuelve true si todo ha ido bien o false si no se ha podido enviar el correo
     */
    public function enviarCorreosSolicitudPresupuestoASolicitante(SolicitudPresupuesto $solicitud): boolean
    {
    }

    /**
     * Envía un correo a las personas implicadas en una solicitud cuando esta cambia de estado
     * Devuelve true si todo ha ido bien o false si no se ha podido enviar el correo
     * @param SolicitudPresupuesto $solicitud
     * @return bool
     */
    public function enviarCorreosSolicitudCambioDeEstado(SolicitudPresupuesto $solicitud): boolean
    {
    }

    /**
     * Envía un correo a las personas implicadas en el presupuesto (comerial, solicitante)
     * indicando cambios de estado del presupuesto
     * Devuelve true si todo ha ido bien o false si no se ha podido enviar el correo
     */
    public function enviarCorreosPresupuestoCamioDeEstado(SolicitudPresupuesto $solicitud): boolean
    {
    }

    /**
     * Envía un correo a un ténico cuando se le asigna una tarea
     * @param Tarea $tarea
     * @param Usuario $tecnico
     * @return bool true cuando el correo ha sido enviado
     */
    public function enviarCorreosTareaAsignadaTecnico(Tarea $tarea, Usuario $tecnico): Boolean
    {}
}