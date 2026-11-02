<?php
require_once 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil status saat ini
    $stmt = $pdo->prepare("SELECT status FROM tasks WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $task = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($task) {
        $newStatus = ($task['status'] === 'completed') ? 'pending' : 'completed';
        
        $updateStmt = $pdo->prepare("UPDATE tasks SET status = :status WHERE id = :id");
        $updateStmt->execute([
            'status' => $newStatus,
            'id' => $id
        ]);
    }
}

header("Location: index.php");
exit();
?>