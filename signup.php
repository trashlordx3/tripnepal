<?php
session_start();
require_once __DIR__ . '/connection.php';

$SuccessMsg = "";
$FailMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['cpassword']);
    $address = trim($_POST['address']);
    $zipCode = trim($_POST['zip_postal_code']);
    $country = trim($_POST['country']);

    if (empty($email) || empty($firstName) || empty($lastName) || empty($username) || empty($password) || empty($phone) || empty($confirmPassword)) {
        $FailMsg = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $FailMsg = "Invalid email format.";
    } elseif (strlen($password) < 8) {
        $FailMsg = "Password must be at least 8 characters.";
    } elseif ($password !== $confirmPassword) {
        $FailMsg = "Passwords do not match.";
    } else {
        $checkEmail = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $checkEmail->store_result();

        if ($checkEmail->num_rows > 0) {
            $FailMsg = "Email already exists!";
        } else {
            $checkUsername = $conn->prepare("SELECT user_name FROM users WHERE user_name = ?");
            $checkUsername->bind_param("s", $username);
            $checkUsername->execute();
            $checkUsername->store_result();

            if ($checkUsername->num_rows > 0) {
                $FailMsg = "Username already exists!";
            } else {
                $userid = uniqid('user_');
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                $stmt = $conn->prepare("INSERT INTO users (
                    userid, phone_number, address, zip_postal_code, country,
                    first_name, last_name, user_name, email, password,
                    profilepic, status, email_verified
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '', 'active', 1)");

                $stmt->bind_param(
                    "ssssssssss",
                    $userid, $phone, $address, $zipCode, $country,
                    $firstName, $lastName, $username, $email, $hashed_password
                );

                if ($stmt->execute()) {
                    $SuccessMsg = "Account created successfully! Redirecting to login...";
                    header("refresh:3;url=login.php");
                } else {
                    $FailMsg = "Registration failed: " . $stmt->error;
                }

                $stmt->close();
            }
            $checkUsername->close();
        }

        $checkEmail->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup - Thank You Nepal Trip</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
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

        .signup-card {
            width: 100%;
            max-width: 650px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgb(0 0 0 / 0.1);
            padding: 2rem 2rem 2.5rem;
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

        .btn-signup {
            background: linear-gradient(135deg, #309789 0%, #99b6b7 100%);
            font-weight: 600;
        }

        .btn-signup:hover {
            background-color: #008c7a;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 1rem;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
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
            z-index: 2;
        }

        .input-icon input {
            padding-right: 2.5rem;
        }

    </style>
</head>
<body>

<div class="signup-card shadow-sm">
    <a href="index.php" class="btn-close" aria-label="Close"></a>

    <h2>Create Account</h2>

    <?php if (!empty($SuccessMsg)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($SuccessMsg) ?></div>
    <?php endif; ?>
    <?php if (!empty($FailMsg)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($FailMsg) ?></div>
    <?php endif; ?>

    <form method="POST" novalidate>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="first_name" class="form-label">First Name *</label>
                <input type="text" name="first_name" id="first_name" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="last_name" class="form-label">Last Name *</label>
                <input type="text" name="last_name" id="last_name" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="username" class="form-label">Username *</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email *</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone *</label>
            <input type="text" name="phone" id="phone" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" id="address" class="form-control">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="zip_postal_code" class="form-label">ZIP / Postal Code</label>
                <input type="text" name="zip_postal_code" id="zip_postal_code" class="form-control">
            </div>
            <div class="col-md-6 mb-3">
                <label for="country" class="form-label">Country</label>
                <input type="text" name="country" id="country" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password *</label>
                <div class="input-icon">
                    <input type="password" name="password" id="password" class="form-control" required minlength="8">
                    <i class="fa fa-eye" id="togglePass1" onclick="togglePassword('password', 'togglePass1')"></i>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="cpassword" class="form-label">Confirm Password *</label>
                <div class="input-icon">
                    <input type="password" name="cpassword" id="cpassword" class="form-control" required>
                    <i class="fa fa-eye" id="togglePass2" onclick="togglePassword('cpassword', 'togglePass2')"></i>
                </div>
            </div>
        </div>



        <div class="d-grid">
            <button type="submit" class="btn btn-signup">Create Account</button>
        </div>

        <p class="text-center mt-3">
            Already have an account? <a href="login.php" class="text-primary text-decoration-none">Login</a>
        </p>
    </form>
</div>

<!-- Toggle Password Script -->
<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
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
