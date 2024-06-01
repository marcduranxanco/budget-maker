<?php

namespace App\Services;

use App\Entity\Presupuesto;
use App\Entity\Proyecto;
use App\Entity\Tarea;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

/**
 * Servicio de gestión del envío de correos
 */
class EmailService
{
    private MailerInterface $mailer;
    private string $mailerFrom;
    private UserRepository $userRepository;

    public function __construct(MailerInterface $mailer, string $mailerFrom, EntityManagerInterface $em)
    {
        $this->mailer = $mailer;
        $this->mailerFrom = $mailerFrom;
        $this->userRepository = $em->getRepository(User::class);
    }

    public function sendEmail(array $mailTo, string $subject, string $body): void
    {
        $email = (new Email())
            ->from($this->mailerFrom)
            ->subject($subject)
            ->html($body);

        /** @var User $receiver */
        foreach($mailTo as $receiver){
            $email->addTo($receiver);
        }

        $this->mailer->send($email);
    }

    /**
     * Envia los correos cuando hay una nueva solicitud de presupuesto
     * @param Presupuesto $presupuesto
     * @return bool
     */
    public function enviarCorreosSolicitudPresupuesto(Presupuesto $presupuesto): bool
    {
        try{
            $this->enviarCorreosSolicitudPresupuestoASolicitante($presupuesto);
            $this->enviarCorreosSolicitudPresupuestoAComerciales($presupuesto);
            return true;
        }
        catch (Exception $e){
            return false;
        }
    }

    private function enviarCorreosSolicitudPresupuestoAComerciales(Presupuesto $presupuesto): void
    {
        $subject = 'Nuevo presupuesto creado '. $presupuesto->getId();
        $body = 'Se ha creado un nuevo presupuesto: '.$presupuesto->getId().'. Contacto: '.$presupuesto->getCorreoContacto();

        $mailsComerciales = $this->userRepository->findMailsByRole(User::ROLES['Comercial']);

        $this->sendEmail($mailsComerciales, $subject, $body);
    }

    private function enviarCorreosSolicitudPresupuestoASolicitante(Presupuesto $presupuesto): void
    {
        $subject = 'Confirmación del presupuesto '. $presupuesto->getId();
        $body = 'Le confirmamos que su presupuesto con id '.$presupuesto->getId().' se ha procesado correctamente.';
        $this->sendEmail([$presupuesto->getCorreoContacto()], $subject, $body);
    }

    /**
     * Informa a los implicados que el presupuesto ha sido aprobado
     */
    public function enviarCorreosPresupuestoAprobado(Presupuesto $presupuesto): bool
    {
        try{
            $this->enviarCorreoPresupuestoAprobadoSolicitante($presupuesto);
            $this->enviarCorreoPresupuestoAprobadoJefeDeProyecto($presupuesto);
            return true;
        }
        catch (Exception $e){
            return false;
        }
    }

    private function enviarCorreoPresupuestoAprobadoSolicitante(Presupuesto $presupuesto)
    {
        $subject = 'Su presupuesto ha cambiado de estado!';
        $body = 'Le informamos que su presupuesto con id '.$presupuesto->getId().' ha cambiado de estado a '.$presupuesto->getEstado();
        $this->sendEmail($presupuesto->getUser(), $subject, $body);
    }

    private function enviarCorreoPresupuestoAprobadoJefeDeProyecto(Presupuesto $presupuesto)
    {
        $subject = 'El presupuesto '.$presupuesto->getId().' ha sido aprobado';
        $body = 'Le informamos que su presupuesto con id '.$presupuesto->getId().' ha cambiado de estado a '.$presupuesto->getEstado();
        $jefesProyecto = $this->userRepository->findByRole(User::ROLES['Comercial']);

        $this->sendEmail($jefesProyecto, $subject, $body);
    }

    /**
     * Envía un correo a las personas implicadas en una solicitud cuando esta cambia de estado
     * Devuelve true si todo ha ido bien o false si no se ha podido enviar el correo
     * @param SolicitudPresupuesto $solicitud
     * @return bool
     */
    public function enviarCorreosSolicitudCambioDeEstado(Presupuesto $presupuesto): bool
    {
        /** TODO: envía el correo al solicitante informando el cambio de estado; */
        try{
            $this->enviarCorreoPresupuestoAprobadoSolicitante($presupuesto);
            return true;
        }
        catch (Exception $e){
            return false;
        }

        return true;
    }

    /**
     * Envía un correo a las personas implicadas en el presupuesto (comerial, solicitante)
     * indicando cambios de estado del presupuesto
     * Devuelve true si todo ha ido bien o false si no se ha podido enviar el correo
     */
    public function enviarCorreosPresupuestoCamioDeEstado(Presupuesto $presupuesto): bool
    {
        /** TODO: Se envía el correo al solicitante informando el cmabio de estado */
        return true;
    }

    public function enviarCorreosCambioEstadoProyecto(Proyecto $proyecto): bool
    {
        try{
            $this->enviarCorreosCambioEstadoProyectoJefesProyecto($proyecto);
            $this->enviarCorreosCambioEstadoProyectoClientes($proyecto);
            return true;
        }
        catch (Exception $e){
            return true;
        }
    }

    private function enviarCorreosCambioEstadoProyectoJefesProyecto(Proyecto $proyecto): bool
    {
        /** TODO: Se envía el a los jefes de proyecto informando del cambio de estado del proyecto */
        return true;
    }

    private function enviarCorreosCambioEstadoProyectoClientes(Proyecto $proyecto): bool
    {
        /** TODO: Se envía el a los clientes informando del cambio de estado del proyecto */
        return true;
    }

    /**
     * Envía un correo a un ténico cuando se le asigna una tarea
     */
    public function enviarCorreosTareaAsignadaTecnico(Tarea $tarea, User $user): bool
    {
        /** TODO: Envía un correo a un ténico cuando se le asigna una tarea */
        return true;
    }

    public function enviarCorreosTareaTerminada(Tarea $tarea): bool
    {
        /** TODO: Envía un correo a un jefe de proyecto cuando se le asigna una tarea */
        return true;
    }
}