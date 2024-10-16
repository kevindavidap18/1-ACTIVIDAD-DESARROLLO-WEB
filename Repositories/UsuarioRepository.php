<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Domain/Model/UsuarioModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Infrastructure/Databases/Entities/UsuarioEntity.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Execptions/UsuarioEncontradoException.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Execptions/UsuarioNoEncontradoException.php";
class UsuarioRepository implements IUsuarioRepository
{
    // Método para Crear un usuario
    public function crear(UsuarioModel $usuarioModel): int
    {
        try {
            $usuario = $this->buscar($usuarioModel->getEmail());
            if ($usuario !== null) {
                $message = "Usuario con correo: " . $usuarioModel->getEmail() . " ya existe";
                throw new UsuarioEncontradoException($message);
            }
            return 0;
        } catch (UsuarioNoEncontradoException $e) {
            try {
                $usuario = new UsuarioEntity();
                $usuario->password = $usuarioModel->getPassword();
                $usuario->nombre = $usuarioModel->getNombre();
                $usuario->apellidos = $usuarioModel->getApellidos();
                $usuario->rol = $usuarioModel->getRol();
                $usuario->email = $usuarioModel->getEmail();
                $usuario->telefono = $usuarioModel->getTelefono();
                $usuario->estado = $usuarioModel->getEstado();
                $usuario->fecha_registro = $usuarioModel->getFechaRegistro();
                $usuario->save();
                return $this->contar();
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    $message = "Usuario con correo: " . $usuarioModel->getEmail() . " ya existe";
                    throw new UsuarioEncontradoException($message);
                } else {
                    throw $e;
                }
            }
        }
    }



    // Método para buscar un usuario por correo
    public function buscar(string $correo): UsuarioModel
    {
        try {
            $usuario = UsuarioEntity::find_by_email($correo);
            if ($usuario) {
                return $usuario->mapperEntityToModel();
            } else {
                $message = "Usuario con correo $correo no existe";
                throw new UsuarioNoEncontradoException($message);
            }
        } catch (Exception $e) {
            $message = "Usuario con correo $correo no existe";
            throw new UsuarioNoEncontradoException($message);
        }
    }


    // Método para contar registro
    public function contar(): int
    {
        return @UsuarioEntity::count();
    }


    //metodo para editar ususario
    public function editar(UsuarioModel $usuarioModel)
    {
        try {
            $usuarioEntity = UsuarioEntity::find_by_email($usuarioModel->getEmail());
            $usuarioEntity->password = $usuarioModel->getPassword();
            $usuarioEntity->nombre = $usuarioModel->getNombre();
            $usuarioEntity->apellidos = $usuarioModel->getApellidos();
            $usuarioEntity->rol = $usuarioModel->getRol();
            $usuarioEntity->email = $usuarioModel->getEmail();
            $usuarioEntity->telefono = $usuarioModel->getTelefono();
            $usuarioEntity->estado = $usuarioModel->getEstado();
            $usuarioEntity->fecha_registro = $usuarioModel->getFechaRegistro();
            $usuarioEntity->save();
        } catch (UsuarioNoEncontradoException $e) {
            $message = "Usuario con correo: " . $usuarioModel->getEmail() . " no existe";
            throw new UsuarioNoEncontradoException($message);
        }
    }

    //metodo para listar ususarios

    public function listar(): array
    {
        try {
            $usuariosEntityList = UsuarioEntity::all();
            $usuariosModelList = [];

            foreach ($usuariosEntityList as $usuarioEntity) {
                $usuariosModelList[] = $usuarioEntity->mapperEntityToModel();
            }

            return $usuariosModelList;
        } catch (Exception $e) {
            throw new Exception("Error al listar los usuarios");
        }
    }

    //metodo para lEditar Contraseña

    public function editarPassword(string $email, string $password)
    {
        try {
            $usuarioEntity = UsuarioEntity::find_by_email($email);
            if ($usuarioEntity) {
                $usuarioEntity->password = $password; // Actualizar solo la contraseña
                $usuarioEntity->save();
            } else {
                $message = "Usuario con correo: " . $email . " no existe";
                throw new UsuarioNoEncontradoException($message);
            }
        } catch (UsuarioNoEncontradoException $e) {
            throw new UsuarioNoEncontradoException($e->getMessage());
        } catch (Exception $e) {
            throw new Exception("Error actualizando la contraseña: " . $e->getMessage());
        }
    }
}
