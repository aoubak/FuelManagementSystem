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

if(isset($_COOKIE['email']) &&  isset($_COOKIE['password'])){
    $id=$_COOKIE['email'];
    $pass=$_COOKIE['password'];
}else{
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
    } 
    elseif (empty($email) == false && empty($password) == false) {

        $conn = getConnection();
        $result = $conn->query("SELECT * FROM employees WHERE email ='$email' AND `password` = '$password' ");
        if (mysqli_num_rows($result) > 0) {

            session_start();
            $row = $result->fetch_assoc();
            $_SESSION['EmployeeID'] = $row['EmployeeID'];
            $_SESSION['Role'] = $row['Role'];

            if(isset($_POST['remember_me'])){
                setcookie('email', $_POST['email'], time() + (60*60*24));
                setcookie('password', $_POST['password'], time() + (60*60*24));
            }

            header("location:index.php");
            exit();
        }
        else {
            // $_SESSION['status'] = "No Username or Password found";
            //  $ErrorEmailPass= "No Username or Password found";
             $ErrorEmailPass= "It's look like you're not yet member! click on the buttom link to signup.";
           
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

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">

                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">

                            </div>
                            <div class="col-lg-6 bg-light">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>

                                    

                                        <?php
                                        if( empty($ErrorEmailPass)){

                                        }
                                        else{
                                            ?>
                                            <div class="alert alert-danger">
                                            <?php echo $ErrorEmailPass; ?> </div>

                                       <?php }
                                         ?>
                                

                                    <form action="#" method="post" class="use">
                                        <div class="form-group">
                                            <div>
                                                <input type="email" name="email" class="form-control form-control-user"
                                                    id="Email" value="<?php echo $id ?>" aria-describedby="emailHelp"
                                                    placeholder="Email">
                                                <span></span>
                                                <div class="errordisplay"><?php echo $emailError ?></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <input type="password" name="password" class="form-control form-control-user"
                                                    id="Password" value="<?php echo $pass ?>" placeholder="Password" aria-describedby="passwordHelpBlock">
                                                    
                                                <div class="errordisplay"><?php echo $passwordError ?></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" name="remember_me" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">login</button>
                                        <!-- <a href="index.php" name="login" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a> -->
                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
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