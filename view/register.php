<?php


if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}



include_once('./config/db.php');  // Asegúrate de la ruta correcta según tu estructura de archivos
include_once('./controller/AdminController.php');


$userController = new UserController();
$userController->register();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>
    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4">Registrarse</h2>

        <form method="post" action="">
            <div class="mb-4">
                <label for="username" class="block text-gray-600">Usuario:</label>
                <input type="text" id="username" name="username" class="form-input mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-600">Contraseña:</label>
                <input type="password" id="password" name="password" class="form-input mt-1 block w-full" required>
            </div>

            <div class="mb-4">
                <label for="role" class="block text-gray-600">Rol:</label>
                <select id="role" name="role" class="form-select mt-1 block w-full" required>
                    <option value="admin">Administrador</option>
                    <option value="doctor">Médico</option>
                    <option value="user">Usuario</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Registrarse</button>
        </form>
    </div>
</body>
</html>
