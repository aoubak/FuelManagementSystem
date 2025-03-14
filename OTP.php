<?php
// session_start();

function getConnection(
    $host = "localhost",
    $user = "root",
    $password = "",
    $databasename = "fms"
) {
    $conn = new mysqli($host, $user, $password, $databasename);
    if ($conn->connect_error) {
        echo "Error connecting to Database. $conn->connect_error with error: $conn->connect_error ";
        return false;
    }
    return $conn;
}

if (isset($_COOKIE['email']) &&  isset($_COOKIE['password'])) {
    $id = $_COOKIE['email'];
    $pass = $_COOKIE['password'];
} else {
    $id = "";
    $pass = "";
}

$emailError = "";
$passwordError = "";
$email = "";
$password = "";
$ErrorEmailPass = "";


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        $emailError = "Email is required";
    }
    if (empty($password)) {
        $passwordError = "Password is required";
    } elseif (empty($email) == false && empty($password) == false) {

        $conn = getConnection();
        $result = $conn->query("SELECT * FROM employees WHERE email ='$email' AND `password` = '$password' ");
        if (mysqli_num_rows($result) > 0) {

            session_start();
            $row = $result->fetch_assoc();
            $_SESSION['EmployeeID'] = $row['EmployeeID'];
            $_SESSION['Role'] = $row['Role'];

            if (isset($_POST['remember_me'])) {
                setcookie('email', $_POST['email'], time() + (60 * 60 * 24));
                setcookie('password', $_POST['password'], time() + (60 * 60 * 24));
            }

            header("location:index.php");
            exit();
        } else {
            // $_SESSION['status'] = "No Username or Password found";
            //  $ErrorEmailPass= "No Username or Password found";
            $ErrorEmailPass = "It's look like you're not yet member! click on the buttom link to signup.";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FMS - Login</title>

    <!-- box icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/dist/boxicons.js' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-otp ">
            <div class="container-otp ">
                <header class="text-white bg-success">
                    <i class="bx bxs-check-shield"></i>
                </header>
                <h4>Enter OTP Code</h4>
                <form action="#">
                    <div class="input-field">
                        <input id="inputOTP" type="number" />
                        <input id="inputOTP" type="number" disabled />
                        <input id="inputOTP" type="number" disabled />
                        <input id="inputOTP" type="number" disabled />
                    </div>
                    <button id="btnOTP">Verify OTP</button>
                </form>
            </div>
            </div>

        </div>

    </div>

    <!-- <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">

                            </div>
                            <div class="col-lg-6 bg-light">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <div class="container-otp">
                                        <header>
                                            <i class="bx bxs-check-shield"></i>
                                        </header>
                                        <h4>Enter OTP Code</h4>
                                        <form action="#">
                                            <div class="input-field">
                                                <input id="inputOTP" type="number" />
                                                <input id="inputOTP" type="number" disabled />
                                                <input id="inputOTP" type="number" disabled />
                                                <input id="inputOTP" type="number" disabled />
                                            </div>
                                            <button id="btnOTP">Verify OTP</button>
                                        </form>
                                    </div>

                                
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> -->
    <script>

    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>