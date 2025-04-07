<?php
session_start();
require_once 'config.php';

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    $redirect_page = $_SESSION['user_role'] === 'Staff' ? 'admin_dashboard.php' : 'user_dashboard.php';
    header("Location: $redirect_page");
    exit();
}

// Initialize variables
$username = $email = $password = $confirm_password = $role = '';
$errors = [];

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form values
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $role = trim($_POST['role']);

    // Validate username
    if (empty($username)) {
        $errors['username'] = 'Please enter a username.';
    }

    // Validate email
    if (empty($email)) {
        $errors['email'] = 'Please enter your email.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please enter a valid email address.';
    }

    // Validate password
    if (empty($password)) {
        $errors['password'] = 'Please enter a password.';
    } elseif (strlen($password) < 6) {
        $errors['password'] = 'Password must be at least 6 characters.';
    }

    // Confirm password
    if ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Passwords do not match.';
    }

    // Validate role
    if (empty($role)) {
        $errors['role'] = 'Please select a role.';
    }

    // If no errors, attempt to register
    if (empty($errors)) {
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);
            $stmt->execute();
            
            if ($stmt->affected_rows === 1) {
                header('Location: login.php');
                exit();
            } else {
                $errors['database'] = 'Failed to create account. Please try again.';
            }
        } catch (Exception $e) {
            $errors['database'] = 'Database error: ' . $e->getMessage();
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EquipmentSphere - Register</title>
    <style>
        * { box-sizing: border-box; }
        body { background-color: #1e293b; color: #f1f5f9; font-family: Arial, sans-serif; padding: 20px; }
        .container { max-width: 500px; margin: 50px auto; padding: 30px; background-color: #334155; border-radius: 10px; }
        h1 { text-align: center; margin-bottom: 30px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; }
        input, select { 
            width: 100%; 
            padding: 10px; 
            border-radius: 5px; 
            border: 1px solid #64748b; 
            background-color: #1e293b; 
            color: #f1f5f9; 
        }
        .error { color: #ef4444; font-size: 14px; margin-top: 5px; }
        button { 
            width: 100%; 
            padding: 12px; 
            background-color: #22c55e; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            font-size: 16px;
        }
        button:hover { background-color: #16a34a; }
        .login-link { text-align: center; margin-top: 20px; }
        a { color: #3b82f6; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .notification {
            padding: 15px;
            margin-bottom: 20px;
            background-color: #22c55e;
            color: white;
            border-radius: 5px;
            display: <?php echo isset($_GET['success']) ? 'block' : 'none'; ?>;
        }
        .notification.error {
            background-color: #ef4444;
            display: <?php echo !empty($errors) ? 'block' : 'none'; ?>;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        
        <!-- Success Notification -->
        <?php if (isset($_GET['success'])): ?>
            <div class="notification">Registration successful! Please login.</div>
        <?php endif; ?>
        
        <!-- Error Notification -->
        <?php if (!empty($errors)): ?>
            <div class="notification error">
                <?php 
                    foreach ($errors as $error) {
                        echo htmlspecialchars($error) . '<br>';
                    }
                ?>
            </div>
        <?php endif; ?>
        
        <form action="register.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                <?php if (isset($errors['username'])): ?>
                    <span class="error"><?php echo htmlspecialchars($errors['username']); ?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                <?php if (isset($errors['email'])): ?>
                    <span class="error"><?php echo htmlspecialchars($errors['email']); ?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <?php if (isset($errors['password'])): ?>
                    <span class="error"><?php echo htmlspecialchars($errors['password']); ?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
                <?php if (isset($errors['confirm_password'])): ?>
                    <span class="error"><?php echo htmlspecialchars($errors['confirm_password']); ?></span>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="">Select Role</option>
                    <option value="Student" <?php echo ($role === 'Student') ? 'selected' : ''; ?>>Student</option>
                    <option value="Staff" <?php echo ($role === 'Staff') ? 'selected' : ''; ?>>Staff</option>
                </select>
                <?php if (isset($errors['role'])): ?>
                    <span class="error"><?php echo htmlspecialchars($errors['role']); ?></span>
                <?php endif; ?>
            </div>
            
            <button type="submit">Register</button>
        </form>
        
        <div class="login-link">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>
</body>
</html>
