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

function ambilData($tabel,$key,$id){
    $query = "SELECT * FROM $tabel where $key = '$id'";
    $mysqli = Database::getInstance()->getConnection();
    $result = $mysqli->query($query);
    while($d=mysqli_fetch_array($result)){
        $data[] =$d;
    }
    return $data ?? '';
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
        echo "<script>alert('Data Ada.'); window.location = 'index.php?nis=$nis'</script>";
    }else{
        echo "<script>alert('Data Tidak Ada.');window.location = 'index.php' </script>";
    }
}

// Fungsi Tambah Nasabah

function tambahNasabah($noidnasabah, $namanasabah, $jeniskelaminnasabah, $tempatlahirnasabah, $tanggallahirnasabah, $agamanasabah, $pendidikannasabah, $tanggalpendaftaran ){
    $query = "INSERT INTO `nasabah` (`noidnasabah`, `namanasabah`, `jeniskelaminnasabah`, `tempatlahirnasabah`, `tanggallahirnasabah`, `agamanasabah`, `pendidikannasabah`, `tanggalpendaftaran`) VALUES ('$noidnasabah', '$namanasabah', '$jeniskelaminnasabah', '$tempatlahirnasabah', '$tanggallahirnasabah', '$agamanasabah', '$pendidikannasabah', '$tanggalpendaftaran')" or die(mysql_error());
    $mysqli = Database::getInstance()->getConnection();
    $result = $mysqli->query($query);
    if($result){
        // header("location:admin/controller.php?hal=dashboard");
        echo "<script>alert('Berhasil Menambahkan.'); window.location = 'admin/nasabah.php'</script>";
    }else{
        echo mysqli_error($mysqli);
        header("location:admin/nasabah.php");
    }
}
function updateNasabah($noidnasabah, $namanasabah, $jeniskelaminnasabah, $tempatlahirnasabah, $tanggallahirnasabah, $agamanasabah, $pendidikannasabah, $tanggalpendaftaran ){
    $query = "UPDATE  nasabah SET `noidnasabah` = '$noidnasabah', `namanasabah` = '$namanasabah', `jeniskelaminnasabah` = '$jeniskelaminnasabah', `tempatlahirnasabah` = '$tempatlahirnasabah', `tanggallahirnasabah` = '$tanggallahirnasabah', `agamanasabah` = '$agamanasabah', `pendidikannasabah` = '$pendidikannasabah', `tanggalpendaftaran` = '$tanggalpendaftaran' where noidnasabah = '$noidnasabah'" or die(mysql_error());
    $mysqli = Database::getInstance()->getConnection();
    $result = $mysqli->query($query);
    if($result){
        // header("location:admin/controller.php?hal=dashboard");
        echo "<script>alert('Berhasil Merubah Data.'); window.location = 'admin/nasabah.php'</script>";
    }else{
        echo mysqli_error($mysqli);
        //header("location:admin/nasabah.php");
    }
}


//Fungsi Tambah Pengajuan
function tambahPengajuan($idpengajuan, $nopinjaman, $tujuanpengajuan, $besarpengajuan, $jangkawaktupengajuan, $tanggalpengajuan){
    $query = "INSERT INTO pengajuan_pinjaman (idpengajuan, nopinjaman, tujuanpengajuan, besarpengajuan, jangkawaktupengajuan, tanggalpengajuan) values('$idpengajuan', '$nopinjaman', '$tujuanpengajuan', '$besarpengajuan', '$jangkawaktupengajuan', '$tanggalpengajuan')";
    $mysqli = Database::getInstance()->getConnection();
    $result = $mysqli->query($query);
    if($result){
        // header("location:admin/controller.php?hal=dashboard");
        echo "<script>alert('Berhasil Menambahkan.'); window.location = 'admin/pengajuan_pinjaman.php'</script>";
    }else{
        echo mysqli_error($mysqli);
        header("location:admin/pengajuan_pinjaman.php");
    }

}


function updatePengajuan($idpengajuan, $nopinjaman, $tujuanpengajuan, $besarpengajuan, $jangkawaktupengajuan, $tanggalpengajuan){
    $query = "UPDATE  pengajuan_pinjaman SET `idpengajuan` = '$idpengajuan', `nopinjaman` = '$nopinjaman', `tujuanpengajuan` = '$tujuanpengajuan', `besarpengajuan` = '$besarpengajuan', `jangkawaktupengajuan` = '$jangkawaktupengajuan', `tanggalpengajuan` = '$tanggalpengajuan' where idpengajuan = '$idpengajuan'" or die(mysql_error());
    $mysqli = Database::getInstance()->getConnection();
    $result = $mysqli->query($query);
    if($result){
        // header("location:admin/controller.php?hal=dashboard");
        echo "<script>alert('Berhasil Merubah Data.'); window.location = 'admin/pengajuan_pinjaman.php'</script>";
    }else{
        echo mysqli_error($mysqli);
        //header("location:admin/nasabah.php");
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

//Fungsi Hapus Nasabah
function hapusData($tabel,$key,$id){
    $query = "DELETE from $tabel where $key = '$id'" or die(mysql_error());
    $mysqli = Database::getInstance()->getConnection();
    $result = $mysqli->query($query);
    if($result){
        // header("location:admin/controller.php?hal=dashboard");
       echo "<script>alert('Berhasil Menghapus Data.'); window.location = '$tabel.php'</script>";
    }else{
        echo mysqli_error($mysqli);
        echo "<script>alert('Gagal Hapus Data.'); window.history.back();</script>";
    }
}

//Fungsi Update Pinjaman
function updatePinjaman($nopinjaman, $besarpinjaman, $barangjaminan, $tanggalpinjaman, $tanggalberakhir){
    $query = "UPDATE  pinjaman SET `nopinjaman` = '$nopinjaman', `besarpinjaman` = '$besarpinjaman', `barangjaminan` = '$barangjaminan', `tanggalpinjaman` = '$tanggalpinjaman', `tanggalberakhir` = '$tanggalberakhir' where nopinjaman = '$nopinjaman'" or die(mysql_error());
    $mysqli = Database::getInstance()->getConnection();
    $result = $mysqli->query($query);
    if($result){
        // header("location:admin/controller.php?hal=dashboard");
        echo "<script>alert('Berhasil Merubah Data.'); window.location = 'admin/pengajuan_pinjaman.php'</script>";
    }else{
        echo mysqli_error($mysqli);
        //header("location:admin/nasabah.php");
    }
}

/**
 * Kumpulan Func
 */


if($func == "updateNasabah"){
    updateNasabah($_GET['noidnasabah'], $_GET['namanasabah'], $_GET['jeniskelaminnasabah'], $_GET['tempatlahirnasabah'], $_GET['tanggallahirnasabah'], $_GET['agamanasabah'], $_GET['pendidikannasabah'], $_GET['tanggalpendaftaran']);
}

if ($func == "hapusData") {
    hapusData($_GET['tabel'],$_GET['key'],$_GET['noidnasabah']);
}


if($aksi == "validasiNis"){
    validasiNis($_POST['nis']);
}
if($aksi == "pilihOsis"){
    pilihOsis($_GET['nis'],$_GET['pilihan']);
}
?>