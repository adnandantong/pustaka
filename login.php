<?php
require 'function.php';

//cek login
if(isset($_POST['login'])){;
    $email = $_POST['email'];
    $password = $_POST['password'];

    $cekdatabase = mysqli_query($conn, "SELECT * FROM login where email='$email' and password='$password'");

    $hitung = mysqli_num_rows($cekdatabase);

    if($hitung>0){
        $_SESSION['log'] = 'True';
        header('location:index.php');
    } else {
        header('location:login.php');
    };
};

if(!isset($_SESSION['log'])){

} else {
    header('location:index.php');
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header text-center">
                            <img src="assets/img/logo.png.png" alt="Logo" style="width: 100px; height: auto; margin-bottom: 1px; margin-top: 20px;">
                            <h3 class="text-center font-weight-bold my-2 mt-3" style="margin-top: 1px;">
                            <i class="fas fa-user-shield"></i> SIGN IN ADMIN
                            </h3>
                            </div>
                                <div class="card-body">
                                    <form method="post">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputEmailAddress">Email</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                </div>
                                                <input class="form-control py-4" name="email" id="inputEmailAddress" type="email" placeholder="Enter email address" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputPassword">Password</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                </div>
                                                <input class="form-control py-4" name="password" id="inputPassword" type="password" placeholder="Enter password" />
                                            </div>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-end mt-4 mb-0">
                                            <button class="btn btn-primary" name="login">Login</button>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="card-footer text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer"class="custom-footer">
                <footer class="py-4 mt-auto" style="margin-top: -10px;">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-center small">
                            <div class="text-muted">Copyright &copy; Your Website 2025</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
