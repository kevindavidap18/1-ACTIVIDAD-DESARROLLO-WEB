<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Infrastructure/Lib/Config.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Services/BuscarUsuarioService.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Infrastructure/Repositories/UsuarioRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Execptions/UsuarioNoEncontradoException.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $usuarioRepository = new UsuarioRepository();
    $buscarUsuarioService = new BuscarUsuarioService($usuarioRepository);

    try {
        // Buscar si el usuario existe
        $usuarioModel = $buscarUsuarioService->buscar($email);

        // Usuario encontrado, redirigir a la página de editar contraseña
        header("Location: /ACTIVIDAD_DESARROLLO_1/Views/Html/LoginForms/Edit_Password.php?email=" . urlencode($email));
        exit();
    } catch (UsuarioNoEncontradoException $e) {
        // Usuario no encontrado, mostrar mensaje de error
        echo "No se ha encontrado un usuario con ese correo electrónico.";
    } catch (Exception $e) {
        // Capturar cualquier otra excepción
        echo "Ha ocurrido un error inesperado: " . $e->getMessage();
    }
}
