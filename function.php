<?php
include'database.php';

// $db = Database::getInstance();
// $mysqli = Database::getInstance()->getConnection();
// $query = "SELECT * FROM supplier";
// $result = $mysqli->query($query);

$func = $_GET['func'] ?? '';
$aksi = $_GET['aksi'] ?? '';
/***
* Kumpulan Fungsi Proses
***/

// Fungsi Login

//Fungsi Tampil nasabah

function tampilData($tabel){
    $query = "SELECT * FROM $tabel";
    $mysqli = Database::getInstance()->getConnection();
    $result = $mysqli->query($query);
    while($d=mysqli_fetch_array($result)){
        $data[] =$d;
    }
    return $data ?? '';
}

// function ambilData($tabel,$key,$id){
//     $query = "SELECT * FROM $tabel where $key = '$id'";
//     $mysqli = Database::getInstance()->getConnection();
//     $result = $mysqli->query($query);
//     while($d=mysqli_fetch_array($result)){
///         $data[] =$d;
//     }
//     return $data ?? '';
// }

function ambilData($pilihan){
    $query = "SELECT * FROM siswa where pilihan = '$pilihan'";
    $mysqli = Database::getInstance()->getConnection();
    $result = $mysqli->query($query);
    if ($result) {
        echo $result->num_rows;
    }
}

function ambilDataSiswa($nis){
    $query = "SELECT nama_siswa FROM siswa where nis = '$nis'";
    $mysqli = Database::getInstance()->getConnection();
    $result = $mysqli->query($query);
    if ($result) {
        return $data = mysqli_fetch_assoc($result);
    }
}

function cekMemilih($nis){
    $query = "SELECT * FROM siswa where nis = '$nis' AND selesai = '1'";
    $mysqli = Database::getInstance()->getConnection();
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        return true;
    }else {
        return false;
    }
}

//Fungsi cek nasabah
function cekData($tabel){
    $query = "SELECT * FROM $tabel";
    $mysqli = Database::getInstance()->getConnection();
    $result = $mysqli->query($query);
    if ($result->num_rows == 0) {
        return true;
    }else {
        return false;
    }

}
//Fungsi cek nasabah
function validasiNis($nis){
    $query = "SELECT * FROM siswa where nis =  '$nis'";
    $mysqli = Database::getInstance()->getConnection();
    $result = $mysqli->query($query);
    if($result->num_rows > 0){
        // header("location:admin/controller.php?hal=dashboard");
        echo "<script>window.location = 'index.php?nis=$nis'</script>";
    }else{
        echo "<script>alert('Nis Tidak Terdaftar.');window.location = 'index.php' </script>";
    }
}

function pilihOsis($nis, $pilihan){
    $query = "UPDATE  siswa SET `pilihan` = '$pilihan',`selesai` = '1' where nis = '$nis'" or die(mysql_error());
    $mysqli = Database::getInstance()->getConnection();
    $result = $mysqli->query($query);
    if($result){
        // header("location:admin/controller.php?hal=dashboard");
        echo "<script>alert('Berhasil Memilih Osis.'); window.location = 'index.php'</script>";
    }else{
        echo mysqli_error($mysqli);
        header("location:index.php");
    }
}

/**
 * Kumpulan Func
 */


if($aksi == "validasiNis"){
    validasiNis($_POST['nis']);
}
if($aksi == "pilihOsis"){
    pilihOsis($_GET['nis'],$_GET['pilihan']);
}
?>