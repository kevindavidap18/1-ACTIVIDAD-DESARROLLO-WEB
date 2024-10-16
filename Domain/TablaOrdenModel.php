<?php
class TablaOrdenModel
{
    private $id;
    private $total;
    private $cantidad;
    private $descripcion;
    private $fecha_orden;
    private $usuario_id;

    public function __construct($id, $total, $cantidad, $descripcion, $fecha_orden, $usuario_id)
    {
        $this->id = $id;
        $this->total = $total;
        $this->cantidad = $cantidad;
        $this->descripcion = $descripcion;
        $this->fecha_orden = $fecha_orden;
        $this->usuario_id = $usuario_id;
    }

    // Validaciones
    public function validar()
    {
        $errores = [];
        if ($this->total <= 0) {
            $errores[] = "El total debe ser mayor a cero.";
        }
        if ($this->cantidad <= 0) {
            $errores[] = "La cantidad debe ser mayor a cero.";
        }
        if (empty($this->descripcion)) {
            $errores[] = "La descripción es obligatoria.";
        }
        if (empty($this->fecha_orden)) {
            $errores[] = "La fecha de la orden es obligatoria.";
        }
        if ($this->usuario_id <= 0) {
            $errores[] = "El ID de usuario debe ser mayor a cero.";
        }
        return $errores;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function getFechaOrden()
    {
        return $this->fecha_orden;
    }

    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function setFechaOrden($fecha_orden)
    {
        $this->fecha_orden = $fecha_orden;
    }

    public function setUsuarioId($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }
}
