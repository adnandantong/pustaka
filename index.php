<?php
require 'function.php';


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">
            <img src="assets/img/logo.png.png" alt="Logo" style="width: 50px; height: auto;">   
            PERPUSTAKAAN
        </a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle" style="font-size: 17px;"></i> 
                    <span class="text-light" style="font-size: 15px; font-weight: bold;">ADMIN</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </li>
        </ul>
    </nav>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">ADMIN</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="kerjapraktek.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Kerja Praktik
                            </a>
                            <a class="nav-link" href="tugasakhir.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                                Tugas Akhir
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-2">DATA PENGUMPULAN LAPORAN</h1>
                        <div class="card mb-2">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                
                                            <th>NIM</th>
                                            <th style="width: 200px;">Nama Mahasiswa</th>
                                            <th style="width: 130px;">Prodi</th>
                                            <th style="width: 300px;">Judul Laporan</th>
                                            <th style="width: 90px;">Tanggal</th>
                                         
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $ambilsemuadatadatamahasiswa = mysqli_query($conn, "select * from datamahasiswa");
                                            
                                            while($data=mysqli_fetch_array($ambilsemuadatadatamahasiswa)){
                                                $nim = $data['nim'];
                                                $namamahasiswa = $data['namamahasiswa'];
                                                $prodi = $data['prodi'];
                                                $judullaporan = $data['judullaporan'];
                                                $tanggal = $data['tanggal'];
                                             
                                            ?>
                                            <tr>
                                                <td><?=$nim;?></td>
                                                <td><?=$namamahasiswa;?></td>
                                                <td><?=$prodi;?></td>
                                                <td><?=$judullaporan;?></td>
                                                <td><?=$tanggal;?></td>
                                              
                                            </tr>
                                            <?php
                                            };

                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
