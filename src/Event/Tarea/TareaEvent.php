<?php

namespace App\Event\Tarea;

use App\Entity\Tarea;

class TareaEvent extends \Symfony\Contracts\EventDispatcher\Event
{
    public const ASIGNAR_TECNICO = 'tarea.asignar.tecnico';
    public const TAREA_TERMINADA = 'tarea.terminada';
    protected Tarea $tarea;

    public function __construct(Tarea $tarea)
    {
        $this->tarea = $tarea;
    }

    /**
     * @return Tarea
     */
    public function getTarea(): Tarea
    {
        return $this->tarea;
    }

}