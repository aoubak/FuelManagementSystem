<?php

include("view/partials/head.php");
include("includes/dbManager.php");


$passwordFill = '';
$passwordMatch = '';
$passwordSuccess = '';
$tokenInvalid = '';

// Check if form is submitted

if (isset($_POST['UpdatePassword'])) {

    // Database connection
    $conn = getConnection();

    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $token = $_POST['token'];


    // // Validate input
    // if (empty($_POST['new_password']) || empty($_POST['confirm_password'])) {
    //     $passwordFill = 'Please fill in all fields';
        
    // }

    // // Check if passwords match
    // if ($_POST['new_password'] !== $_POST['confirm_password']) {
    //     $passwordMatch = 'Passwords do not match';
        
    // }


    // Verify token
    // $token = $conn->real_escape_string($_POST['token']);

    // Check if token is valid and not expired
    $result = $conn->query("SELECT * FROM password_resets WHERE token = '$token' AND expires_at > NOW() AND used = 0");

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        // Verify password match
        if ($_POST['new_password'] === $_POST['confirm_password']) {
            // Update password
            $new_password = password_hash($new_password, PASSWORD_DEFAULT);
            $result = $conn->query("UPDATE Employees SET password = '$new_password' WHERE Email = '$email'");

            // Mark token as used
            $conn->query("UPDATE password_resets SET used = 1 WHERE token = '$token'");

            $passwordSuccess = 'Password updated successfully!';
            
        } else {
            // Passwords do not match
            $passwordMatch = 'Passwords do not match';
            
        }
    } else {
        // Token is invalid or expired
        $tokenInvalid = 'Invalid or expired token';
        
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
                                        <h1 class="h4 text-gray-900 mb-2">Reset Password</h1>
                                        <p class="mb-4">Please enter your new password below to reset your account password. Make sure to confirm it correctly.</p>
                                    </div>
                                    <?php
                                    if (empty($passwordMatch)) {
                                    } else {
                                    ?>
                                        <div class="alert alert-danger">
                                            <?php echo $passwordMatch; ?> </div>

                                    <?php }
                                    ?>
                                    <?php
                                    if (empty($passwordFill)) {
                                    } else {
                                    ?>
                                        <div class="alert alert-danger">
                                            <?php echo $passwordFill; ?> </div>

                                    <?php }
                                    ?>
                                    <?php
                                    if (empty($passwordSuccess)) {
                                    } else {
                                    ?>
                                        <div class="alert alert-success">
                                            <?php echo $passwordSuccess; ?> <strong><a href="login.php">Login!</a></strong></div>

                                    <?php }
                                    ?>
                                    <?php
                                    if (empty($tokenInvalid)) {
                                    } else {
                                    ?>
                                        <div class="alert alert-danger">
                                            <?php echo $tokenInvalid; ?></div>

                                    <?php }
                                    ?>



                                    <form class="use" action="reset-password.php" method="post">
                                        <input type="hidden" name="token" value="<?= isset($_GET['token']) ? htmlspecialchars($_GET['token']) : '' ?>">

                                        <div class="form-group">
                                            <input type="password" name="new_password" class="form-control form-control-user" placeholder="New password">

                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="confirm_password" class="form-control form-control-user" placeholder="Confirm password">

                                        </div>
                                        <button type="submit" name="UpdatePassword" class="btn btn-primary btn-user btn-block">Update Password</button>

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