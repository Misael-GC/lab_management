<?php
namespace App\Controllers;

use Core\Database;

class UserController extends BaseController
{
    public function index(array $params = []): void
    {
        $db = Database::getInstance();
        
        $userId = 1; 
        
        $stmt = $db->prepare("SELECT name, email, rol FROM user WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch();

        $this->render('users/index', [
            'title' => 'Settings',
            'user'  => $user
        ]);
    }

    public function updateProfile(): void
    {
        $db = Database::getInstance();

        $userId = 1;
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';

        if (!empty($name) && !empty($email)) {
            $stmt = $db->prepare("UPDATE user SET name = ?, email = ? WHERE id = ?");
            $success = $stmt->execute([$name, $email, $userId]);

            if ($success) {
                // Podrías usar SweetAlert2 aquí como en tus otros scripts
                header('Location: /users?status=updated');
                exit;
            }
        }
        
        header('Location: /users?status=error');
    }

    public function changePassword(): void
    {
        $db = Database::getInstance();
        $userId = 1;

        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        // 1. Validar que los campos no estén vacíos
        if (empty($currentPassword) || empty($newPassword)) {
            header('Location: /users?status=empty_fields');
            exit;
        }

        // 2. Validar que la nueva contraseña coincida con la confirmación
        if ($newPassword !== $confirmPassword) {
            header('Location: /users?status=password_mismatch');
            exit;
        }

        // 3. Obtener la contraseña actual de la DB para comparar
        $stmt = $db->prepare("SELECT password FROM user WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch();

        // 4. Verificar contraseña actual con password_verify
        $storedPassword = $user['password'];
        $isValid = false;

        // Verificamos si la contraseña almacenada ya es un hash de Bcrypt
        if (str_starts_with($storedPassword, '$2y$')) {
            $isValid = password_verify($currentPassword, $storedPassword);
        } else {
            // Si no es hash, comparamos como texto plano (Migración)
            $isValid = ($currentPassword === $storedPassword);
        }

        if (!$isValid) {
            header('Location: /users?status=invalid_current');
            exit;
        }

        // 5. Encriptar nueva contraseña y actualizar
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $update = $db->prepare("UPDATE user SET password = ? WHERE id = ?");
        
        if ($update->execute([$hashedPassword, $userId])) {
            header('Location: /users?status=password_success');
        } else {
            header('Location: /users?status=error');
        }
        exit;
    }
}