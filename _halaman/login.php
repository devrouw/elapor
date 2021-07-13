<?php
$setTemplate = false;
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $db->where("username",$username);
    $db->where("password",$password);
    $data = $db->ObjectBuilder()->getOne("tb_dinas");
    if($db->count>0){
        $session->set("logged", true);
        $session->set("dinas", $data->dinas);
        $session->set("id", $data->id);
        $session->set("info", '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Success!</h5>
        Username atau Password Benar</div>');
        redirect(url("beranda"));
    }
    else{
        $session->set("logged", false);
        $session->set("info", '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Error!</h5>
        Username atau Password Salah
      </div>');
      redirect(url("login"));
    }

}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Form Login</title>
    <?php include '_layouts/head.php' ?>
    <link rel="stylesheet" href="<?= templates() ?>plugins/iCheck/square/blue.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Login</b>E-Lapor</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Login untuk memulai Sesi</p>
            <?=$session->pull("info")?>
            <form method="post">
                <label>Nama Pengguna</label>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="username" placeholder="Username">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <label>Kata Sandi</label>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
</body>
<?php
include '_layouts/javascript.php';
?>
<script src="<?= templates() ?>plugins/iCheck/icheck.min.js"></script>
<script>
    $(function() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>

</html>