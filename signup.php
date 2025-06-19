<?php
// signup.php - Modified signup with OTP verification
include("frontend/session_start.php");
require 'connection.php';
require 'vendor/autoload.php'; // PHPMailer autoload

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$SuccessMsg = "";
$FailMsg = "";
$showOTPForm = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['signup_step']) && $_POST['signup_step'] == 'initial') {
        // Step 1: Initial signup form submission
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $firstName = trim($_POST['first_name']);
        $lastName = trim($_POST['last_name']);
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $address = trim($_POST['address']);
        $zipCode = trim($_POST['zip_postal_code']);
        $country = trim($_POST['country']);

        // Validate inputs
        if (empty($email) || empty($firstName) || empty($lastName) || empty($username) || empty($password)) {
            $FailMsg = "Please fill in all required fields.";
        } else {
            // Check if email already exists
            $checkEmail = "SELECT email FROM users WHERE email = ?";
            $stmt = $conn->prepare($checkEmail);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $FailMsg = "Email already exists! Please use a different email address.";
                $stmt->close();
            } else {
                $stmt->close();
                
                // Check if username already exists
                $checkUsername = "SELECT user_name FROM users WHERE user_name = ?";
                $stmt = $conn->prepare($checkUsername);
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    $FailMsg = "Username already exists! Please choose a different username.";
                    $stmt->close();
                } else {
                    $stmt->close();

                    // Generate OTP
                    $otp = rand(100000, 999999);
                    $otpExpiry = date('Y-m-d H:i:s', strtotime('+15 minutes')); // OTP expires in 15 minutes

                    // Store user data and OTP in session temporarily
                    $_SESSION['signup_data'] = [
                        'email' => $email,
                        'phone' => $phone,
                        'first_name' => $firstName,
                        'last_name' => $lastName,
                        'username' => $username,
                        'password' => $password,
                        'address' => $address,
                        'zip_postal_code' => $zipCode,
                        'country' => $country,
                        'otp' => $otp,
                        'otp_expiry' => $otpExpiry
                    ];

                    // Send OTP email
                    if (sendOTPEmail($email, $firstName, $otp)) {
                        $SuccessMsg = "OTP has been sent to your email address. Please check your inbox.";
                        $showOTPForm = true;
                    } else {
                        $FailMsg = "Failed to send OTP. Please try again.";
                    }
                }
            }
        }
    } 
    elseif (isset($_POST['signup_step']) && $_POST['signup_step'] == 'verify_otp') {
        // Step 2: OTP verification
        $enteredOTP = trim($_POST['otp']);
        
        if (!isset($_SESSION['signup_data'])) {
            $FailMsg = "Session expired. Please start the signup process again.";
        } else {
            $signupData = $_SESSION['signup_data'];
            $currentTime = date('Y-m-d H:i:s');
            
            // Check if OTP is expired
            if ($currentTime > $signupData['otp_expiry']) {
                $FailMsg = "OTP has expired. Please request a new one.";
                unset($_SESSION['signup_data']);
            } elseif ($enteredOTP != $signupData['otp']) {
                $FailMsg = "Invalid OTP. Please try again.";
                $showOTPForm = true;
            } else {
                // OTP is valid, proceed with user registration
                $userid = uniqid('user_');
                $hashed_password = password_hash($signupData['password'], PASSWORD_BCRYPT);

                $sql = "INSERT INTO users (userid, phone_number, address, zip_postal_code, country, first_name, last_name, user_name, email, password, status, email_verified) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'active', 1)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssssssss", 
                    $userid, 
                    $signupData['phone'], 
                    $signupData['address'], 
                    $signupData['zip_postal_code'], 
                    $signupData['country'], 
                    $signupData['first_name'], 
                    $signupData['last_name'], 
                    $signupData['username'], 
                    $signupData['email'], 
                    $hashed_password
                );

                if ($stmt->execute()) {
                    $SuccessMsg = "Account created successfully! Email verified.";
                    unset($_SESSION['signup_data']); // Clear session data
                    header('Location: login.php');
                    exit();
                } else {
                    $FailMsg = "Registration failed. Please try again.";
                }
                $stmt->close();
            }
        }
    }
    elseif (isset($_POST['resend_otp'])) {
        // Resend OTP
        if (isset($_SESSION['signup_data'])) {
            $signupData = $_SESSION['signup_data'];
            $newOTP = rand(100000, 999999);
            $newOTPExpiry = date('Y-m-d H:i:s', strtotime('+15 minutes'));
            
            $_SESSION['signup_data']['otp'] = $newOTP;
            $_SESSION['signup_data']['otp_expiry'] = $newOTPExpiry;
            
            if (sendOTPEmail($signupData['email'], $signupData['first_name'], $newOTP)) {
                $SuccessMsg = "New OTP has been sent to your email.";
                $showOTPForm = true;
            } else {
                $FailMsg = "Failed to resend OTP. Please try again.";
            }
        }
    }
}

// Check if we should show OTP form from session
if (isset($_SESSION['signup_data']) && !$showOTPForm && empty($FailMsg)) {
    $showOTPForm = true;
}

function sendOTPEmail($email, $firstName, $otp) {
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Change to your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your-email@gmail.com'; // Your email
        $mail->Password   = 'your-app-password'; // Your app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('your-email@gmail.com', 'Your Website Name');
        $mail->addAddress($email, $firstName);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification - OTP Code';
        
        $mail->Body = "
        <html>
        <head>
            <style>
                .container { font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; }
                .header { background-color: #4CAF50; color: white; padding: 20px; text-align: center; }
                .content { padding: 20px; }
                .otp-code { font-size: 24px; font-weight: bold; color: #4CAF50; text-align: center; margin: 20px 0; }
                .footer { background-color: #f1f1f1; padding: 10px; text-align: center; font-size: 12px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>Email Verification</h2>
                </div>
                <div class='content'>
                    <p>Hello $firstName,</p>
                    <p>Thank you for signing up! Please use the following OTP code to verify your email address:</p>
                    <div class='otp-code'>$otp</div>
                    <p>This code will expire in 15 minutes.</p>
                    <p>If you didn't request this verification, please ignore this email.</p>
                </div>
                <div class='footer'>
                    <p>This is an automated message, please do not reply.</p>
                </div>
            </div>
        </body>
        </html>";

        $mail->AltBody = "Hello $firstName,\n\nYour OTP code is: $otp\n\nThis code will expire in 15 minutes.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
        return false;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Create Your Account</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="index.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg,rgb(253, 253, 255) 0%,rgb(224, 239, 224) 100%);
            min-height: 100vh;
            padding: 20px 0;
        }

        .signup-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .signup-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 600px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .signup-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .signup-header h2 {
            color: #2d3748;
            font-weight: 700;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .signup-header p {
            color: #718096;
            font-size: 16px;
            margin: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #2d3748;
            font-size: 14px;
        }

        .required {
            color: #e53e3e;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #ffffff;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control.error {
            border-color: #e53e3e;
        }

        .error-message {
            color: #e53e3e;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .row {
            margin-left: -10px;
            margin-right: -10px;
        }

        .row .col-md-6 {
            padding-left: 10px;
            padding-right: 10px;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg,rgb(48, 151, 137) 0%,rgb(153, 182, 183) 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #764ba2;
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        .alert-success {
            background: linear-gradient(135deg, #48bb78, #38a169);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f56565, #e53e3e);
            color: white;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            z-index: 10;
        }

        .password-toggle {
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #667eea;
        }

        @media (max-width: 768px) {
            .signup-container {
                padding: 30px 20px;
                margin: 10px;
            }

            .signup-header h2 {
                font-size: 24px;
            }

            .row .col-md-6 {
                margin-bottom: 0;
            }
        }

        @media (max-width: 576px) {
            body {
                padding: 10px 0;
            }
            
            .signup-wrapper {
                padding: 10px;
                min-height: auto;
            }

            .signup-container {
                padding: 20px 15px;
            }
        }
    </style>
</head>

<body>
<?php include("frontend/header.php"); ?>

<div class="signup-wrapper">
    <div class="signup-container">
        <div class="signup-header">
            <h2><i class="fas fa-user-plus"></i> Create Account</h2>
            <p>Join us today and get started with your journey</p>
        </div>

        <?php if (!empty($SuccessMsg)): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo $SuccessMsg; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($FailMsg)): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> <?php echo $FailMsg; ?>
            </div>
        <?php endif; ?>

        <form id="signupForm" method="post" novalidate>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name" class="form-label">First Name <span class="required">*</span></label>
                        <input type="text" id="first_name" name="first_name" class="form-control" placeholder="Enter first name" required>
                        <span id="firstNameError" class="error-message"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="last_name" class="form-label">Last Name <span class="required">*</span></label>
                        <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Enter last name" required>
                        <span id="lastNameError" class="error-message"></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="username" class="form-label">Username <span class="required">*</span></label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Choose a unique username" required>
                <span id="usernameError" class="error-message"></span>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address <span class="required">*</span></label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter email address" required>
                        <span id="emailError" class="error-message"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone" class="form-label">Phone Number <span class="required">*</span></label>
                        <input type="tel" id="phone" name="phone" class="form-control" placeholder="Enter phone number" required>
                        <span id="phoneError" class="error-message"></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="address" class="form-label">Address</label>
                <input type="text" id="address" name="address" class="form-control" placeholder="Enter your address (optional)">
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="zip_postal_code" class="form-label">ZIP/Postal Code</label>
                        <input type="text" id="zip_postal_code" name="zip_postal_code" class="form-control" placeholder="Enter ZIP/Postal code">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="country" class="form-label">Country</label>
                        <select id="country" name="country" class="form-control">
                            <option value="">Select Country</option>
                            <option value="Nepal">Nepal</option>
                            <option value="India">India</option>
                            <option value="United States">United States</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="Canada">Canada</option>
                            <option value="Australia">Australia</option>
                            <option value="Germany">Germany</option>
                            <option value="France">France</option>
                            <option value="Japan">Japan</option>
                            <option value="China">China</option>
                            <!-- Add more countries as needed -->
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password" class="form-label">Password <span class="required">*</span></label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control" placeholder="Create password" required>
                            <i class="fas fa-eye password-toggle" onclick="togglePassword('password')" id="passwordIcon"></i>
                        </div>
                        <span id="passwordError" class="error-message"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cpassword" class="form-label">Confirm Password <span class="required">*</span></label>
                        <div class="input-group">
                            <input type="password" id="cpassword" name="cpassword" class="form-control" placeholder="Confirm password" required>
                            <i class="fas fa-eye password-toggle" onclick="togglePassword('cpassword')" id="cpasswordIcon"></i>
                        </div>
                        <span id="confirmPasswordError" class="error-message"></span>
                    </div>
                </div>
            </div>

            <button type="submit" class="submit-btn">
                <i class="fas fa-user-plus"></i> Create Account
            </button>
        </form>

        <div class="login-link">
            Already have an account? <a href="login.php"><i class="fas fa-sign-in-alt"></i> Log In</a>
        </div>
    </div>
</div>

<?php include("frontend/footer.php"); ?>
<?php include("frontend/scrollup.html"); ?>

<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(fieldId + 'Icon');
        
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    document.getElementById('signupForm').addEventListener('submit', function (event) {
        let isValid = true;

        // Clear previous error messages and styles
        const errorElements = document.querySelectorAll('.error-message');
        const inputElements = document.querySelectorAll('.form-control');
        
        errorElements.forEach(el => el.textContent = '');
        inputElements.forEach(el => el.classList.remove('error'));

        // Validate First Name
        const firstName = document.getElementById('first_name').value.trim();
        if (!firstName) {
            showError('first_name', 'firstNameError', 'First name is required.');
            isValid = false;
        } else if (firstName.length < 2) {
            showError('first_name', 'firstNameError', 'First name must be at least 2 characters long.');
            isValid = false;
        }

        // Validate Last Name
        const lastName = document.getElementById('last_name').value.trim();
        if (!lastName) {
            showError('last_name', 'lastNameError', 'Last name is required.');
            isValid = false;
        } else if (lastName.length < 2) {
            showError('last_name', 'lastNameError', 'Last name must be at least 2 characters long.');
            isValid = false;
        }

        // Validate Username
        const username = document.getElementById('username').value.trim();
        if (!username) {
            showError('username', 'usernameError', 'Username is required.');
            isValid = false;
        } else if (username.length < 3) {
            showError('username', 'usernameError', 'Username must be at least 3 characters long.');
            isValid = false;
        } else if (!/^[a-zA-Z0-9_]+$/.test(username)) {
            showError('username', 'usernameError', 'Username can only contain letters, numbers, and underscores.');
            isValid = false;
        }

        // Validate Email
        const email = document.getElementById('email').value.trim();
        if (!email) {
            showError('email', 'emailError', 'Email address is required.');
            isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            showError('email', 'emailError', 'Please enter a valid email address.');
            isValid = false;
        }

        // Validate Phone
        const phone = document.getElementById('phone').value.trim();
        if (!phone) {
            showError('phone', 'phoneError', 'Phone number is required.');
            isValid = false;
        } else if (!/^[\+]?[\d\s\-\(\)]{10,}$/.test(phone)) {
            showError('phone', 'phoneError', 'Please enter a valid phone number.');
            isValid = false;
        }

        // Validate Password
        const password = document.getElementById('password').value.trim();
        if (!password) {
            showError('password', 'passwordError', 'Password is required.');
            isValid = false;
        } else if (password.length < 8) {
            showError('password', 'passwordError', 'Password must be at least 8 characters long.');
            isValid = false;
        } else if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)/.test(password)) {
            showError('password', 'passwordError', 'Password must contain at least one uppercase letter, one lowercase letter, and one number.');
            isValid = false;
        }

        // Validate Confirm Password
        const cpassword = document.getElementById('cpassword').value.trim();
        if (!cpassword) {
            showError('cpassword', 'confirmPasswordError', 'Please confirm your password.');
            isValid = false;
        } else if (cpassword !== password) {
            showError('cpassword', 'confirmPasswordError', 'Passwords do not match.');
            isValid = false;
        }

        // Prevent form submission if validation fails
        if (!isValid) {
            event.preventDefault();
            // Scroll to first error
            const firstError = document.querySelector('.form-control.error');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });

    function showError(inputId, errorId, message) {
        document.getElementById(inputId).classList.add('error');
        document.getElementById(errorId).textContent = message;
    }

    // Real-time validation
    document.getElementById('email').addEventListener('blur', function() {
        const email = this.value.trim();
        if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            showError('email', 'emailError', 'Please enter a valid email address.');
        } else {
            this.classList.remove('error');
            document.getElementById('emailError').textContent = '';
        }
    });

    document.getElementById('username').addEventListener('blur', function() {
        const username = this.value.trim();
        if (username && !/^[a-zA-Z0-9_]+$/.test(username)) {
            showError('username', 'usernameError', 'Username can only contain letters, numbers, and underscores.');
        } else {
            this.classList.remove('error');
            document.getElementById('usernameError').textContent = '';
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>