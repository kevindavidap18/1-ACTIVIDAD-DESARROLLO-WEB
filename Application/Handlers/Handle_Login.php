<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Infrastructure/Lib/Config.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Domain/Model/LoginModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Contracts/IAuthService.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Infrastructure/Repositories/LoginRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Services/AuthService.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Execptions/UsuarioNoAutenticadoException.php";

session_start(); 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $login = new LoginModel($email, $password);
        $loginRepository = new LoginRepository();
        $authService = new AuthService($loginRepository);
        $usuarioModel = $authService->login($login);

        
        $_SESSION['usuario_nombre'] = $usuarioModel->getNombre();
        $_SESSION['usuario_apellido'] = $usuarioModel->getApellidos();

   
        header("Location: /ACTIVIDAD_DESARROLLO_1/Views/Html/LoginForms/Welcome.php");
        exit();
    } catch (UsuarioNoAutenticadoException $e) {
      
        header("Location: /ACTIVIDAD_DESARROLLO_1/Views/Html/LoginForms/Login.php?error=incorrect_credentials");
        exit();
    } catch (Exception $e) {
      
        header("Location: /ACTIVIDAD_DESARROLLO_1/Views/Html/LoginForms/Login.php?error=unexpected_error");
        exit();
    }
}
