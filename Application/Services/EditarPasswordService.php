<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Domain/Model/UsuarioModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Contracts/IUsuarioRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Contracts/IEditarPassword.php";

class EditarPasswordService
{
    private $usuarioRepository;

    public function __construct(IUsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function editarPassword($email, $password)
    {
        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
        $this->usuarioRepository->editarPassword($email, $passwordHashed);
    }
}
