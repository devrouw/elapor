<?php
$title = 'Data Warga';
$judul = $title;
$url = 'warga';
$setTemplate = true;

if (isset($_POST['simpan'])) {
    if ($_POST['id_warga'] == "") {
        $data['username'] = $_POST['username'];
        $data['password'] = $_POST['password'];
        $data['nama_lengkap'] = $_POST['nama_lengkap'];
        $data['alamat'] = $_POST['alamat'];
        $data['no_telp'] = $_POST['no_telp'];
        $data['no_rumah'] = $_POST['no_rumah'];
        $db->insert("tb_warga", $data);
?>
        <script type="text/javascript">
            window.alert('Berhasil Disimpan');
            window.location.href = "<?= url('warga') ?>";
        </script>
    <?php
    } else {
        $data['username'] = $_POST['username'];
        $data['password'] = $_POST['password'];
        $data['nama_lengkap'] = $_POST['nama_lengkap'];
        $data['alamat'] = $_POST['alamat'];
        $data['no_telp'] = $_POST['no_telp'];
        $data['no_rumah'] = $_POST['no_rumah'];
        $db->where('id_warga', $_POST['id_warga']);
        $db->update("tb_warga", $data);
    ?>
        <script type="text/javascript">
            window.alert('Berhasil Diubah');
            window.location.href = "<?= url('warga') ?>";
        </script>
    <?php }
}

if (isset($_GET['hapus'])) {
    $db->where('id_warga', $_GET['id']);
    $db->delete("tb_warga"); ?>
    <script type="text/javascript">
        window.alert('Berhasil Dihapus');
        window.location.href = "<?= url('warga') ?>";
    </script>
<?php }

if (isset($_GET['tambah']) or isset($_GET['ubah'])) {
    $id_warga = "";
    $username = "";
    $password = "";
    $nama_lengkap = "";
    $alamat = "";
    $no_telp = "";
    $no_rumah = "";

    if (isset($_GET['ubah']) and isset($_GET['id'])) {
        $db->where('id_warga', $_GET['id']);
        $row = $db->ObjectBuilder()->getOne('tb_warga');
        if ($db->count > 0) {
            $id_warga = $row->id_warga;
            $username = $row->username;
            $password = $row->password;
            $nama_lengkap = $row->nama_lengkap;
            $alamat = $row->alamat;
            $no_telp = $row->no_telp;
            $no_rumah = $row->no_rumah;
        }
    }
?>

    <?= content_open('Form Data Akun Warga') ?>
    <form method="post" enctype="multipart/form-data">
        <?= input_hidden('id_warga', $id_warga) ?>
        <div class="form-group" class="">
            <label>Username</label>
            <div class="row">
            <div class="col-md-6">
            <?= input_text('username', $username) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <label>Password</label>
            <div class="row">
            <div class="col-md-6">
            <?= input_text('password', $password) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <label>Nama Lengkap</label>
            <div class="row">
            <div class="col-md-6">
            <?= input_text('nama_lengkap', $nama_lengkap) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <div class="row">
            <div class="col-md-6">
            <?= input_text('alamat', $alamat) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <label>No.Telp</label>
            <div class="row">
            <div class="col-md-6">
            <?= input_text('no_telp', $no_telp) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <label>No.Rumah</label>
            <div class="row">
            <div class="col-md-6">
            <?= input_text('no_rumah', $no_rumah) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" name="simpan" class="btn btn-info"> <i class="fa fa-save"></i>Simpan</button>
            <a href="<?= url($url) ?>" class="btn btn-danger"> <i class="fa fa-reply"></i>Kembali</a>
        </div>
    </form>
    <?= content_close() ?>
<?php } else { ?>

    <?= content_open('Data Warga') ?>
    <a href="<?= url($url . '&tambah') ?>" class="btn btn-success"><i class="fa fa-plus"></i>Tambah</a>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Password</th>
                <th>Nama Lengkap</th>
                <th>Alamat</th>
                <th>No.Telp</th>
                <th>No.Rumah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $get = $db->ObjectBuilder()->get('tb_warga');
            foreach ($get as $row) { ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->username ?></td>
                    <td><?= $row->password ?></td>
                    <td><?= $row->nama_lengkap ?></td>
                    <td><?= $row->alamat ?></td>
                    <td><?= $row->no_telp ?></td>
                    <td><?= $row->no_rumah ?></td>
                    <td>
                        <a href="<?= url($url . '&ubah&id=' . $row->id_warga) ?>" class="btn btn-info"> <i class="fa fa-edit"></i>Ubah</a>
                        <a href="<?= url($url . '&hapus&id=' . $row->id_warga) ?>" class="btn btn-danger" onclick="return confirm('Hapus Data?')"> <i class="fa fa-trash"></i>Hapus</a>
                    </td>
                </tr>
            <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
    <?= content_close() ?>
<?php } ?>