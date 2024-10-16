<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Infrastructure/Lib/Config.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Domain/Model/UsuarioModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Contracts/IUsuarioRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Infrastructure/Repositories/UsuarioRepository.php";

try {
    $usuarioRepository = new UsuarioRepository();
    $usuarios = $usuarioRepository->listar();

    session_start();
    $_SESSION['usuarios'] = $usuarios;
    header("Location: /ACTIVIDAD_DESARROLLO_1/Views/Html/UsuarioForms/listar_usuarios.php");
    exit();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
