<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/styles.css">
    <title>Listar Órdenes</title>
</head>
<body>
    <div class="container">
        <h1>Listado de Órdenes</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Total</th>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th>Fecha de Orden</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Suponiendo que has cargado las órdenes desde el servicio
                // $ordenes = $ordenService->listarOrdenes();

                foreach ($ordenes as $orden) {
                    echo "<tr>
                            <td>{$orden->getId()}</td>
                            <td>{$orden->getTotal()}</td>
                            <td>{$orden->getCantidad()}</td>
                            <td>{$orden->getDescripcion()}</td>
                            <td>{$orden->getFechaOrden()->format('Y-m-d')}</td>
                            <td>
                                <a href='editarOrden.html?id={$orden->getId()}'>Editar</a>
                                <a href='eliminarOrden.php?id={$orden->getId()}'>Eliminar</a>
                            </td>
                         </tr>";
                }
                ?>
            </tbody>
        </table>
        <p><a href="crearOrden.html">Crear Nueva Orden</a></p>
    </div>
</body>
</html>
