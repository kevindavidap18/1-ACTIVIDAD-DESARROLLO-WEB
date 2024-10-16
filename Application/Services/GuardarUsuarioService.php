<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Domain/Model/UsuarioModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Contracts/IUsuarioRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Contracts/IGuardarUsuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Execptions/UsuarioEncontradoException.php";

class GuardarUsuarioService implements IGuardarUsuario {
    private $usuarioRepository;

    public function __construct(IUsuarioRepository $usuarioRepository) {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function guardarUsuario(UsuarioModel $usuario): int {
        try {
            return $this->usuarioRepository->crear($usuario);
        } catch (UsuarioEncontradoException $e) {
            throw $e;
        }
    }
}