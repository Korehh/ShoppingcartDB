<?php
require('function.php');

$err = array('email' =>'', 'password' =>'');

$firstname = $lastname = $sex = $email = $bday = $txtNumber = $txtAddress = '';

if (isset($_POST['CrtAccount'])) {
    $con = openConnection();

    $firstname = sanitizeInput($con, $_POST['Fname']);
    $lastname = sanitizeInput($con, $_POST['Lname']);
    $sex = sanitizeInput($con, $_POST['radSex']);
    $email = sanitizeInput($con, $_POST['txtEmail']);
    $bday = sanitizeInput($con, $_POST['bday']);
    $txtNumber = sanitizeInput($con, $_POST['txtNumber']);
    $txtAddress = sanitizeInput($con, $_POST['txtAddress']);


    if (empty($email)){
        $err['email'] = "Email is required"; 
    } else {
        //$err['email'] = "Email is typed";

         //$email = $_POST['txtEmail'];
      $email_query = "SELECT * FROM tbl_customer WHERE emailAddress = '$email'";
      $email_query_run = mysqli_query($con, $email_query);

      if(mysqli_num_rows($email_query_run) > 0){
       $err['email'] = 'email is existing';
      }
    }

    if ($_POST['CrtPassword'] != $_POST['RptPassword']) 
        $err['password'] = "Password not match/required";

    $password = md5($_POST['CrtPassword']);

        if(!array_filter($err)){
                $strSql = "INSERT INTO tbl_customer(firstName, lastName, sex, emailAddress, birthday, mobileNumber, address, password) 
                VALUES ('$firstname', '$lastname', '$sex', '$email', '$bday', '$txtNumber', '$txtAddress', '$password') 

                ";

                if (mysqli_query($con, $strSql)) {
                    echo "success";
                    header("location: login.php");
                }
                else
                    echo "errorL: ";

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

    <title>SB Admin 2 - Register</title>

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
                            <form class="user" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="Fname" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="First Name" value="<?php echo $firstname; ?>" required>
                                    </div>  
                                    <div class="col-sm-6">
                                        <input type="text" name="Lname" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Last Name" value="<?php echo $lastname; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="txtEmail" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Email Address"value="<?php echo $email; ?>" required>
                                        <label class="text-danger"><?php echo $err['email'];?></label>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="txtAddress" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Address" value="<?php echo $txtAddress; ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="number" name="txtNumber" class="form-control form-control-user" id="exampleInputEmail"
                                        placeholder="Mobile Number" value="<?php echo $txtNumber; ?>" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="date" name="bday" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="birthday" value="<?php echo $date; ?>" required>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <select name="radSex" class="form-control form-control-lg">
                                          <option value="Male">Male</option>
                                          <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="CrtPassword" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" required> 
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="RptPassword" class="form-control form-control-user"
                                            id="exampleRepeatPassword" placeholder="Repeat Password" required="">
                                    </div>
                                </div>
                                <label class="text-danger"><?php echo $err['password'];?></label>
                                <button type="submit" name="CrtAccount" class="btn btn-primary btn-user btn-block text-white">
                                    Register Account</button>
                            </form>
                            <hr>
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