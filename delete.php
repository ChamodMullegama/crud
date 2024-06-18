<?php
require './Includes/connection.php';
session_start();

if (isset($_POST['delete_task'])) {
    $task_id = $_POST['task_id'];

    $database = new connection();

    try {
        $conn = $database->getConnection();

        $delete_sql = "DELETE FROM tasks WHERE id = :id";
        $stmt = $conn->prepare($delete_sql);

        $stmt->bindParam(':id', $task_id);

        $stmt->execute();

        $_SESSION['success'] = 'Task deleted successfully.';
        header('Location: ./read.php');
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Error: Form data not submitted.';
}
