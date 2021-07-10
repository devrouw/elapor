<?php
set_time_limit(0);
date_default_timezone_set("Asia/Makassar");
include_once './conn.php';
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// mysqli_set_charset('utf8');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(json_decode(file_get_contents('php://input'), true)){
        $_POST = json_decode(file_get_contents('php://input'), true);
    };
    $date=date("Ymd-h_i_s");
    $case=$_POST['case'];
    switch($case){

#----------------------------------------------------------------------------------------------------------------------------------------
case "daftar":
    $type_query = "input";
    $nik = $_POST['nik'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $no_telepon = $_POST['no_telepon'];
    $kode_pos = $_POST['kode_pos'];
    $kabupaten = $_POST['kabupaten'];
    $kecamatan = $_POST['kecamatan'];
    $kelurahan = $_POST['kelurahan'];
    $foto_profil = $_POST['foto_profil'];

    $query = "INSERT INTO tb_user(
        nik,nama_lengkap,tempat_lahir,tgl_lahir,jenis_kelamin,alamat,email,no_telpon,kode_pos,kabupaten,kecamatan,kelurahan,foto_profil
    ) VALUES(
        '$nik','$nama_lengkap','$tempat_lahir','$tanggal_lahir','$jenis_kelamin','$alamat','$email','$no_telepon','$kode_pos','$kabupaten','$kecamatan','$kelurahan','$foto_profil'
    )";

    $message = 'Data Berhasil Diinput!';
    
    include './res.php';
die();
break;

#----------------------------------------------------------------------------------------------------------------------------------------
case "show_sub_category":
    $type_query = "show";
    $id = $_POST['id'];

    if($id == "all"){
        $query = "SELECT konten.id, konten.judul, konten.deskripsi, konten.gambar, konten.sumber, konten.id_category, category.category, category.subtitle FROM konten inner join category ON konten.id_category=category.id";
    }else{
        $query = "SELECT konten.id, konten.judul, konten.deskripsi, konten.gambar, konten.sumber, konten.id_category, category.category, category.subtitle FROM konten inner join category ON konten.id_category=category.id WHERE konten.id_category='$id'";
    }
    
    $message = 'Data Ada!';
    
    include './res.php';
die();
break;

#----------------------------------------------------------------------------------------------------------------------------------------
case "show_detail":
    $type_query = "show";
    $id = $_POST['id'];

    $query = "SELECT konten.id, konten.judul, konten.deskripsi, konten.gambar, konten.sumber, konten.id_category, category.category FROM konten inner join category ON konten.id_category=category.id WHERE konten.id='$id'";
    $message = 'Data Ada!';
    
    include './res.php';
die();
break;

    }
}
