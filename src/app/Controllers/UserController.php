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

    public function exportAllSamples(): void
    {
        $db = Database::getInstance();
        $samples = $db->query("SELECT * FROM sample ORDER BY id ASC")->fetchAll();

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=full_samples_backup_' . date('Ymd') . '.csv');

        $output = fopen('php://output', 'w');
        fputs($output, chr(0xEF) . chr(0xBB) . chr(0xBF)); // BOM UTF-8
        fputcsv($output, ['id', 'code', 'status', 'id_project', 'id_user', 'analysis_cost', 'created_at']);

        foreach ($samples as $s) {
            fputcsv($output, [$s['id'], $s['code'], $s['status'], $s['id_project'], $s['id_user'], $s['analysis_cost'], $s['created_at']]);
        }
        fclose($output);
        exit;
    }

    public function clearAllSamples(): void
    {
        $db = Database::getInstance();
        try {
            // 1. Iniciar transacción para los DELETE (Integridad de datos)
            $db->beginTransaction();

            // Eliminamos el historial primero por la restricción de FK
            $db->exec("DELETE FROM his_activity");
            $db->exec("DELETE FROM sample");

            // Confirmamos los borrados
            $db->commit();

            // 2. El ALTER TABLE se ejecuta FUERA de la transacción para evitar el commit implícito
            $db->exec("ALTER TABLE sample AUTO_INCREMENT = 1");

            header('Location: /users?status=cleared');
        } catch (\Exception $e) {
            // Solo hacemos rollback si la transacción sigue abierta
            if ($db->inTransaction()) {
                $db->rollBack();
            }
            // Log del error para debugging
            error_log("Error en clearAllSamples: " . $e->getMessage());
            header('Location: /users?status=error');
        }
        exit;
    }

    public function importSamples(): void
    {
        if (!isset($_FILES['excel_file']) || $_FILES['excel_file']['error'] !== UPLOAD_ERR_OK) {
            header('Location: /users?status=import_error');
            exit;
        }

        $db = Database::getInstance();
        $file = fopen($_FILES['excel_file']['tmp_name'], 'r');
        
        // Omitir cabecera
        fgetcsv($file);

        try {
            $db->beginTransaction();
            $stmt = $db->prepare("INSERT INTO sample (code, status, id_project, id_user, analysis_cost) VALUES (?, ?, ?, ?, ?)");
            
            while (($row = fgetcsv($file)) !== FALSE) {
                // Ajustamos índices según el CSV exportado (omitiendo ID y created_at para que se generen)
                $stmt->execute([$row[1], $row[2], $row[3], $row[4], $row[5]]);
            }
            
            $db->commit();
            header('Location: /users?status=imported');
        } catch (\Exception $e) {
            $db->rollBack();
            header('Location: /users?status=error');
        }
        fclose($file);
        exit;
    }
}