<?php
include "./Includes/navBar.php";
require './Includes/connection.php';

$database = new connection();
try {
    $conn = $database->getConnection();

    $sql = "SELECT * FROM tasks";
    $stmt = $conn->query($sql);
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks Table</title>
    <link rel="stylesheet" href="./style/table.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <section class="table">
        <?php
        session_start();
        if (isset($_SESSION['success'])) {
            echo '<div class="login-status-message-success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo '<div class="login-status-message-error">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        ?>
        <table border="3">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($task['username']); ?></td>
                        <td><?php echo htmlspecialchars($task['title']); ?></td>
                        <td><?php echo htmlspecialchars($task['description']); ?></td>
                        <td><?php echo htmlspecialchars($task['date']); ?></td>
                        <td class="<?php echo $task['status'] == 1 ? 'complete' : 'uncomplete'; ?>">
                            <?php echo $task['status'] == 1 ? 'Complete' : 'Uncomplete'; ?>
                        </td>
                        <td>
                            <form method="POST" action="edit_task_form.php" style="display:inline;">
                                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                                <button type="submit" name="edit_task" style="background-color: blue; display:inline;">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                            </form>
                            <form method="POST" action="./delete.php" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this task?');">
                                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                                <button type="submit" name="delete_task" class="delete-button">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                            <form method="POST" action="./changeStatus.php" style="display:inline;">
                                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                                <button type="submit" name="change_status" class="status-button">
                                    <?php if ($task['status'] == 1) : ?>
                                        <i class="fas fa-stop"></i>
                                    <?php else : ?>
                                        <i class="fas fa-check"></i>
                                    <?php endif; ?>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</body>

</html>