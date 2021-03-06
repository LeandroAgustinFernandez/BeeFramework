<?php

class Redirect
{
    private $location;

    /** 
     * Metodo para redirigir al usuario a una seccion determinada
     * 
     * @param string $location
     * @return void
     */
    public static function to($location) // En funciones estaticas no se usa THIS se usa SELF
    {
        $self = new self();
        $self->location = $location;
        //Si las cabeceras fueron ya enviadas
        if (headers_sent()) {
            echo '<script type="text/javascript">';
            echo 'window.location.href= "' . URL . $self->location . '";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url=' . URL . $self->location . '" />';
            echo '</noscript>';
            die();
        }
        //Cuando pasamos una URL externa a nuestro sitio
        if (strpos($self->location, 'http') !== false) {
            header('Location: ' . $self->location);
            die();
        }
        //Redirigir al usuario a otra seccion.
        header('Location: ' .  URL . $self->location);
        die(); // Despues de redigir el die evita que se ejecute algo mas.
    }
}
