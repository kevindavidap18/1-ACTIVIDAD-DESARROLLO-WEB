<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Domain/Model/UsuarioModel.php";

interface IBuscarUsuario {
    public function buscar(string $correo): UsuarioModel;
}
