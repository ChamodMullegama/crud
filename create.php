<?php

require './Includes/connection.php';
session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    $database = new connection();

    try {
        $conn = $database->getConnection();

        $insert_sql = "INSERT INTO tasks (username, title, description, date) VALUES (:username, :title, :description, :date)";
        $stmt = $conn->prepare($insert_sql);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':date', $date);

        $stmt->execute();

        $_SESSION['success'] = 'Task added successfully.';
        header('Location: ./read.php');
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'Error: Form data not submitted.';
}
