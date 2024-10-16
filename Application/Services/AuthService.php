<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Contracts/ILoginUsuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Contracts/IAuthService.php";

class AuthService implements IAuthService
{
    private $usuarioRepository;

    public function __construct(ILoginUsuario $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    public function login(LoginModel $loginModel): UsuarioModel
    {
        return $this->usuarioRepository->login($loginModel);
    }
}
