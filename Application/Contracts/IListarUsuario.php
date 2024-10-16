<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Domain/Model/UsuarioModel.php";

interface IListarUsuario {
    public function listarUsuario(): array;
}