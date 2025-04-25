<?php
date_default_timezone_set('Asia/Kolkata');


error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);


include("view/partials/head.php");
include("includes/dbManager.php");

// reset password
// Send email (using PHPMailer example)
require 'vendor/PHPMailer/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/PHPMailer/src/SMTP.php';
require 'vendor/PHPMailer/PHPMailer/src/Exception.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
// Load Composer's autoloader

require 'vendor/autoload.php';

$emailCheck = '';
$emailError = '';
$emailSent = '';




if (isset($_POST['resetPassword'])) {

    // Create connection
    $conn = getConnection();

    // Check email exists
    // $email = $conn->real_escape_string($_POST['email']);

    $email = $_POST['email'];
    // Check if email is empty
    if (empty($email)) {
        $emailError = 'Email is required';
    }
    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Invalid email format';
    }
    // Check if email exists in the database
    $result = $conn->query("SELECT * FROM employees WHERE Email = '$email'");

    // Email exists, proceed with password reset
    if ($result->num_rows > 0) {

        // Generate token
        $token = bin2hex(random_bytes(50));
        $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

        // Store token in database
        $conn->query("INSERT INTO password_resets (email, token, expires_at) 
                 VALUES ('$email', '$token', '$expires')");



        // Create instance
        $mail = new PHPMailer(true);
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'aoubak01@gmail.com';
        $mail->Password = 'xwbv eosm ilkz jpsk';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('noreply@somoil.com', 'Somoil');
        $mail->addAddress($email);
        $mail->Subject = 'Password Reset Link';
        // Send HTML formatted email
        $mail->isHTML(true);

        // $mail->Body = "Click here to reset your password:http://http://localhost/fms/reset-password.php?token=$token";
        $mail->Body = "
                    <html>
                    <head>
                    <style>
                        .container {
                        max-width: 600px;
                        margin: 30px auto;
                        padding: 20px;
                        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        border: 1px solid #ddd;
                        border-radius: 10px;
                        background-color: #f9f9f9;
                        }
                        .btn {
                        display: inline-block;
                        padding: 12px 25px;
                        font-size: 16px;
                        background-color: #007bff;
                        color: white;
                        text-decoration: none;
                        border-radius: 5px;
                        margin-top: 20px;
                        cursor: pointer;
                        
                        }
                        .btn:hover {
                        color: white;
                        background-color: #0056b3;
                        }
                        .note {
                        font-size: 14px;
                        color: #dc3545;
                        margin-top: 15px;
                        }
                        .footer {
                        margin-top: 30px;
                        font-size: 12px;
                        color: #888;
                        }
                    </style>
                    </head>
                    <body>
                    <div class='container'>
                        <h2>Password Reset Request</h2>
                        <p>Hello,</p>
                        <p>We received a request to reset your password for your Somoil FMS account.</p>
                        <p>Please click the button below to reset your password:</p>
                        <a href='http://localhost/fms/reset-password.php?token=$token' class='btn '>Reset Password</a>
                        <p class='note'>⚠️ This link will expire in 1 hour for your security.</p>
                        <p>If you did not request this, you can safely ignore this email.</p>
                        <div class='footer'>
                        &copy; " . date('Y') . " Somoil FMS. All rights reserved.
                        </div>
                    </div>
                    </body>
                    </html>";

        if (!$mail->send()) {
            $emailError = 'Message could not be sent.';
        } else {
            $emailSent = 'Reset link has been sent to your email';
        }
    } else {
        $emailCheck = 'Email not found in our system';
    }
}




?>




<body class="bg-gradient-primary">

    <div class="container">



        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <?php
                                    if (empty($emailError)) {
                                    } else {
                                    ?>
                                        <div class="alert alert-danger">
                                            
                                            <?php echo $emailError; ?> </div>

                                    <?php }
                                    ?>

                                    <?php
                                    if (empty($emailSent)) {
                                    } else {
                                    ?>
                                        <div class="alert alert-success">
                                            <?php echo $emailSent; ?> </div>

                                    <?php }
                                    ?>
                                    <?php
                                    if (empty($emailCheck)) {
                                    } else {
                                    ?>
                                        <div class="alert alert-danger">
                                            <?php echo $emailCheck; ?> </div>

                                    <?php }
                                    ?>
                                    <form class="use" action="forgot-password.php" method="POST">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <button type="submit" name="resetPassword" class="btn btn-primary btn-user btn-block">Reset Password</button>
                                        <!-- <a href="" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </a> -->
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>