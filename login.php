<?php
session_start();

// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'patient';

// Establishing a connection to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user data from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the entered username and password match the database
    $stmt = $pdo->prepare("SELECT * FROM patients WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Login successful, store user data in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_username'] = $user['username'];

        // Redirect to a certain page (e.g., dashboard.php)
        header("Location: dashboard.php");
        exit();
    } else {
        // Login failed, display an error message
        $loginError = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        form {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<!-- HTML form for login -->
<form method="post" action="">
    <label for="username">Username:</label>
    <input type="text" name="username" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <input type="submit" value="Login">

    <?php if (isset($loginError)) : ?>
        <div class="error"><?php echo $loginError; ?></div>
    <?php endif; ?>

    <input type="button" value="Back to Home" onclick="redirectToHome()">
    
    <div class="signup-link">
        <p>Not created an account? <a href="signup.php">Signup now</a></p>
    </div>
</form>
<script>
    function redirectToHome() {
    // Redirect to index.php
    window.location.href = 'index.php';
}
    </script>
</form>

</body>
</html>
