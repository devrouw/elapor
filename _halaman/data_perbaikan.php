<?php
$title = 'Data Perkembangan Perbaikan';
$judul = $title;
$url = 'data_perbaikan';
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
    $id = "";
    $foto_aduan = "";
    $pesan = "";
    $no_telpon = "";
    $lng = "";
    $lat = "";
    $kategori = "";

    if (isset($_GET['ubah']) and isset($_GET['id'])) {
        $db->where('id', $_GET['id']);
        $row = $db->ObjectBuilder()->getOne('tb_pengaduan');
        if ($db->count > 0) {
            $id = $row->id;
            $foto_aduan = $row->foto_aduan;
            $no_telpon = $row->no_telpon;
            $lng = $row->lng;
            $lat = $row->lat;
            $kategori = $row->kategori;
        }
    }
?>

    <?= content_open('Form Data Perbaikan') ?>
    <form method="post" enctype="multipart/form-data">
        <?= input_hidden('id', $id) ?>
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
    
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelapor</th>
                <th>Kategori</th>
                <th>Foto Pengaduan</th>
                <th>Foto Perkembangan</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $db->join('tb_perbaikan b','a.id_perbaikan=b.id','LEFT');
            $db->join('tb_masyarakat c','a.nik=c.nik','LEFT');
            $db->where('a.status', '1');
            $get = $db->ObjectBuilder()->get('tb_pengaduan a');
            foreach ($get as $row) { ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->nama_lengkap ?></td>
                    <td><?= $row->kategori ?></td>
                    <td><div class="zoom"><img src="<?=assets('unggah/'.$row->foto_aduan)?>" style="width:50px;height:50px;"></div></td>
                    <td><?= $row->foto_perbaikan ?></td>
                    <td><?= $row->keterangan ?></td>
                    <td><?= $row->status_perbaikan ?></td>
                    <td>
                        <a href="<?= url($url . '&ubah&id=' . $row->id) ?>" class="btn btn-info"> <i class="fa fa-edit"></i>Ubah</a>
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