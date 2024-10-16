<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Domain/Model/TablaOrdenModel.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Infrastructure/Databases/Entities/TablaOrdenEntity.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/ACTIVIDAD_DESARROLLO_1/Application/Exceptions/OrdenNoEncontradaException.php";

class OrdenRepository
{
    public function crear(TablaOrdenModel $ordenModel): int
    {
        try {
            $ordenEntity = TablaOrdenEntity::mapperModelToEntity($ordenModel);
            $ordenEntity->save();
            return $ordenEntity->id;
        } catch (Exception $e) {
            throw new Exception("Error al crear la orden: " . $e->getMessage());
        }
    }

    public function buscarYVerOrden($ordenId): TablaOrdenModel
    {
        try {
            $orden = TablaOrdenEntity::find_by_id($ordenId);
            if ($orden) {
                return $orden->mapperEntityToModel();
            } else {
                $message = "Orden con ID $ordenId no encontrada";
                throw new OrdenNoEncontradaException($message);
            }
        } catch (OrdenNoEncontradaException $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception("Ocurrió un error inesperado: " . $e->getMessage());
        }
    }

    public function editarOrden(TablaOrdenModel $ordenModel)
    {
        try {
            $orden = TablaOrdenEntity::find_by_id($ordenModel->getId());
            if ($orden) {
                $orden->total = $ordenModel->getTotal();
                $orden->cantidad = $ordenModel->getCantidad();
                $orden->descripcion = $ordenModel->getDescripcion();
                $orden->fecha_orden = $ordenModel->getFechaOrden();
                $orden->usuario_id = $ordenModel->getUsuarioId();
                $orden->save();
            } else {
                throw new OrdenNoEncontradaException("Orden con ID " . $ordenModel->getId() . " no encontrada");
            }
        } catch (Exception $e) {
            throw new Exception("Error al editar la orden: " . $e->getMessage());
        }
    }

    public function eliminarOrden(int $ordenId)
    {
        $orden = TablaOrdenEntity::find_by_id($ordenId);
        if ($orden) {
            $orden->delete();
        } else {
            throw new OrdenNoEncontradaException("Orden con ID: $ordenId no encontrada");
        }
    }

    public function listarOrdenes(): array
    {
        $ordenes = TablaOrdenEntity::all();
        $ordenModelList = [];
        foreach ($ordenes as $orden) {
            $ordenModelList[] = $orden->mapperEntityToModel();
        }
        return $ordenModelList;
    }
}
