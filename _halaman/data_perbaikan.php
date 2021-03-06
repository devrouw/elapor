<?php
$title = 'Data Perkembangan Perbaikan';
$judul = $title;
$url = 'data_perbaikan';
$setTemplate = true;

if (isset($_POST['simpan'])) {
    $file=upload('foto_perbaikan','');
    if($file!=false){
        $data['foto_perbaikan']=$file;
    }
    if ($_POST['id'] == "") {
        // $data['nama_lengkap'] = $_POST['nama_lengkap'];
        // $data['kategori'] = $_POST['kategori'];
        // $data['foto_pengaduan'] = $_POST['foto_pengaduan'];
        // $data['foto_perbaikan'] = $_POST['foto_perbaikan'];
        $data['keterangan'] = $_POST['keterangan'];
        $data['status_perbaikan'] = "2";
        $data['id_aduan'] = $_POST['id'];
        $db->insert("tb_perbaikan", $data);
?>
        <script type="text/javascript">
            window.alert('Berhasil Dikirim');
            window.location.href = "<?= url('data_perbaikan') ?>";
        </script>
    <?php
    } else {
        // $data['foto_perbaikan'] = $_POST['foto_perbaikan'];
        $data['keterangan'] = $_POST['keterangan'];
        $data['status_perbaikan'] = "2";
        $new_data['status'] = "3";
        $data['id_aduan'] = $_POST['id'];
        // $db->where('id', $_POST['id']);
        $db->insert("tb_perbaikan", $data);

        $db->where('id_pengaduan', $_POST['id']);
        $db->update("tb_pengaduan", $new_data);
    ?>
        <script type="text/javascript">
            window.alert('Berhasil Dikirim');
            window.location.href = "<?= url('data_perbaikan') ?>";
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
        $db->join('tb_perbaikan b','a.id_pengaduan=b.id_aduan','LEFT');
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
        <?= input_hidden('id', $id) ?>
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
            <a href="<?=assets('unggah/'.$row->foto_aduan)?>" target="_blank" rel="noopener noreferrer"><img src="<?=assets('unggah/'.$row->foto_aduan)?>" style="width:240px;height:150px;"></a>
            </div>
            <!-- <div class="col-md-3">
            </div> -->
            </div>
        </div>
        <div class="form-group">
            <label>Foto Perkembangan</label>
            <div class="row">
            <div class="col-md-3">
            <a href="<?=assets('unggah/'.$row->foto_perbaikan)?>" target="_blank" rel="noopener noreferrer"><img src="<?=assets('unggah/'.$row->foto_perbaikan)?>" style="width:240px;height:150px;"></a>
            </div>
            <div class="col-md-3">
            <?= input_file('foto_perbaikan', $foto_perbaikan, 'readURL(this)') ?>
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
    <table class="table table-bordered table-striped" id="example">
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
            $db->join('tb_perbaikan b','a.id_pengaduan=b.id_aduan','LEFT');
            $db->join('tb_masyarakat c','a.nik=c.nik','LEFT');
            $db->where('a.status', '1');
            $db->orderBy("a.id_pengaduan","desc");
            $get = $db->ObjectBuilder()->get('tb_pengaduan a');
            foreach ($get as $row) { ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->nama_lengkap ?></td>
                    <td><?= $row->kategori ?></td>
                    <td><div class="zoom"><img src="<?=assets('unggah/'.$row->foto_aduan)?>" style="width:50px;height:50px;"></div></td>
                    <td><div class="zoom"><img src="<?=assets('unggah/'.$row->foto_perbaikan)?>" style="width:50px;height:50px;"></div></td>
                    <td><?= $row->keterangan ?></td>
                    <td><?php if($row->status == "1"){
                        echo "Sedang Proses";
                    }else{
                        echo "Selesai";
                    } ?></td>
                    <td>
                        <a href="<?= url($url . '&ubah&id=' . $row->id_pengaduan) ?>" class="btn btn-info"> <i class="fa fa-edit"></i>Update</a>
                    </td>
                </tr>
            <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
    <?= content_close() ?>

    <?= content_open('Data Perbaikan Selesai') ?>
    
    <hr>
    <table class="table table-bordered table-striped" id="example">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelapor</th>
                <th>Kategori</th>
                <th>Foto Pengaduan</th>
                <th>Foto Perkembangan</th>
                <th>Keterangan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $db->join('tb_perbaikan b','a.id_pengaduan=b.id_aduan','LEFT');
            $db->join('tb_masyarakat c','a.nik=c.nik','LEFT');
            $db->where('b.status_perbaikan', '2');
            $get = $db->ObjectBuilder()->get('tb_pengaduan a');
            foreach ($get as $row) { ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->nama_lengkap ?></td>
                    <td><?= $row->kategori ?></td>
                    <td><div class="zoom"><img src="<?=assets('unggah/'.$row->foto_aduan)?>" style="width:50px;height:50px;"></div></td>
                    <td><div class="zoom"><img src="<?=assets('unggah/'.$row->foto_perbaikan)?>" style="width:50px;height:50px;"></div></td>
                    <td><?= $row->keterangan ?></td>
                    <td>Selesai</td>
                    
                </tr>
            <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
    <?= content_close() ?>
<?php } ?>