<?php
$title = 'Data Perkembangan Perbaikan';
$judul = $title;
$url = 'data_perbaikan';
$setTemplate = true;

if (isset($_POST['simpan'])) {
    if ($_POST['id'] == "") {
        // $data['nama_lengkap'] = $_POST['nama_lengkap'];
        // $data['kategori'] = $_POST['kategori'];
        // $data['foto_pengaduan'] = $_POST['foto_pengaduan'];
        $data['foto_perbaikan'] = $_POST['foto_perbaikan'];
        $data['keterangan'] = $_POST['keterangan'];
        $db->insert("tb_perbaikan", $data);
?>
        <script type="text/javascript">
            window.alert('Berhasil Dikirim');
            window.location.href = "<?= url('data_perbaikan') ?>";
        </script>
    <?php
    } else {
        $data['foto_perbaikan'] = $_POST['foto_perbaikan'];
        $data['keterangan'] = $_POST['keterangan'];
        $db->where('id', $_POST['id']);
        $db->update("tb_perbaikan", $data);
    ?>
        <script type="text/javascript">
            window.alert('Berhasil Dikirim');
            window.location.href = "<?= url('warga') ?>";
        </script>
    <?php }
}

if (isset($_GET['tambah']) or isset($_GET['ubah'])) {
    $id = "";
    $nama_lengkap = "";
    $kategori = "";
    $foto_aduan= "";
    $foto_perbaikan = "";
    $keterangan = "";

    if (isset($_GET['ubah']) and isset($_GET['id'])) {
        $db->join('tb_perbaikan b','a.id_perbaikan=b.id','LEFT');
        $db->join('tb_masyarakat c','a.nik=c.nik','LEFT');
        $db->where('a.id_pengaduan', $_GET['id']);
        $row = $db->ObjectBuilder()->getOne('tb_pengaduan a');
        if ($db->count > 0) {
            $id = $row->id_pengaduan;
            $nama_lengkap = $row->nama_lengkap;
            $foto_aduan = $row->foto_aduan;
            $kategori = $row->kategori;
            $foto_perbaikan = $row->foto_perbaikan;
            $keterangan = $row->keterangan;
        }
    }
?>

    <?= content_open('Form Data Perbaikan') ?>
    <form method="post" enctype="multipart/form-data">
        <?= input_hidden('id_pengaduan', $id) ?>
        <div class="form-group" class="">
            <label>Nama Pelapor</label>
            <div class="row">
            <div class="col-md-6">
            <?= input_text('nama_lengkap', $nama_lengkap) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <label>Kategori</label>
            <div class="row">
            <div class="col-md-6">
            <?= input_text('kategori', $kategori) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <label>Foto Pengaduan</label>
            <div class="row">
            <div class="col-md-6">
            <img src="<?=assets('unggah/'.$row->foto_pengaduan)?>" style="width:80px;height:80px;">
            </div>
            <div class="col-md-4">
            <?= input_file('foto_pengaduan', $foto_pengaduan) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <label>Foto Perkembangan</label>
            <div class="row">
            <div class="col-md-6">
            <?= input_text('foto_perbaikan', $foto_perbaikan) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <div class="row">
            <div class="col-md-6">
            <?= textarea('keterangan', $keterangan) ?>
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

    <?= content_open('Data Perbaikan') ?>
    
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
                    <td><div class="zoom"><img src="<?=assets('unggah/'.$row->foto_perbaikan)?>" style="width:50px;height:50px;"></div></td>
                    <td><?= $row->keterangan ?></td>
                    <td><?php if($row->status_perbaikan == "1"){
                        echo "Sedang Proses";
                    }else{
                        echo "Selesai";
                    } ?></td>
                    <td>
                        <a href="<?= url($url . '&ubah&id=' . $row->id_pengaduan) ?>" class="btn btn-info"> <i class="fa fa-edit"></i>Ubah</a>
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