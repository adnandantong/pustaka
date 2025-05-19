<?php
session_start();

$conn = mysqli_connect("localhost","root","","pustaka");



// Tambah data di dua tabel (tugasakhir and datamahasiswa)
function addNewData($nim, $namamahasiswa, $prodi, $judullaporan, $tanggal) {
    global $conn;
    
    // Insert into tugasakhir table
    $stmt1 = $conn->prepare("INSERT INTO tugasakhir (nim, namamahasiswa, prodi, judullaporan, tanggal) VALUES (?, ?, ?, ?, ?)");
    $stmt1->bind_param("sssss", $nim, $namamahasiswa, $prodi, $judullaporan, $tanggal);
    
    // Insert into datamahasiswa table
    $stmt2 = $conn->prepare("INSERT INTO datamahasiswa (nim, namamahasiswa, prodi, judullaporan, tanggal) VALUES (?, ?, ?, ?, ?)");
    $stmt2->bind_param("sssss", $nim, $namamahasiswa, $prodi, $judullaporan, $tanggal);

    // Begin transaction
    mysqli_begin_transaction($conn);

    try {
        // Execute both insert queries
        $stmt1->execute();
        $stmt2->execute();

        // Commit transaction
        mysqli_commit($conn);
        return true; // Success
    } catch (Exception $e) {
        // Rollback in case of error
        mysqli_rollback($conn);
        return false; // Error
    }
}

// Check if the form is submitted
if (isset($_POST['addnewdata'])) {
    $nim = $_POST['nim'];
    $namamahasiswa = $_POST['namamahasiswa'];
    $prodi = $_POST['prodi'];
    $judullaporan = $_POST['judullaporan'];
    $tanggal = $_POST['tanggal'];
    
    // Call the function to add the new data
    if (addNewData($nim, $namamahasiswa, $prodi, $judullaporan, $tanggal)) {
        echo "Data added successfully!";
        header('Location: tugasakhir.php'); // Redirect after success
    } else {
        echo "Error adding data!";
    }
};


// Fungsi untuk memperbarui data tugasakhir
if (isset($_POST['updateData'])) {
    // Ambil data dari form
    $nim = $_POST['nim'];
    $namamahasiswa = $_POST['namamahasiswa'];
    $prodi = $_POST['prodi'];
    $judullaporan = $_POST['judullaporan'];
    $tanggal = $_POST['tanggal'];

    // Query untuk memperbarui data di tabel tugasakhir
    $updateTugasAkhir = "UPDATE tugasakhir SET 
                            namamahasiswa = '$namamahasiswa', 
                            prodi = '$prodi', 
                            judullaporan = '$judullaporan', 
                            tanggal = '$tanggal' 
                            WHERE nim = '$nim'";

// Query untuk memperbarui data di tabel datamahasiswa
                            $updateDataMahasiswa = "UPDATE datamahasiswa SET 
                            namamahasiswa = '$namamahasiswa', 
                            prodi = '$prodi',
                            judullaporan = '$judullaporan', 
                            tanggal = '$tanggal'
                            WHERE nim = '$nim'";

// Jalankan query untuk memperbarui kedua tabel
    $conn->begin_transaction();
    try {
        // Perbarui tabel tugasakhir
        if (mysqli_query($conn, $updateTugasAkhir)) {
            // Perbarui tabel datamahasiswa
            if (mysqli_query($conn, $updateDataMahasiswa)) {
                // Commit perubahan jika kedua query berhasil
                $conn->commit();
                echo "<script>alert('Data berhasil diperbarui di kedua tabel');</script>";
                echo "<script>window.location = 'tugasakhir.php';</script>";
            } else {
                // Rollback jika query kedua gagal
                $conn->rollback();
                echo "<script>alert('Gagal memperbarui data di tabel datamahasiswa');</script>";
            }
        } else {
            // Rollback jika query pertama gagal
            $conn->rollback();
            echo "<script>alert('Gagal memperbarui data di tabel tugasakhir');</script>";
        }
    } catch (Exception $e) {
        // Rollback jika ada kesalahan lainnya
        $conn->rollback();
        echo "<script>alert('Terjadi kesalahan: " . $e->getMessage() . "');</script>";
    }
};


// Menghapus data dari kerja praktik dan data mahasiswa
if (isset($_POST['hapusdata'])) {
    $nim = $_POST['nim'];

    // Mulai transaksi
    $conn->begin_transaction();
    try {
        // Hapus data dari tabel kerjapraktik
        $hapusTugasAkhir = mysqli_query($conn, "DELETE FROM tugasakhir WHERE nim = '$nim'");
        if ($hapusTugasAkhir) {
            // Hapus data dari tabel datamahasiswa
            $hapusDataMahasiswa = mysqli_query($conn, "DELETE FROM datamahasiswa WHERE nim = '$nim'");
            if ($hapusDataMahasiswa) {
                // Commit perubahan jika kedua query berhasil
                $conn->commit();
                header('Location: tugasakhir.php');
                exit();
            } else {
                // Rollback jika gagal menghapus data mahasiswa
                throw new Exception('Gagal menghapus data di tabel datamahasiswa');
            }
        } else {
            // Rollback jika gagal menghapus data di tabel kerjapraktik
            throw new Exception('Gagal menghapus data di tabel tugasakhir');
        }
    } catch (Exception $e) {
        // Rollback jika terjadi kesalahan
        $conn->rollback();
        echo 'Terjadi kesalahan: ' . $e->getMessage();
    }
};


?>