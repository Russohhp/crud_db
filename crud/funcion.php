<?php
// Función para obtener todas las categorías
function obtenerCategorias($db) {
    $stmt = $db->query("SELECT id, nombre FROM categorias ORDER BY orden");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener todos los productos
function obtenerProductos($db) {
    $stmt = $db->query("SELECT * FROM productos");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Función para obtener un producto por ID
function obtenerProductoPorId($db, $id) {
    $stmt = $db->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Función para crear o actualizar un producto
function guardarProducto($db, $producto) {
    if (isset($producto['id']) && $producto['id']) {
        // Actualizar producto existente
        $stmt = $db->prepare("UPDATE productos SET codigo = ?, nombre = ?, categoria_id = ?, existencia_actual = ?, precio = ? WHERE id = ?");
        $stmt->execute([$producto['codigo'], $producto['nombre'], $producto['categoria_id'], $producto['existencia_actual'], $producto['precio'], $producto['id']]);
    } else {
        // Crear nuevo producto
        $stmt = $db->prepare("INSERT INTO productos (codigo, nombre, categoria_id, existencia_actual, precio) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$producto['codigo'], $producto['nombre'], $producto['categoria_id'], $producto['existencia_actual'], $producto['precio']]);
    }
}

// Función para eliminar un producto
function eliminarProducto($db, $id) {
    $stmt = $db->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->execute([$id]);
}
?>
