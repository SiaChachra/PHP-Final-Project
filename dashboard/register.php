
<?php
include_once("../z_db.php");
           $status = "OK"; //initial status
$msg="";
          if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$username = mysqli_real_escape_string($con,$_POST['username']);
$password = mysqli_real_escape_string($con,$_POST['password']);

 if ( strlen($username) < 5 ){
$msg=$msg."Username Must Be More Than 5 Char Length.<BR>";
$status= "NOTOK";}
 if ( strlen($password) < 5 ){
$msg=$msg."Password Must Be More Than 5 Char Length.<BR>";
$status= "NOTOK";}

  $rr=mysqli_query($con,"SELECT COUNT(*) FROM admin WHERE username = '$username'");
  $r = mysqli_fetch_row($rr);
  $nr = $r[0];
  if($nr==1){
  $msg=$msg."Username Already Exists. Please Try Another One.<BR>";
  $status= "NOTOK";
  }

if($status=="OK")
{
  $password = md5($password);
$qb=mysqli_query($con,"INSERT INTO admin (username, password) VALUES ('$username', '$password')");


    if($qb){
          $errormsg= "
<div class='alert alert-success alert-dismissible alert-outline fade show'>
                  User has been added successfully.
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>
 "; //printing error if found in validation

    }
  }

        elseif ($status!=="OK") {
            $errormsg= "
<div class='alert alert-danger alert-dismissible alert-outline fade show'>
                     ".$msg." <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button> </div>"; //printing error if found in validation


    }
    else{
      $errormsg= "
      <div class='alert alert-danger alert-dismissible alert-outline fade show'>
                 Some Technical Glitch Is There. Please Try Again Later Or Ask Admin For Help.
                 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                 </div>"; //printing error if found in validation


    }
           }
           ?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
  data-sidebar-image="none">


<head>

  <meta charset="utf-8" />
  <title>Sign up | Diamond</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Website for assignment" name="description" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="assets/images/favicon.ico">

  <!-- Layout config Js -->
  <script src="assets/js/layout.js"></script>
  <!-- Bootstrap Css -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- Icons Css -->
  <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
  <!-- App Css-->
  <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
  <!-- custom Css-->
  <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />

</head>

<body>

  <!-- auth-page wrapper -->
  <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-overlay"></div>
    <!-- auth-page content -->
    <div class="auth-page-content overflow-hidden pt-lg-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card overflow-hidden">
              <div class="row g-0">
                <div class="col-lg-6">
                  <div class="p-lg-5 p-4 auth-one-bg h-100">
                    <div class="bg-overlay"></div>
                    <div class="position-relative h-100 d-flex flex-column">
                      <div class="mb-4">
                      <?php
    $rr=mysqli_query($con,"SELECT ufile FROM logo");
$r = mysqli_fetch_row($rr);
$ufile = $r[0];
?>
                        <a href="index.php" class="d-block">
                          <img src="uploads/logo/<?php print $ufile;?>" alt="" height="80">
                        </a>
                      </div>

                    </div>
                  </div>
                </div>
                <!-- end col -->

                <div class="col-lg-6">
                  <div class="p-lg-5 p-4">
                    <div>
                      <h5 class="text-primary">Welcome to My Site!</h5>
                      <p class="text-muted">Sign Up to continue into your dashboard.</p>
                    </div>

                    <div class="mt-4">
                    <?php
						if($_SERVER['REQUEST_METHOD'] == 'POST' && ($errormsg!=""))
						{
						print $errormsg;
						}
						?>
                                    <form class="user" action="" method="post">
                        <div class="mb-3">
                          <label for="username" class="form-label">Username</label>
                          <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                        </div>

                        <div class="mb-3">

                          <label class="form-label" for="password-input">Password</label>
                          <div class="position-relative auth-pass-inputgroup mb-3">
                            <input type="password" class="form-control pe-5" name="password" placeholder="Enter password"
                              id="password-input">

                          </div>
                        </div>
                           <div class="mb-3">

                          <span>Already have account? <a href="login">Login Here</a></span>

                          </div>
                        </div>



                        <div class="mt-4">
                          <button class="btn btn-success w-100" value="save" type="submit">Sign Up</button>
                        </div>


                      </form>
                    </div>


                  </div>
                </div>
                <!-- end col -->
              </div>
              <!-- end row -->
            </div>
            <!-- end card -->
          </div>
          <!-- end col -->

        </div>
        <!-- end row -->
      </div>
      <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="text-center">
            <?php
    $rr=mysqli_query($con,"SELECT site_footer FROM siteconfig");
$r = mysqli_fetch_row($rr);
$site_footer = $r[0];
?>
            <p class="mb-0">
             <?php print $site_footer ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- end Footer -->
  </div>
  <!-- end auth-page-wrapper -->

  <!-- JAVASCRIPT -->
  <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/libs/simplebar/simplebar.min.js"></script>
  <script src="assets/libs/node-waves/waves.min.js"></script>
  <script src="assets/libs/feather-icons/feather.min.js"></script>
  <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
  <script src="assets/js/plugins.js"></script>

  <!-- password-addon init -->
  <script src="assets/js/pages/password-addon.init.js"></script>
</body>


</html>
