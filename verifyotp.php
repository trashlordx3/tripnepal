<?php
session_start();
require_once __DIR__ . '/connection.php';
require_once __DIR__ . '/phpmailer.php';

$SuccessMsg = "";
$FailMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['signup_data'])) {
        $FailMsg = "Session expired. Please start the signup process again.";
    } else {
        $signupData = $_SESSION['signup_data'];
        $currentTime = date('Y-m-d H:i:s');

        if ($signupData['attempts'] >= 3) {
            $FailMsg = "Too many OTP attempts. Please start over.";
            unset($_SESSION['signup_data']);
        } elseif ($currentTime > $signupData['otp_expiry']) {
            $FailMsg = "OTP has expired. Please request a new one.";
            unset($_SESSION['signup_data']);
        } else {
            $enteredOTP = trim($_POST['otp']);

            if ($enteredOTP == $signupData['otp']) {
                $userid = uniqid('user_');
                $hashed_password = password_hash($signupData['password'], PASSWORD_BCRYPT);

                $stmt = $conn->prepare("INSERT INTO users (userid, phone_number, address, zip_postal_code, country, first_name, last_name, user_name, email, password, status, email_verified, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'active', 1, NOW())");
                $stmt->bind_param("ssssssssss", $userid, $signupData['phone'], $signupData['address'], $signupData['zip_postal_code'], $signupData['country'], $signupData['first_name'], $signupData['last_name'], $signupData['username'], $signupData['email'], $hashed_password);

                if ($stmt->execute()) {
                    $SuccessMsg = "Account created successfully! Redirecting...";
                    sendWelcomeEmail($signupData['email'], $signupData['first_name']);
                    unset($_SESSION['signup_data']);
                    header("refresh:3;url=login.php");
                } else {
                    $FailMsg = "Registration failed: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $_SESSION['signup_data']['attempts']++;
                $remaining = 3 - $_SESSION['signup_data']['attempts'];
                $FailMsg = "Invalid OTP. $remaining attempts remaining.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card mx-auto p-4" style="max-width: 500px;">
        <h4 class="mb-3">OTP Verification</h4>
        <?php if (!empty($SuccessMsg)) echo '<div class="alert alert-success">'.$SuccessMsg.'</div>'; ?>
        <?php if (!empty($FailMsg)) echo '<div class="alert alert-danger">'.$FailMsg.'</div>'; ?>
        <a href="signup.php" class="btn btn-secondary mt-2">Back to Signup</a>
    </div>
</div>
</body>
</html>
