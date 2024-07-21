<?php
require 'conexion.php'; // Archivo con la conexión y funciones

// Procesar formulario de creación/actualización de categorías
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoria = [
        'id' => $_POST['id'] ?? null,
        'nombre' => $_POST['nombre'],
        'orden' => $_POST['orden']
    ];
    guardarCategoria($db, $categoria);
    header('Location: categorias.php');
    exit;
}

// Procesar eliminación de categoría
if (isset($_GET['eliminar'])) {
    eliminarCategoria($db, $_GET['eliminar']);
    header('Location: categorias.php');
    exit;
}

// Obtener categorías para mostrar en el formulario y la lista
$categorias = obtenerCategorias($db);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD de Categorías</title>
</head>
<body>
    <h1>Gestión de Categorías</h1>

    <!-- Menú Principal -->
    <nav>
        <ul>
            <li><a href="productos.php">Productos</a></li>
            <li><a href="categorias.php">Categorías</a></li>
        </ul>
    </nav>

    <form action="categorias.php" method="post">
        <input type="hidden" name="id" value="">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <label for="orden">Orden:</label>
        <input type="number" name="orden" id="orden" required>
        <button type="submit">Guardar</button>
    </form>

    <h2>Lista de Categorías</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Orden</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($categorias as $categoria): ?>
            <tr>
                <td><?= $categoria['id'] ?></td>
                <td><?= $categoria['nombre'] ?></td>
                <td><?= $categoria['orden'] ?></td>
                <td>
                    <a href="categorias.php?editar=<?= $categoria['id'] ?>">Editar</a>
                    <a href="categorias.php?eliminar=<?= $categoria['id'] ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
