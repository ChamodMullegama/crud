<?php
include "./Includes/navBar.php";
require './Includes/connection.php';

if (isset($_POST['edit_task'])) {
    $task_id = $_POST['task_id'];

    $database = new connection();
    try {
        $conn = $database->getConnection();

        $sql = "SELECT * FROM tasks WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $task_id);
        $stmt->execute();

        $task = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    header('Location: ./tasks_table.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    <form method="POST" action="./update.php">
        <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
        
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($task['username']); ?>" required>
        </div>
        
        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
        </div>
        
        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required><?php echo htmlspecialchars($task['description']); ?></textarea>
        </div>
        
        <div>
            <label for="date">Date:</label>
            <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($task['date']); ?>" required>
        </div>
        
        <div>
            <button type="submit" name="update_task">Update Task</button>
        </div>
    </form>
</body>
</html>
