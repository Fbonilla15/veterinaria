<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include_once('./config/db.php');  // Asegúrate de la ruta correcta según tu estructura de archivos
include_once('./controller/AdminController.php');


$chatController = new ChatController();
$chatController->showChat();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Médico</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>
    <div class="container mx-auto mt-8">
        <h2 class="text-2xl font-bold mb-4">Chat Médico</h2>

        <div class="flex">
            <!-- Lista de usuarios -->
            <div class="w-1/4 pr-4">
                <h3 class="text-lg font-bold mb-2">Usuarios Disponibles</h3>
                <ul>
                    <?php foreach ($users as $user) : ?>
                        <li class="mb-1">
                            <a href="?user_id=<?= $user['id']; ?>" class="text-blue-500 hover:underline"><?= $user['username']; ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Área de chat -->
            <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                <?php
                // Mostrar mensajes del chat
                if (!empty($messages)) {
                    foreach ($messages as $message) {
                        $sender = ($message['sender_id'] == $_SESSION['user_id']) ? 'Tú' : 'Otro Usuario';
                        echo "<p><strong>$sender:</strong> {$message['content']}</p>";
                    }
                } else {
                    echo "<p>No hay mensajes en este chat.</p>";
                }

                // Formulario para enviar un mensaje
                echo "
                <form method='post' action=''>
                    <div class='px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800 flex items-center justify-between px-3 py-2 border-t dark:border-gray-600'>
                        <div class='px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800'>
                            <textarea name='message' placeholder='Escribe tu mensaje...' class='form-input mt-2 block w-full'></textarea>
                            <button type='submit' class='bg-blue-500 text-white px-4 py-2 mt-2 rounded'>Enviar</button>
                        </div>
                    </form>
                ";
                ?>
            </div>
        </div>
    </div>
</body>
</html>
