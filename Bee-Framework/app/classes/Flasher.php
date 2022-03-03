<?php

class Flasher
{
    private $valid_types = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];
    private $default = 'primary';
    private $type;
    private $msg;

    /**
     * Metodo para guardar una notificacion flash
     * 
     * @param string $msg
     * @param string $type
     * @return void
     */

    public static function new($msg, $type = 'primary')
    {
        $self = new self();
        if ($type === null) {
            $self->type = $self->default;
        }
        $self->type = in_array($type, $self->valid_types) ? $type : $self->default;

        // Guardar la notificacion en un array de session.
        if (is_array($msg)) {
            foreach ($msg as $message) {
                $_SESSION[$self->type][] = $message;
            }
            return true;
        }

        $_SESSION[$self->type][] = $msg;
        return true;
    }

    /** 
     * Renderiza las notificaciones a nuestro usuario.
     * 
     * @return void
     */
    public static function flash()
    {
        $self = new self();
        $output = '';
        foreach ($self->valid_types as $type) {

            if (isset($_SESSION[$type]) && !empty($_SESSION[$type])) {
                foreach ($_SESSION[$type] as $msg) {

                    $output .= '<div class="alert alert-' . $type . ' alert-dismissible show fade" role="alert">';
                    $output .= $msg;
                    $output .= '<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>';
                    $output .= '</div>';
                }
            }
            unset($_SESSION[$type]);
        }
        return $output;
    }
}
