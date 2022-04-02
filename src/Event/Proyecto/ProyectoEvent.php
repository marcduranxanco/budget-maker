<?php

namespace App\Event\Proyecto;

use App\Entity\Proyecto;

class ProyectoEvent extends \Symfony\Contracts\EventDispatcher\Event
{
    public const NAME_CAMBIO_ESTADO = 'proyecto.cambio.estado';
    protected Proyecto $proyecto;

    /**
     * @param Proyecto $proyecto
     */
    public function __construct(Proyecto $proyecto)
    {
        $this->proyecto = $proyecto;
    }

    /**
     * @return Proyecto
     */
    public function getProyecto(): Proyecto
    {
        return $this->proyecto;
    }


}