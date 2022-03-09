<?php

namespace App\Services;

class TareaService
{
    /**
     * Modifica los estados de una tarea (sinAsignar, asignada, terminada)
     *
     * Anotaciones: durante el desarrollo del proyecto se definirá si el segundo argumento será un string
     *  o otro tipo de dato (int, posible objeto Estado...)
     *
     * @param Tarea $tarea Tarea a modificar el estado
     * @param string $nuevoEstado nuevo estado de la tarea (sinAsignar | asignada | terminada)
     * @return Tarea
     */
    public function cambiarEstadoTarea(Tarea $tarea, string $nuevoEstado) : Tarea
    {
    }
}