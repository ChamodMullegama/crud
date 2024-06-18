<?php
require './Includes/connection.php';
session_start();

if (isset($_POST['update_task'])) {
    $task_id = $_POST['task_id'];
    $username = $_POST['username'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    $database = new connection();

    try {
        $conn = $database->getConnection();

        $update_sql = "UPDATE tasks SET username = :username, title = :title, description = :description, date = :date WHERE id = :id";
        $stmt = $conn->prepare($update_sql);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':id', $task_id);

        $stmt->execute();

        $_SESSION['success'] = 'Task updated successfully.';
        header('Location: ./read.php');
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Error: Form data not submitted.';
}
