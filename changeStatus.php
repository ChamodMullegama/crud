<?php
require './Includes/connection.php';


if (isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];

    $database = new connection();
    try {
        $conn = $database->getConnection();


        $sql = "SELECT status FROM tasks WHERE id = :task_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':task_id', $task_id, PDO::PARAM_INT);
        $stmt->execute();
        $currentStatus = $stmt->fetch(PDO::FETCH_ASSOC)['status'];


        $newStatus = $currentStatus == 1 ? 0 : 1;


        $sql = "UPDATE tasks SET status = :new_status WHERE id = :task_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':new_status', $newStatus, PDO::PARAM_INT);
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
