<?php
session_start();

$conn = mysqli_connect("localhost","root","","pustaka");



function addNewDataKerjaPraktik($nim, $namamahasiswa, $prodi, $judullaporan, $tanggal) {
    global $conn;
   
    $stmt1 = $conn->prepare("INSERT INTO kerjapraktik (nim, namamahasiswa, prodi, judullaporan, tanggal) VALUES (?, ?, ?, ?, ?)");
    $stmt1->bind_param("sssss", $nim, $namamahasiswa, $prodi, $judullaporan, $tanggal);
    

    $stmt2 = $conn->prepare("INSERT INTO datamahasiswa (nim, namamahasiswa, prodi, judullaporan, tanggal) VALUES (?, ?, ?, ?, ?)");
    $stmt2->bind_param("sssss", $nim, $namamahasiswa, $prodi, $judullaporan, $tanggal);

    
    mysqli_begin_transaction($conn);

    try {
        // Execute both insert queries
        $stmt1->execute();
        if ($stmt1->error) {
            throw new Exception("Error inserting into kerjapraktik: " . $stmt1->error);
        }
        $stmt2->execute();
        if ($stmt2->error) {
            throw new Exception("Error inserting into datamahasiswa: " . $stmt2->error);
        }
    

        // Commit transaction
        mysqli_commit($conn);
        return true; // Success
    } catch (Exception $e) {
        // Rollback in case of error
        mysqli_rollback($conn);
        return false; // Error
    }
}


if (isset($_POST['addnewdata'])) {
    $nim = $_POST['nim'];
    $namamahasiswa = $_POST['namamahasiswa'];
    $prodi = $_POST['prodi'];
    $judullaporan = $_POST['judullaporan'];
    $tanggal = $_POST['tanggal'];
    
    
    if (addNewDataKerjaPraktik($nim, $namamahasiswa, $prodi, $judullaporan, $tanggal)) {
        echo "Data added successfully!";
        header('Location: kerjapraktek.php'); // Redirect after success
    } else {
        echo "Error adding data!";
    }
};



function searchData($keyword, $table) {
    global $conn;

 
    $query = "SELECT * FROM $table WHERE 
              nim LIKE ? OR 
              namamahasiswa LIKE ? OR 
              prodi LIKE ? OR 
              judullaporan LIKE ? OR 
              tanggal LIKE ?";

    $stmt = $conn->prepare($query);
    $searchKeyword = "%$keyword%";


    $stmt->bind_param("sssss", $searchKeyword, $searchKeyword, $searchKeyword, $searchKeyword, $searchKeyword);

 
    $stmt->execute();
    $result = $stmt->get_result();

   
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
};


if (isset($_POST['updateData'])) {
    
    $nim = $_POST['nim'];
    $namamahasiswa = $_POST['namamahasiswa'];
    $prodi = $_POST['prodi'];
    $judullaporan = $_POST['judullaporan'];
    $tanggal = $_POST['tanggal'];

    
    $updateKerjaPraktik = "UPDATE kerjapraktik SET 
                            namamahasiswa = '$namamahasiswa', 
                            prodi = '$prodi', 
                            judullaporan = '$judullaporan', 
                            tanggal = '$tanggal' 
                            WHERE nim = '$nim'";


                            $updateDataMahasiswa = "UPDATE datamahasiswa SET 
                            namamahasiswa = '$namamahasiswa', 
                            prodi = '$prodi',
                            judullaporan = '$judullaporan', 
                            tanggal = '$tanggal'
                            WHERE nim = '$nim'";


    $conn->begin_transaction();
    try {
        
        if (mysqli_query($conn, $updateKerjaPraktik)) {
        
            if (mysqli_query($conn, $updateDataMahasiswa)) {
                
                $conn->commit();
                echo "<script>alert('Data berhasil diperbarui di kedua tabel');</script>";
                echo "<script>window.location = 'kerjapraktek.php';</script>";
            } else {
                
                $conn->rollback();
                echo "<script>alert('Gagal memperbarui data di tabel datamahasiswa');</script>";
            }
        } else {
            
            $conn->rollback();
            echo "<script>alert('Gagal memperbarui data di tabel kerjapraktik');</script>";
        }
    } catch (Exception $e) {
       
        $conn->rollback();
        echo "<script>alert('Terjadi kesalahan: " . $e->getMessage() . "');</script>";
    }
};


if (isset($_POST['hapusdata'])) {
    $nim = $_POST['nim'];

    
    $conn->begin_transaction();
    try {
        
        $hapusKerjaPraktik = mysqli_query($conn, "DELETE FROM kerjapraktik WHERE nim = '$nim'");
        if ($hapusKerjaPraktik) {
            
            $hapusDataMahasiswa = mysqli_query($conn, "DELETE FROM datamahasiswa WHERE nim = '$nim'");
            if ($hapusDataMahasiswa) {
                // Commit perubahan jika kedua query berhasil
                $conn->commit();
                header('Location: kerjapraktek.php');
                exit();
            } else {
                // Rollback jika gagal menghapus data mahasiswa
                throw new Exception('Gagal menghapus data di tabel datamahasiswa');
            }
        } else {
            // Rollback jika gagal menghapus data di tabel kerjapraktik
            throw new Exception('Gagal menghapus data di tabel kerjapraktik');
        }
    } catch (Exception $e) {
        // Rollback jika terjadi kesalahan
        $conn->rollback();
        echo 'Terjadi kesalahan: ' . $e->getMessage();
    }
};


?>