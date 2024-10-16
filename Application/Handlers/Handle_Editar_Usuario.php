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
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];
    $estado = $_POST['estado'];

    try {
        $usuarioRepository = new UsuarioRepository();
        $buscarUsuarioService = new BuscarUsuarioService($usuarioRepository);
        $usuarioModel = $buscarUsuarioService->buscar($email);

        // Actualizar los datos del usuario
        if (!empty($nombre)) $usuarioModel->setNombre($nombre);
        if (!empty($apellidos)) $usuarioModel->setApellidos($apellidos);
        if (!empty($password)) $usuarioModel->setPassword(password_hash($password, PASSWORD_BCRYPT)); // Hashear la nueva contraseña
        if (!empty($telefono)) $usuarioModel->setTelefono($telefono);
        if (!empty($estado)) $usuarioModel->setEstado($estado);

        $usuarioRepository->editar($usuarioModel);

        // Redirigir con el mensaje de éxito
        header("Location: /ACTIVIDAD_DESARROLLO_1/Views/Html/UsuarioForms/editar_usuario.php?message=Usuario+editado+correctamente");
        exit();
    } catch (UsuarioNoEncontradoException $e) {
        header("Location: /ACTIVIDAD_DESARROLLO_1/Views/Html/UsuarioForms/editar_usuario.php?message=Usuario+no+encontrado");
        exit();
    } catch (Exception $e) {
        echo "Error inesperado: " . $e->getMessage();
    }
}
