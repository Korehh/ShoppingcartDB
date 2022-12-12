<?php 
   ob_start();
    session_start();

    require('function.php');
    $err = array('ProductName'=>'', 'ProductPrice'=>'', 'ProdDes'=>'', 'image1'=>'', 'image2'=>'');
    $ProductName = $ProductPrice = $ProdDes = '';

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

    <title>ADMIN - ADD PRODUCT</title>

    <!-- Custom fonts for this template-->
    <link href="css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/modal-Success.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">LEARN <sup> IT</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Product
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="addProduct.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Add new Product</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Alprince Nacion</span>
                                <img class="img-profile rounded-circle"
                                    src="img/al.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="changeAdminPass.php">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>


                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div tabindex="-1" class="modal bs-example-modal-sm" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                        <div class="modal-header"><h4>Logout <i class="fa fa-lock"></i></h4></div>
                        <div class="modal-body"><i class="fa fa-question-circle"></i> Are you sure you want to log-off?</div>
                        <div class="modal-footer"><a class="btn btn-primary btn-block" href="javascript:;">Logout</a></div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add Product</h1>
                       <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Product</h6>
                        </div>
                        <div class="card-body">
                        <?php

                            if (isset($_POST['addbtn'])) {
                                $con = openConnection();
                                $ProductName = sanitizeInput($con, $_POST['ProductName']);
                                $ProductPrice = sanitizeInput($con, $_POST['ProductPrice']);
                                $ProdDes = sanitizeInput($con, $_POST['ProdDes']);

                                $img1 = sanitizeInput($con, $_FILES['image1']['name']);
                                $img2 = sanitizeInput($con, $_FILES['image2']['name']);

                                if (empty($ProductName)) {
                                    $err['ProductName'] = 'Product Name is required.';
                                }

                                if (empty($ProductPrice)) {
                                    $err['ProductPrice'] = 'Product Price is required.';
                                }

                                if (empty($ProdDes)) {
                                    $err['ProdDes'] = 'Product Description is required.';
                                }

                                if (empty($_FILES['image1']['name'])) {
                                    $err['image1'] = "Photo 1 is requred";
                                }else{
                                    $image1 = fileUpload($_FILES['image1']);
                                    $arrImage1[] = $image1;
                                    if (!empty($arrImage1[0])) {
                                    $err['image1'] = '' . $arrImage1[0][0];
                                    }
                                }


                                if (empty($_FILES['image2']['name'])) {
                                    $err['image2'] = "Photo 2 is requred";
                                }else{
                                    $image2 = fileUpload($_FILES['image2']);
                                    $arrImage2[] = $image2;
                                    if (!empty($arrImage2[0])) {
                                    $err['image2'] = '' . $arrImage2[0][0];   
                                    }
                                }

                                if(!array_filter($err)){
                                $strSql = "INSERT INTO tbl_products(name, description, price, photo1, photo2) 
                                VALUES ('$ProductName', '$ProdDes', '$ProductPrice', '$img1', '$img2') 
                                ";
                                if (mysqli_query($con, $strSql)) {
                                    header('location: addProduct.php');
                                }
                                else
                                echo "errorL: ";

                            }
                            }
                            ob_end_flush();
                            ?> 
                            <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-5">
                                    <input type="text" name="ProductName" class="form-control" placeholder="Name of the Product" value="<?php echo $ProductName;?>">
                                        <?php echo '<label class="text-danger">'.$err['ProductName'].'</label>'; ?>
                                    </div>
                                    <div class="col-md-5">
                                    <input type="number" name="ProductPrice" class="form-control"  placeholder="Price of the Product" value="<?php echo $ProductPrice;?>">
                                    <?php echo '<label class="text-danger">'.$err['ProductPrice'].'</label>'; ?>
                                    </div>
                                </div><br>   
                                <div class="row">
                                    <div class="col-md-10">
                                    <label for="inputAddress">Product Description</label>
                                    <textarea name="ProdDes" class="form-control " id="inputAddress" placeholder="Description" value="<?php echo $ProdDes;?>"></textarea>
                                    <?php echo '<label class="text-danger">'.$err['ProdDes'].'</label>'; ?>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="photo1">Photo 1</label>
                                        <input type="file" name="image1" id="photo1"> 
                                        <?php echo '<label class="text-danger">'.$err['image1'].'</label>'; ?>   
                                    </div>
                                    <div class="col-md-5">
                                        <label for="photo2">Photo 2</label>
                                        <input type="file" name="image2" id="photo2">
                                        <?php echo '<label class="text-danger">'.$err['image2'].'</label>'; ?> 
                                    </div>
                                </div>
                                <br>
                                    <div class="row">
                                        <div class="col-md-5">
                                        <button type="submit" name="addbtn" class="btn btn-primary">ADD PRODUCT</button>
                                        <a href="dashboard.php" class="btn btn-secondary">GO BACK</a>
                                        </div>
                                    </div>
                            </form>

                            <div id="success_tic" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                    <a class="close" href="#" data-dismiss="modal">&times;</a>
                                    <div class="page-body">
                                    <div class="head">  
                                    <h3 style="margin-top:5px;">Lorem ipsum dolor sit amet</h3>
                                    <h4>Lorem ipsum dolor sit amet</h4>
                                    </div>

                                <h1 style="text-align:center;"><div class="checkmark-circle">
                                <div class="background"></div>
                                <div class="checkmark draw"></div>
                                </div><h1>

                                </div>
                                </div>
                                    </div>

                                </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Alprince Website 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="adminlogin.php">Logout</a>
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

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>