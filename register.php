<?php
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

$emailError = "";
$passwordError = "";
$repeatPasswordError = "";
$fnameError = "";
$lnameError = "";
$userNameError = "";
$success = "";

$email = "";
$username = "";
$password = "";
$repeatPassword = "";
$fname = "";
$lname = "";

$ErrorEmailPass = "";
$matchPassword = "";


// if (isset($_POST['submit'])) {
//     $fname = $_POST['fname'];
//     $lname = $_POST['lname'];
//     $email = $_POST['email'];
//     $username = $_POST['userName'];
//     $password = $_POST['password'];
//     $repeatPassword = $_POST['repeatPassword'];


//     if (empty($fname)) {
//         $fnameError = "Fisrt Name is required";
//     }

//     if (empty($lname)) {
//         $lnameError = "Last Name is required";
//     }

//     if (empty($email)) {
//         $emailError = "Email is required";
//     }
//     if (empty($password)) {
//         $passwordError = "Password is required";
//     }
//     if (empty($repeatPassword)) {
//         $repeatPasswordError = "Password is required";
//     }
//     if (empty($username)) {
//         $userNameError = "Username is required";
//     }

//     if (empty($password) == false && empty($repeatPassword) == false && ($password != $repeatPassword)) {
//         $matchPassword = "Password did not match.";
//     } elseif (empty($email) == false && empty($password) == false && empty($fname) == false && empty($lname) == false) {

//         $conn = getConnection();
//         $result = $conn->query("INSERT INTO employees (`fisrtname`, `lastname`, `email`,`UserName`, `password`) VALUE('$fname', '$lname', '$email','$username', '$password')");


//         if ($result == true) {
//             $success = "Registration is successfully";

        
//         }

      
//     }
// }

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $username = $_POST['userName'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];

    // Validation
    if (empty($fname)) {
        $fnameError = "First Name is required";
    }
    if (empty($lname)) {
        $lnameError = "Last Name is required";
    }
    if (empty($email)) {
        $emailError = "Email is required";
    }
    if (empty($username)) {
        $userNameError = "Username is required";
    }
    if (empty($password)) {
        $passwordError = "Password is required";
    }
    if (empty($repeatPassword)) {
        $repeatPasswordError = "Repeat Password is required";
    }

    // Check if passwords match only if both are filled
    if (!empty($password) && !empty($repeatPassword) && $password !== $repeatPassword) {
        $matchPassword = "Passwords do not match.";
    }

    // If there are no errors, insert into database
    if (
        empty($fnameError) &&
        empty($lnameError) &&
        empty($emailError) &&
        empty($userNameError) &&
        empty($passwordError) &&
        empty($repeatPasswordError) &&
        empty($matchPassword)
    ) {
        $conn = getConnection();
        $passwordHash = password_hash($password, PASSWORD_BCRYPT); // Secure password
        $stmt = $conn->prepare("INSERT INTO employees (fisrtname, lastname, email, UserName, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $fname, $lname, $email, $username, $passwordHash);
        
        if ($stmt->execute()) {
            $success = "Registration successful";
        } else {
            $success = "Something went wrong. Please try again.";
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

    <title>FMS - Register</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="puplic/images/YW.png">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>

                            <form action="#" method="post" class="use">
                                <?php
                                if (empty($success)) {
                                } else {
                                ?>
                                    <div class="alert alert-success">
                                        <?php echo $success; ?> <a class="font-weight-bold" href="login.php">Login Now!</a> </div>

                                <?php }
                                ?>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="fname" value="<?php echo $fname ?>" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="First Name">
                                        <div class="errordisplay"><?php echo $fnameError ?> </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="text" name="lname" value="<?php echo $lname ?>" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Last Name">
                                        <div class="errordisplay"><?php echo $lnameError ?> </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="email" name="email" value="<?php echo $email ?>" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address">
                        
                                    <div class="errordisplay"><?php echo $emailError ?> </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="userName" value="<?php echo $username ?>" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Username">
                                        <div class="errordisplay"><?php echo $userNameError ?> </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" value="<?php echo $password ?>" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password">
                                        <div class="errordisplay"><?php echo $passwordError ?> </div>
                                        <div class="errordisplay"><?php echo $matchPassword ?> </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="repeatPassword" value="<?php echo $repeatPassword ?>" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password">
                                        <div class="errordisplay"><?php echo $repeatPasswordError ?> </div>
                                        <div class="errordisplay"><?php echo $matchPassword ?> </div>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">Register Account</button>
                                <!-- <a href="#" name="submit"  class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </a> -->
                                <hr>
                                <a href="index.php" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>