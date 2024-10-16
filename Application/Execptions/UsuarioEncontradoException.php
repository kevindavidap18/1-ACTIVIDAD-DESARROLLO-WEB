<?php
class UsuarioEncontradoException extends Exception
{
    public function __construct($message = "", $code = 0, Exception $throwable = null)
    {
        parent::__construct($message, $code, $throwable);
    }
}
