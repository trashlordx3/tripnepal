<?php
session_start();
require 'connection.php';

$failMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($email) || empty($password)) {
        $failMsg = "Both email and password are required.";
    } else {
        $stmt = $conn->prepare("SELECT userid, email, password, status FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if ($user['status'] !== 'active') {
                $failMsg = "Your account is not active. Please contact support.";
            } elseif (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['userid'];
                $_SESSION['email'] = $user['email'];

                // Redirect to user dashboard or account page
                header("Location: my-account.php");
                exit();
            } else {
                $failMsg = "Incorrect password.";
            }
        } else {
            $failMsg = "No account found with that email.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Login - Thank You Nepal Trip</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        body {
            background: linear-gradient(135deg, #fdfdff 0%, #e0efe0 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Roboto", sans-serif;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgb(0 0 0 / 0.1);
            padding: 2.5rem 2rem 3rem;
            position: relative;
        }

        .btn-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
        }

        h2 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            color: #2d3748;
        }

        .btn-login {
            background: linear-gradient(135deg, #309789 0%, #99b6b7 100%);
            font-weight: 600;
        }

        .btn-login:hover {
            background-color: #008c7a;
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }

        .input-icon input {
            padding-right: 2.5rem;
        }
    </style>
</head>
<body>

<div class="login-card shadow-sm">
    <a href="index.php" class="btn-close" aria-label="Close"></a>

    <h2>Login</h2>

    <?php if ($failMsg): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($failMsg) ?></div>
    <?php endif; ?>

    <form method="post" novalidate>
        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required />
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
            <div class="input-icon">
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" minlength="6" required />
                <i class="fa fa-eye" id="togglePassword" onclick="togglePasswordVisibility()"></i>
            </div>
        </div>

        <button type="submit" class="btn btn-login w-100">Login</button>
    </form>

    <div class="mt-4 text-center">
        Don't have an account? <a href="signup.php" class="text-primary text-decoration-none">Sign Up</a>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        const input = document.getElementById("password");
        const icon = document.getElementById("togglePassword");
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
