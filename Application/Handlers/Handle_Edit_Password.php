<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Infrastructure/Lib/Config.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Services/EditarPasswordService.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Infrastructure/Repositories/UsuarioRepository.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (strlen($password) < 12) {
        echo "La nueva contraseña debe tener al menos 12 caracteres.";
        exit();
    }

    $usuarioRepository = new UsuarioRepository();
    $editarPasswordService = new EditarPasswordService($usuarioRepository);

    try {

        $editarPasswordService->editarPassword($email, $password);


        header("Location: /ACTIVIDAD_DESARROLLO_1/Views/Html/LoginForms/Login.php?message=password_updated");
        exit();
    } catch (Exception $e) {

        echo "Ha ocurrido un error inesperado: " . $e->getMessage();
    }
}
