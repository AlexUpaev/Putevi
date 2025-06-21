<?php
require_once "db_connect.php";

define('ENCRYPTION_KEY', 'ваш_секретный_ключ_шифрования_32_символа');

function get_all_projects() {
    global $pdo;
    
    try {
        $stmt = $pdo->query("
            SELECT p.*
            FROM projects p
            ORDER BY p.status, p.end_date DESC
        ");
        $projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($projects as &$project) {
            $project['images'] = get_project_images($project['id_project']);
        }
        
        return $projects;
    } catch (PDOException $e) {
        error_log("Ошибка при получении проектов: " . $e->getMessage());
        return [];
    }
}

function get_project_images($project_id) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("
            SELECT id_image, file_name, mime_type
            FROM images 
            WHERE project_id = ?
        ");
        $stmt->execute([$project_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Ошибка при получении изображений: " . $e->getMessage());
        return [];
    }
}

function add_project_image($project_id, $file) {
    global $pdo;
    
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $max_size = 5 * 1024 * 1024;
    
    if (!in_array($file['type'], $allowed_types)) {
        return ['error' => 'Недопустимый тип файла'];
    }
    
    if ($file['size'] > $max_size) {
        return ['error' => 'Файл слишком большой'];
    }
    
    $image_data = file_get_contents($file['tmp_name']);
    if ($image_data === false) {
        return ['error' => 'Ошибка чтения файла'];
    }
    
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted_data = openssl_encrypt($image_data, 'aes-256-cbc', ENCRYPTION_KEY, 0, $iv);
    
    try {
        $stmt = $pdo->prepare("
            INSERT INTO images (project_id, image_data, iv, mime_type, file_name) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $project_id,
            $encrypted_data,
            $iv,
            $file['type'],
            $file['name']
        ]);
        
        return ['success' => true, 'image_id' => $pdo->lastInsertId()];
    } catch (PDOException $e) {
        error_log("Ошибка при добавлении изображения: " . $e->getMessage());
        return ['error' => 'Ошибка базы данных'];
    }
}

function get_image_data($image_id) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("
            SELECT image_data, iv, mime_type 
            FROM images 
            WHERE id_image = ?
        ");
        $stmt->execute([$image_id]);
        $image = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($image) {
            $decrypted_data = openssl_decrypt(
                $image['image_data'], 
                'aes-256-cbc', 
                ENCRYPTION_KEY, 
                0, 
                $image['iv']
            );
            
            if ($decrypted_data !== false) {
                return [
                    'data' => $decrypted_data,
                    'mime' => $image['mime_type']
                ];
            }
        }
        
        return null;
    } catch (PDOException $e) {
        error_log("Ошибка при получении изображения: " . $e->getMessage());
        return null;
    }
}

function create_thumbnail($image_data, $mime_type, $width, $height) {
    $src_image = imagecreatefromstring($image_data);
    if (!$src_image) return false;
    
    $thumb = imagecreatetruecolor($width, $height);
    
    if ($mime_type == 'image/png' || $mime_type == 'image/gif') {
        imagecolortransparent($thumb, imagecolorallocatealpha($thumb, 0, 0, 0, 127));
        imagealphablending($thumb, false);
        imagesavealpha($thumb, true);
    }
    
    imagecopyresampled($thumb, $src_image, 0, 0, 0, 0, $width, $height, 
                      imagesx($src_image), imagesy($src_image));
    
    ob_start();
    switch($mime_type) {
        case 'image/jpeg': imagejpeg($thumb, null, 90); break;
        case 'image/png': imagepng($thumb, null, 9); break;
        case 'image/gif': imagegif($thumb); break;
    }
    $thumbnail_data = ob_get_clean();
    
    imagedestroy($src_image);
    imagedestroy($thumb);
    
    return $thumbnail_data;
}
?>