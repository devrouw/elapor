<?php
$title = 'Data Masyarakat';
$judul = $title;
$url = 'data_masyarakat';
$setTemplate = true;

if (isset($_POST['simpan'])) {
    $file=upload('geojson_kelurahan','geojson');
    if($file!=false){
        $data['geojson_kelurahan']=$file;
    }
    if ($_POST['id_kelurahan'] == "") {
        $data['kd_kelurahan'] = $_POST['kd_kelurahan'];
        $data['nm_kelurahan'] = $_POST['nm_kelurahan'];
        $db->insert("tb_kelurahan", $data);
?>
        <script type="text/javascript">
            window.alert('Berhasil Disimpan');
            window.location.href = "<?= url('kelurahan') ?>";
        </script>
    <?php
    } else {
        $data['kd_kelurahan'] = $_POST['kd_kelurahan'];
        $data['nm_kelurahan'] = $_POST['nm_kelurahan'];
        $db->where('id_kelurahan', $_POST['id_kelurahan']);
        $db->update("tb_kelurahan", $data);
    ?>
        <script type="text/javascript">
            window.alert('Berhasil Diubah');
            window.location.href = "<?= url('kelurahan') ?>";
        </script>
    <?php }
}

if (isset($_GET['hapus'])) {
    $db->where('id_kelurahan', $_GET['id']);
    $db->delete("tb_kelurahan"); ?>
    <script type="text/javascript">
        window.alert('Berhasil Dihapus');
        window.location.href = "<?= url('kelurahan') ?>";
    </script>
<?php }

if (isset($_GET['tambah']) or isset($_GET['ubah'])) {
    $id_kelurahan = "";
    $kd_kelurahan = "";
    $nm_kelurahan = "";
    $geojson_kelurahan = "";

    if (isset($_GET['ubah']) and isset($_GET['id'])) {
        $db->where('id_kelurahan', $_GET['id']);
        $row = $db->ObjectBuilder()->getOne('tb_kelurahan');
        if ($db->count > 0) {
            $id_kelurahan = $row->id_kelurahan;
            $kd_kelurahan = $row->kd_kelurahan;
            $nm_kelurahan = $row->nm_kelurahan;
            $geojson_kelurahan = $row->geojson_kelurahan;
        }
    }
?>

    <?= content_open('Form Data Masyarakat') ?>
    <form method="post" enctype="multipart/form-data">
        <?= input_hidden('nik', $nik) ?>
        <div class="row">
        <div class="col-md-6">
        
        <div class="form-group" class="">
            <label>Nama Lengkap</label>
            <div class="row">
            <div class="col-md-10">
            <?= input_file('foto_bangunan', $foto_bangunan) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
            <div class="col-md-5">
            <label>Tempat Lahir</label>
            <?= input_text('lng', $lng) ?>
            </div>
            <div class="col-md-5">
            <label>Tanggal Lahir</label>
            <?= input_text('lat', $lat) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <label>Jenis Kelamin</label>
            <div class="row">
            <div class="col-md-10">
            <?= input_text('jenis_bangunan', $jenis_bangunan) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <label>Alamat</label>
            <div class="row">
            <div class="col-md-10">
            <?= input_text('alamat', $alamat) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <label>Nomor Telpon</label>
            <div class="row">
            <div class="col-md-10">
            <?= input_text('nomor_rumah', $nomor_rumah) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <label>Kode Pos</label>
            <div class="row">
            <div class="col-md-10">
            <?= input_text('luas_tanah', $luas_tanah) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <label>Kabupaten</label>
            <div class="row">
            <div class="col-md-10">
            <?= input_text('luas_bangunan', $luas_bangunan) ?>
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-6">
        <h3>Data Akun</h3>
        <div class="form-group" class="">
            <label>Email</label>
            <div class="row">
            <div class="col-md-10">
            <?= input_file('foto_bangunan', $foto_bangunan) ?>
            </div>
            </div>
        </div>
        <div class="form-group" class="">
            <label>Password</label>
            <div class="row">
            <div class="col-md-10">
            <?= input_file('foto_bangunan', $foto_bangunan) ?>
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-12">
        <hr>
        <div class="form-group">
            <button type="submit" name="simpan" class="btn btn-info"> <i class="fa fa-save"></i>Simpan</button>
            <a href="<?= url($url) ?>" class="btn btn-danger"> <i class="fa fa-reply"></i>Kembali</a>
        </div>
        </div>
        </div>
    </form>
    <form method="post" enctype="multipart/form-data">
        <?= input_hidden('nik', $nik) ?>
        <div class="form-group">
            <label>Kode Kelurahan</label>
            <?= input_text('kd_kelurahan', $kd_kelurahan) ?>
        </div>
        <div class="form-group">
            <label>Nama Kelurahan</label>
            <?= input_text('nm_kelurahan', $nm_kelurahan) ?>
        </div>
        <div class="form-group">
            <label>GeoJSON</label>
            <?= input_file('geojson_kelurahan', $geojson_kelurahan) ?>
        </div>
        <div class="form-group">
            <button type="submit" name="simpan" class="btn btn-info"> <i class="fa fa-save"></i>Simpan</button>
            <a href="<?= url($url) ?>" class="btn btn-danger"> <i class="fa fa-reply"></i>Kembali</a>
        </div>
    </form>
    <?= content_close() ?>
<?php } else { ?>

    <?= content_open('Data Masyarakat') ?>
    <a href="<?= url($url . '&tambah') ?>" class="btn btn-success"><i class="fa fa-plus"></i>Tambah</a>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th>Kode Pos</th>
                <th>Kabupaten</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $get = $db->ObjectBuilder()->get('tb_masyarakat');
            foreach ($get as $row) { ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->nik ?></td>
                    <td><?= $row->nama_lengkap ?></td>
                    <td><?= $row->tempat_lahir ?></td>
                    <td><?= $row->tgl_lahir ?></td>
                    <td><?= $row->jenis_kelamin ?></td>
                    <td><?= $row->alamat ?></td>
                    <td><?= $row->no_telpon ?></td>
                    <td><?= $row->kode_pos ?></td>
                    <td><?= $row->kabupaten ?></td>
                    <td><?= $row->kecamatan ?></td>
                    <td><?= $row->kelurahan ?></td>
                    <td>
                        <a href="<?= url($url . '&ubah&id=' . $row->nik) ?>" class="btn btn-info"> <i class="fa fa-edit"></i>Ubah</a>
                        <a href="<?= url($url . '&hapus&id=' . $row->nik) ?>" class="btn btn-danger" onclick="return confirm('Hapus Data?')"> <i class="fa fa-trash"></i>Hapus</a>
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