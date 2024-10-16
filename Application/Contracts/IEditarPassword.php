<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Domain/Model/UsuarioModel.php";
interface IEditarPassword
{
    public function editarPassword(string $email, string $password);
}
