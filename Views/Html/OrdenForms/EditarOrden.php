<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styles.css">
    <title>Editar Orden</title>
</head>
<body>
    <h1>Editar Orden</h1>
    <form action="/ACTIVIDAD_DESARROLLO_1/Application/Services/OrdenService/EditarOrdenService.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $orden->getId(); ?>">

        <label for="total">Total:</label>
        <input type="number" name="total" id="total" value="<?php echo $orden->getTotal(); ?>" required><br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" value="<?php echo $orden->getCantidad(); ?>" required><br>

        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion" id="descripcion" value="<?php echo $orden->getDescripcion(); ?>" required><br>

        <label for="fecha_orden">Fecha de Orden:</label>
        <input type="date" name="fecha_orden" id="fecha_orden" value="<?php echo $orden->getFechaOrden()->format('Y-m-d'); ?>" required><br>

        <button type="submit">Actualizar Orden</button>
    </form>
</body>
</html>
