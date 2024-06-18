<?php
require './Includes/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['task_id'])) {
        $task_id = $_POST['task_id'];

        $database = new connection();
        try {
            $conn = $database->getConnection();

            $sql = "UPDATE tasks SET status = 1 WHERE id = :task_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                session_start();
                $_SESSION['success'] = "Task status updated successfully.";
            } else {
                session_start();
                $_SESSION['error'] = "Failed to update task status.";
            }
        } catch (PDOException $e) {
            session_start();
            $_SESSION['error'] = 'Error: ' . $e->getMessage();
        }

        header('Location: ./read.php');
        exit();
    }
}
