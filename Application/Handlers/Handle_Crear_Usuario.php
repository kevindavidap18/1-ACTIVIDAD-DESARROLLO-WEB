<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Domain/Model/UsuarioModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Contracts/IUsuarioRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Infrastructure/Repositories/UsuarioRepository.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Services/GuardarUsuarioService.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Execptions/UsuarioEncontradoException.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $rol = $_POST['rol'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar longitud de la contraseña
    if (strlen($password) < 12) {
        // Redirigir a la página de creación de usuario con mensaje de error
        header('Location: /ACTIVIDAD_DESARROLLO_1/Views/Html/UsuarioForms/crear_usuario.php?message=password_length');
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Hashear la contraseña
    $telefono = $_POST['telefono'];
    $estado = 'activo';
    $fechaRegistro = new \DateTime();

    try {
        $usuarioModel = new UsuarioModel(
            $hashedPassword,
            $nombre,
            $apellidos,
            $rol,
            $email,
            $telefono,
            $estado,
            $fechaRegistro->format('Y-m-d H:i:s')
        );

        // Validar el modelo
        $errores = $usuarioModel->validar();
        if (!empty($errores)) {
            foreach ($errores as $error) {
                echo "$error\n";
            }
            return;
        }

        $usuarioRepository = new UsuarioRepository();
        $guardarUsuarioService = new GuardarUsuarioService($usuarioRepository);
        // Guardar usuario
        $guardarUsuarioService->guardarUsuario($usuarioModel);

        // Redirigir a la página de creación de usuario con mensaje de éxito
        header('Location: /ACTIVIDAD_DESARROLLO_1/Views/Html/UsuarioForms/crear_usuario.php?message=Usuario+registrado+correctamente');
        exit();
    } catch (UsuarioEncontradoException $e) {
        // Redirigir a la página de creación de usuario con mensaje de error
        header('Location: /ACTIVIDAD_DESARROLLO_1/Views/Html/UsuarioForms/crear_usuario.php?message=exists');
        exit();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
