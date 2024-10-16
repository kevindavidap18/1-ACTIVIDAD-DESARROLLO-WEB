<?php
class TablaOrdenEntity extends ActiveRecord\Model
{
    static $table_name = 'TablaOrden';

    public static function mapperModelToEntity(TablaOrdenModel $ordenModel)
    {
        $ordenEntity = new self();
        $ordenEntity->total = $ordenModel->getTotal();
        $ordenEntity->cantidad = $ordenModel->getCantidad();
        $ordenEntity->descripcion = $ordenModel->getDescripcion();
        $ordenEntity->fecha_orden = $ordenModel->getFechaOrden();
        $ordenEntity->usuario_id = $ordenModel->getUsuarioId();
        return $ordenEntity;
    }

    public function mapperEntityToModel(): TablaOrdenModel
    {
        return new TablaOrdenModel(
            $this->id,
            $this->total,
            $this->cantidad,
            $this->descripcion,
            $this->fecha_orden,
            $this->usuario_id
        );
    }
}
