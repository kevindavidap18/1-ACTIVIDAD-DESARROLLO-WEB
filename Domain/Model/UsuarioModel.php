<?php
class UsuarioModel {
   
    private $password;
    private $nombre;
    private $apellidos;
    private $rol;
    private $email;
    private $telefono;
    private $estado;
    private $fecha_registro;

    public function __construct(string $password, string $nombre, string $apellidos, string $rol, string $email, string $telefono, string $estado, string $fecha_registro) {
        $this->password = $password;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->rol = $rol;
        $this->email = $email;
        $this->telefono = $telefono;
        $this->estado = $estado;
        $this->fecha_registro = $fecha_registro;
    }

    public function validar(): array {
        $errores = [];

        if (empty(trim($this->email))) {
            $errores[] = "El Email es requerido";
        }

        $resultado = $this->validarClave($this->password);
        if (!$resultado["resultado"]) {
            $errores[] = $resultado["mensaje"];
        }

        if (empty(trim($this->nombre))) {
            $errores[] = "El Nombre es requerido";
        }

        if (empty(trim($this->apellidos))) {
            $errores[] = "Los Apellidos son requeridos";
        }

        return $errores;
    }

    private function validarClave(string $password): array {
        if (empty(trim($password))) {
            return ["resultado" => false, "mensaje" => "La clave es requerida"];
        }
        if (strlen($password) < 12) {
            return ["resultado" => false, "mensaje" => "La clave debe tener al menos 12 caracteres"];
        }
        return ["resultado" => true, "mensaje" => ""];
    }

    // Getters y setters
   
    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function getApellidos(): string {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): void {
        $this->apellidos = $apellidos;
    }

    public function getRol(): string {
        return $this->rol;
    }

    public function setRol(string $rol): void {
        $this->rol = $rol;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getTelefono(): string {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): void {
        $this->telefono = $telefono;
    }

    public function getEstado(): string {
        return $this->estado;
    }

    public function setEstado(string $estado): void {
        $this->estado = $estado;
    }

    public function getFechaRegistro(): string {
        return $this->fecha_registro;
    }

    public function setFechaRegistro(string $fecha_registro): void {
        $this->fecha_registro = $fecha_registro;
    }
}
