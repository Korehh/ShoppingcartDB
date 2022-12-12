<?php  
    require('function.php');
    session_start();
    $con = openConnection();
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <?php 
            if (isset($_POST['loginbtn'])) {
                $password = $_POST['password'];
                $email = $_POST['email'];
        
                $email = stripcslashes($email);
                $password= stripslashes($password);
        
                $email = mysqli_real_escape_string($con, $email);
                $password = mysqli_real_escape_string($con, $password);
        
                $password = md5($password);
        
                $strSql = "SELECT * FROM tbl_customer
                        WHERE emailAddress ='$email'
                        AND password = '$password'
                        ";
        
                if ($rsLogin = mysqli_query($con, $strSql)) {
                    if (mysqli_num_rows($rsLogin)>0) {
                        echo 'Welcome to the system';
                        foreach ($rsLogin as $key => $value) {
                            $_SESSION['customerID'] = $value['customerID'];
                            $_SESSION['customerName'] = $value['firstName'];
                            header('location: index.php');
                        }
                    }else
                        echo '<div class="alert alert-danger text-center" role="alert">
                                Invalid Account/Password
                            </div>';
                }
                else
                    echo "could not execute your request";
            }
    ?>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login1-image mr-5"><img src="https://i.pinimg.com/564x/a3/a9/2f/a3a92fba6220e5930e9a04da64287974.jpg" alt="tzuyu"></div>
                            <div class="col-lg-5">
                                <div class="p-5 ml-5 my-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                             <button type="submit" name="loginbtn" class="btn btn-primary btn-user btn-block text-white">Login</button>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Create an Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="adminlogin.php">Sign In as Admin!</a>
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