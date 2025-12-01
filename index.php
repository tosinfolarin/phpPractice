<?php
// Handle form submission
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Collect and sanitize input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = trim($_POST['password']);

    // Simple validation
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    // If no errors → success message
    if (empty($errors)) {
        $success = "Signup successful! (Mock — no database yet)";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mock Signup Form</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .container { max-width: 400px; margin: auto; }
        input { width: 100%; padding: 10px; margin-top: 5px; }
        .error { color: red; }
        .success { color: green; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <h2>Create an Account</h2>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <ul>
                <?php foreach ($errors as $e): ?>
                    <li><?= $e ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <p class="success"><?= $success ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <label>Name</label>
        <input type="text" name="name" placeholder="Enter your name">

        <label>Email</label>
        <input type="email" name="email" placeholder="Enter your email">

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter a password">

        <br><br>
        <button type="submit">Sign Up</button>
    </form>
</div>

</body>
</html>