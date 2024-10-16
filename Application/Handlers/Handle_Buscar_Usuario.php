<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Infrastructure/Lib/Config.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Domain/Model/UsuarioModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Contracts/IBuscarUsuario.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Contracts/IUsuarioRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Infrastructure/Repositories/UsuarioRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Services/BuscarUsuarioService.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Execptions/UsuarioNoEncontradoException.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    try {
        $usuarioRepository = new UsuarioRepository();
        $buscarUsuarioService = new BuscarUsuarioService($usuarioRepository);
        $usuarioModel = $buscarUsuarioService->buscar($email);

        // Redirigir con el resultado del usuario encontrado
        header("Location: /ACTIVIDAD_DESARROLLO_1/Views/Html/UsuarioForms/buscar_usuario.php?message=Usuario+encontrado:+{$usuarioModel->getNombre()}+{$usuarioModel->getApellidos()}");
        exit();
    } catch (UsuarioNoEncontradoException $e) {
        header("Location: /ACTIVIDAD_DESARROLLO_1/Views/Html/UsuarioForms/buscar_usuario.php?message=Usuario+no+encontrado");
        exit();
    } catch (Exception $e) {
        echo "Error inesperado: " . $e->getMessage();
    }
}
