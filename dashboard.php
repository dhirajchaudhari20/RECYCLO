<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_username'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Retrieve user information from the session
$userID = $_SESSION['user_id'];
$username = $_SESSION['user_username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .dashboard {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .welcome-message {
            margin-bottom: 20px;
        }

        .logout-button {
            background-color: #ff6347;
            color: #fff;
            cursor: pointer;
            padding: 10px;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .logout-button:hover {
            background-color: #d63a2f;
        }
    </style>
</head>
<body>

<!-- Dashboard content -->
<div class="dashboard">
    <div class="welcome-message">
        <p>Welcome, <?php echo $username; ?>!</p>
    </div>

    <form method="post" action="logout.php">
        <button type="submit" class="logout-button">Logout</button>
    </form>
</div>

</body>
</html>
