<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Infrastructure/Lib/Config.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Domain/Model/UsuarioModel.php";

class UsuarioEntity extends ActiveRecord\Model
{

    public static $table_name = "usuarios";
    public static $primary_key = "id";

    //relaciones 
    public static $has_many = [["cursos", "class_name" => "CursoEntity", "foreign_key" => "usuario_id"]];



      // Método para mapear UsuarioEntity a UsuarioModel
      public function mapperEntityToModel(): UsuarioModel {
        return new UsuarioModel(
            $this->password,
            $this->nombre,
            $this->apellidos,
            $this->rol,
            $this->email,
            $this->telefono,
            $this->estado,
            $this->fecha_registro->format('Y-m-d H:i:s') // Convertimos a cadena de texto
        );
    }

    // Método para mapear UsuarioModel a UsuarioEntity
    public static function mapperModelToEntity(UsuarioModel $usuarioModel): UsuarioEntity
    {
        $usuarioEntity = new UsuarioEntity();
        $usuarioEntity->password = $usuarioModel->getPassword();
        $usuarioEntity->nombre = $usuarioModel->getNombre();
        $usuarioEntity->apellidos = $usuarioModel->getApellidos();
        $usuarioEntity->rol = $usuarioModel->getRol();
        $usuarioEntity->email = $usuarioModel->getEmail();
        $usuarioEntity->telefono = $usuarioModel->getTelefono();
        $usuarioEntity->estado = $usuarioModel->getEstado();
        $usuarioEntity->fecha_registro = $usuarioModel->getFechaRegistro();
        return $usuarioEntity;
    }
    // Método de búsqueda por correo
    public static function find_by_email($email)
    {
        return self::find('first', array('conditions' => array('email = ?', $email)));
    }
}
