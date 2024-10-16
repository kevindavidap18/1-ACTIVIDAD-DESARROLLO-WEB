<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Contracts/ILoginUsuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Domain/Model/LoginModel.php";

class LoginUsuarioService implements ILoginUsuario
{
    private $loginRepository;

    public function __construct(ILoginUsuario $loginRepository)
    {
        $this->loginRepository = $loginRepository;
    }

    public function login(LoginModel $loginModel): UsuarioModel
    {
        return $this->loginRepository->login($loginModel);
    }
}
