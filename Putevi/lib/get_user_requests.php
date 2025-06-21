<?php
function get_user_requests($user_id) {
    try {
        require "db_connect.php";
        
        $stmt = $pdo->prepare("
            SELECT id_request, date_of_submission, request_type, application_status 
            FROM requests 
            WHERE user_id = ? 
            ORDER BY date_of_submission DESC
        ");
        $stmt->execute([$user_id]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Ошибка при получении заявок пользователя: " . $e->getMessage());
        return [];
    }
}
?>