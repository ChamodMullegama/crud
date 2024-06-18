<?php include "./Includes/navBar.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/style.css">
</head>

<body>
    <form action="./create.php" method="post">
        <div>
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
        </div>
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required placeholder="Enter Username">
        </div>
        <div>
            <label for="title">Task Title:</label>
            <input type="text" id="title" name="title" required placeholder="Enter Title">
        </div>
        <div>
            <label for="description">Task Description:</label>
            <textarea id="description" name="description" required placeholder="Enter Description"></textarea>
        </div>
        <div>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>
        </div>
        <div>
            <button type="submit" name="submit">Submit</button>
        </div>
    </form>
</body>

</html>