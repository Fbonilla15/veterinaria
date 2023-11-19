<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include_once('./config/db.php'); // Asegúrate de que la ruta sea correcta
include_once('./controller/AdminController.php'); // Asegúrate de que la ruta sea correcta


$adminController = new AdminController();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>
    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4">Panel de Administrador</h2>

        <?php
        // Aquí puedes mostrar la información específica del panel de administrador, como la lista de usuarios o cualquier otra funcionalidad.
        ?>

        <p><a href="logout.php" class="text-blue-500 hover:underline">Cerrar sesión</a></p>
    </div>
</body>
</html>
