<?php

namespace App\Services;

class ProyectoService
{
    /**
     * Se encarga de modificar los estados de un proyecto (aprobado, enproceso, terminado)
     *
     * Anotaciones: durante el desarrollo del proyecto se definirá si el segundo argumento será un string
     *  o otro tipo de dato (int, posible objeto Estado...)
     *
     * @param Proyecto $proyecto Proyecto del que cambiaremos el estado
     * @param string $nuevoEstado Nuevo estado de proyecto (aprobado|enproceso|terminado)
     * @return Proyecto
     */
    public function cambiarEstadoProyecto(Proyecto $proyecto, string $nuevoEstado) : Proyecto
    {
    }

    /**
     * Comprueba que el cambio de estado sea correcto (no queden tareas por acabar, )
     *
     * @return bool
     */
    private function comprobarCambioCorrecto() : bool
    {
    }
}