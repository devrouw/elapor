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
    $nama_foto = $_POST['nama_foto'];
    $s = substr(str_shuffle(str_repeat("!@#$%^&*()0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz", 6)), 0, 6);
    $realImage = base64_decode($foto_profil);

    $query = "INSERT INTO tb_masyarakat(
        nik,nama_lengkap,tempat_lahir,tgl_lahir,jenis_kelamin,alamat,email,password,no_telpon,kode_pos,kabupaten,kecamatan,kelurahan,foto_profil
    ) VALUES(
        '$nik','$nama_lengkap','$tempat_lahir','$tanggal_lahir','$jenis_kelamin','$alamat','$email','$s','$no_telepon','$kode_pos','$kabupaten','$kecamatan','$kelurahan','$nama_foto'
    )";

    $hasil = mysqli_multi_query($con,$query);
    if($hasil){
        file_put_contents("../assets/unggah/".$nama_foto,$realImage);
        
        $response["code"] = 200;
        $response["status"] = "OK";
        $response["data"] = "data berhasil diinput.";
        $response["message"] = "Berhasil Mendaftar!";
        $subject = 'Akun Anda Berhasil dibuat';
        echo json_encode($response);

        $message = "
        <html>
        <head>
        <title>Akun Berhasil Dibuat</title>
        </head>
        <body>
        <h3>Selamat! Akun Anda berhasil dibuat! Silakan login menggunakan informasi berikut:</h3>
        <br>
        <b>Email: <b> ".$email."
        <br>
        <b>Password: ".$s."</b>
        </body>
        </html>
        ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: info@sha-dev.com'       . "\r\n" .
                    'Reply-To: info@sha-dev.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

        mail($email, $subject, $message, $headers);
    }else
    {
        $response["code"] = 404;
        $response["status"] = "error";
        $response["data"] = "data gagal diinput";
        $response["message"] = "NIK sudah terdaftar";
        
        echo json_encode($response);

    }

    // $message = 'Data Berhasil Diinput!';
    
    // include './res.php';
die();
break;


#----------------------------------------------------------------------------------------------------------------------------------------
case "edit_biodata":
    $type_query = "update";
    $nik = $_POST['nik'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $no_telepon = $_POST['no_telepon'];
    $kode_pos = $_POST['kode_pos'];
    $kabupaten = $_POST['kabupaten'];
    $kecamatan = $_POST['kecamatan'];
    $kelurahan = $_POST['kelurahan'];
    $foto_profil = $_POST['foto_profil'];
    $nama_foto = $_POST['nama_foto'];

    if($nama_foto == ""){
        $query = "UPDATE tb_masyarakat SET
        nama_lengkap = '$nama_lengkap',
        tempat_lahir = '$tempat_lahir',
        tgl_lahir = '$tanggal_lahir',
        jenis_kelamin = '$jenis_kelamin',
        alamat = '$alamat',
        email = '$email',
        password = '$password',
        no_telpon = '$no_telepon',
        kode_pos = '$kode_pos',
        kabupaten = '$kabupaten',
        kecamatan = '$kecamatan',
        kelurahan = '$kelurahan'
        WHERE nik = '$nik'";
    }else{
        $realImage = base64_decode($foto_profil);
        $query = "UPDATE tb_masyarakat SET
        nama_lengkap = '$nama_lengkap',
        tempat_lahir = '$tempat_lahir',
        tgl_lahir = '$tanggal_lahir',
        jenis_kelamin = '$jenis_kelamin',
        alamat = '$alamat',
        email = '$email',
        password = '$password',
        no_telpon = '$no_telepon',
        kode_pos = '$kode_pos',
        kabupaten = '$kabupaten',
        kecamatan = '$kecamatan',
        kelurahan = '$kelurahan',
        foto_profil = '$nama_foto'
        WHERE nik = '$nik'";
    }
    

    $hasil = mysqli_multi_query($con,$query);
    if($hasil){
        if($nama_foto != ""){
            file_put_contents("../assets/unggah/".$nama_foto,$realImage);
        }
        
        $response["code"] = 200;
        $response["status"] = "OK";
        $response["data"] = "data berhasil diinput.";
        $response["message"] = "Data berhasil diinput";
        echo json_encode($response);
    }else
    {
        $response["code"] = 404;
        $response["status"] = "error";
        $response["data"] = "data gagal diinput.";
        $response["message"] = "input error";
        
        echo json_encode($response);

    }

    // $message = 'Data Berhasil Diubah!';
    
    // include './res.php';
die();
break;

#----------------------------------------------------------------------------------------------------------------------------------------
case "login":
    $type_query = "show";
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM tb_masyarakat WHERE email='$email' AND password='$password'";
    $message = 'Data Ada!';
    
    include './res.php';
die();
break;

#----------------------------------------------------------------------------------------------------------------------------------------
case "input_aduan":
    $type_query = "input";
    $nama_foto = $_POST['nama_foto'];
    $foto_aduan = $_POST['foto_aduan'];
    $pesan = $_POST['pesan'];
    $no_telpon = $_POST['no_telpon'];
    $lng = $_POST['lng'];
    $lat = $_POST['lat'];
    $kategori = $_POST['kategori'];
    $nik = $_POST['nik'];
    $id_dinas = $_POST['id_dinas'];
    $realImage = base64_decode($foto_aduan);

    file_put_contents("../assets/unggah/".$nama_foto,$realImage);

    $query = "INSERT INTO tb_pengaduan(
        foto_aduan,pesan,no_telpon,lng,lat,kategori,id_dinas,nik,status
    ) VALUES(
        '$nama_foto','$pesan','$no_telpon','$lng','$lat','$kategori','1','$nik','0'
    )";
    $message = 'Data Berhasil diinput!';
    
    include './res.php';
die();
break;

#----------------------------------------------------------------------------------------------------------------------------------------
case "list_dinas":
    $type_query = "show";

    $query = "SELECT * FROM tb_dinas";
    $message = 'Data Ada!';
    
    include './res.php';
die();
break;

#----------------------------------------------------------------------------------------------------------------------------------------
case "list_aduan":
    $type_query = "show";
    $nik = $_POST['nik'];

    $query = "SELECT * FROM tb_pengaduan WHERE nik='$nik'";
    $message = 'Data Ada!';
    
    include './res.php';
die();
break;

#----------------------------------------------------------------------------------------------------------------------------------------
case "list_perbaikan":
    $type_query = "show";
    $nik = $_POST['nik'];

    $query = "SELECT * FROM tb_perbaikan JOIN tb_pengaduan ON tb_perbaikan.id_aduan=tb_pengaduan.id_pengaduan JOIN tb_dinas ON tb_pengaduan.id_dinas=tb_dinas.id WHERE tb_pengaduan.nik='$nik'";
    $message = 'Data Ada!';
    
    include './res.php';
die();
break;

#----------------------------------------------------------------------------------------------------------------------------------------
case "detail_perbaikan":
    $type_query = "show";
    $nik = $_POST['nik'];
    // $id = $_POST['id'];
    $id_aduan = $_POST['id_aduan'];
    
    $query = "SELECT * FROM tb_pengaduan LEFT JOIN tb_perbaikan ON tb_pengaduan.id_pengaduan=tb_perbaikan.id_aduan JOIN tb_dinas ON tb_pengaduan.id_dinas=tb_dinas.id JOIN tb_masyarakat ON tb_pengaduan.nik=tb_masyarakat.nik WHERE tb_pengaduan.id_pengaduan='$id_aduan'";

    // if($id == "0"){
    //     $query = "SELECT * FROM tb_pengaduan LEFT JOIN tb_perbaikan ON tb_pengaduan.id_pengaduan=tb_perbaikan.id_aduan JOIN tb_dinas ON tb_pengaduan.id_dinas=tb_dinas.id JOIN tb_masyarakat ON tb_pengaduan.nik=tb_masyarakat.nik WHERE tb_pengaduan.id_pengaduan='$id_aduan'";
    // }else{
    //     $query = "SELECT * FROM tb_perbaikan JOIN tb_pengaduan ON tb_perbaikan.id_aduan=tb_pengaduan.id_pengaduan JOIN tb_dinas ON tb_pengaduan.id_dinas=tb_dinas.id JOIN tb_masyarakat ON tb_pengaduan.nik=tb_masyarakat.nik WHERE tb_perbaikan.id_aduan='$id_aduan'";
    // }

    $message = 'Data Ada!';
    
    include './res.php';
die();
break;

#----------------------------------------------------------------------------------------------------------------------------------------
case "biodata":
    $type_query = "show";
    $nik = $_POST['nik'];

    $query = "SELECT * FROM tb_masyarakat WHERE nik='$nik'";
    $message = 'Data Ada!';
    
    include './res.php';
die();
break;

    }
}
