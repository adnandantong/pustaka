<?php
require 'functionTA.php';
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tugas Akhir</title>
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
                            <div class="sb-sidenav-menu-heading">Admin</div>
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
                        <h1 class="mt-2">TUGAS AKHIR</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">
                                 Tambah Data
                            </button> 
                              
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                              
                                            <th>NIM</th>
                                            <th style="width: 200px;">Nama Mahasiswa</th>
                                            <th style="width: 120px;">Prodi</th>
                                            <th style="width: 280px;">Judul Laporan</th>
                                            <th style="width: 70px;">Tanggal</th>
                                            <th style="width: 90px;">Aksi</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $ambilsemuadatadatamahasiswa = mysqli_query($conn, "select * from tugasakhir");
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

                                            <!-- Tombol Edit -->
                                            <td>
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?=$nim;?>">
                                                        Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal<?=$nim;?>">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>


                                            <!-- Modal Edit untuk setiap baris -->
                                            <div class="modal fade" id="editModal<?=$nim;?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">

                                            <!-- Header Modal -->
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Data Tugas Akhir</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            
                                            <!-- Body Modal dengan form untuk mengedit data -->
                                            <form method="post">
                                                <div class="modal-body">
                                                <input type="text" name="nim" value="<?=$nim;?>" class="form-control" readonly>
                                                <br>
                                                    <input type="text" name="namamahasiswa" value="<?=$namamahasiswa;?>" class="form-control" required>
                                                    <br>
                                                    <select name="prodi" class="form-control" required>
                                                        <option value="sistem informasi" <?=($prodi == 'sistem informasi') ? 'selected' : '';?>>Sistem Informasi</option>
                                                        <option value="teknik informatika" <?=($prodi == 'teknik informatika') ? 'selected' : '';?>>Teknik Informatika</option>
                                                    </select>
                                                    <br>
                                                    <input type="text" name="judullaporan" value="<?=$judullaporan;?>" class="form-control" required>
                                                    <br>
                                                    <input type="date" name="tanggal" value="<?=$tanggal;?>" class="form-control" required>
                                                    <br>
                                                    <button type="submit" class="btn btn-primary" name="updateData">Update</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Modal Hapus untuk setiap baris -->
                                    <div class="modal fade" id="deleteModal<?=$nim;?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">

                                            <!-- Header Modal -->
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel">Hapus Data Mahasiswa</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            
                                            <!-- Body Modal -->
                                            <form method="post">
                                                <div class="modal-body">
                                                Apakah Anda Yakin Ingin Menghapus Data ini?
                                                <input type="hidden" name="nim" value="<?=$nim;?>">
                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-primary" name="hapusdata">Hapus</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                            </tr>      
                                            <?php
                                            }

                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            
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

    <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Baru</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form action="tugasakhir.php" method="POST">
        <div class="modal-body">
           
        <input type="text" name="nim" placeholder="NIM" class="form-control" required>
        <br>
          <input type="text" name="namamahasiswa" placeholder="Nama Mahasiswa" class="form-control" required>
          <br>
          <select name="prodi" class="form-control" required>
          <option value="">Pilih Prodi</option>
          <option value="sistem informasi">Sistem Informasi</option>
          <option value="teknik informatika">Teknik Informatika</option>
          </select>
          <br>
          <input type="text" name="judullaporan" placeholder="Judul Laporan" class="form-control" required>
          <br>
          <input type="date" name="tanggal" class="form-control" required>
          <br>
          <button type="submit" class="btn btn-primary" name="addnewdata">Submit</button> 
        </div>
        </form>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</html>
