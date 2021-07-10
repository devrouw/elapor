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
    // $password = $_POST['password'];
    $s = substr(str_shuffle(str_repeat("!@#$%^&*()0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz", 6)), 0, 6);

    $query = "BEGIN; 
    INSERT INTO tb_masyarakat(
        nik,nama_lengkap,tempat_lahir,tgl_lahir,jenis_kelamin,alamat,email,password,no_telpon,kode_pos,kabupaten,kecamatan,kelurahan,foto_profil
    ) VALUES(
        '$nik','$nama_lengkap','$tempat_lahir','$tanggal_lahir','$jenis_kelamin','$alamat','$email','$password','$no_telepon','$kode_pos','$kabupaten','$kecamatan','$kelurahan','$foto_profil'
    );
    INSERT INTO tb_akun(
        email,password,nik
    ) VALUES (
        '$email','$s','$nik'
    );
    COMMIT;";

    $hasil = mysqli_multi_query($con,$query);
    if($hasil){
        $response["code"] = 200;
        $response["status"] = "OK";
        $response["data"] = "data berhasil diinput.";
        $response["message"] = $message;
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
        // $message = 'Selamat akun anda telah berhasil dibuat! <br>Sekarang anda bisa mengakses akun anda dengan informasi sbb:<br>
        //     Email: '.$email. ' Password: '.$s.'';
            // Always set content-type when sending HTML email
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
        $response["data"] = null;
        $response["message"] = "input error $message";
        
        echo json_encode($response);

    }

    $message = 'Data Berhasil Diinput!';
    
    // include './res.php';
die();
break;

#----------------------------------------------------------------------------------------------------------------------------------------
case "login":
    $type_query = "show";
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM tb_akun JOIN tb_masyarakat ON tb_akun.nik = tb_masyarakat.nik WHERE tb_akun.email='$email' AND tb_akun.password='$password'";
    $message = 'Data Ada!';
    
    include './res.php';
die();
break;

#----------------------------------------------------------------------------------------------------------------------------------------
case "input_aduan":
    $type_query = "input";
    $foto_aduan = $_POST['foto_aduan'];
    $pesan = $_POST['pesan'];
    $no_telpon = $_POST['no_telpon'];
    $lng = $_POST['lng'];
    $lat = $_POST['lat'];
    $kategori = $_POST['kategori'];
    $nik = $_POST['nik'];
    $id_dinas = $_POST['id_dinas'];

    $query = "INSERT INTO tb_pengaduan(
        foto_aduan,pesan,no_telpon,lng,lat,kategori,id_dinas,nik
    ) VALUES(
        '$foto_aduan','$pesan','$no_telpon','$lng','$lat','$kategori','$id_dinas','$nik'
    )";
    $message = 'Data Berhasil diinput!';
    
    include './res.php';
die();
break;

    }
}
