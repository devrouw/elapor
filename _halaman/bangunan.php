<?php
$title = 'Data Bangunan';
$judul = $title;
$url = 'bangunan';
$setTemplate = true;
$fileJs = 'leaflet-bangunanJs';

if (isset($_POST['simpan'])) {
    $file=upload('foto_bangunan','bangunan');
    if($file!=false){
        $data['foto_bangunan']=$file;
    }
    if ($_POST['id_bangunan'] == "") {
        $data['jenis_bangunan'] = $_POST['jenis_bangunan'];
        $data['alamat'] = $_POST['alamat'];
        $data['lng'] = $_POST['lng'];
        $data['lat'] = $_POST['lat'];
        $data['nomor_rumah'] = $_POST['nomor_rumah'];
        $data['luas_tanah'] = $_POST['luas_tanah'];
        $data['luas_bangunan'] = $_POST['luas_bangunan'];
        $data['id_warga'] = $_POST['id_warga'];
        $db->insert("tb_bangunan", $data);
?>
        <script type="text/javascript">
            window.alert('Berhasil Disimpan');
            window.location.href = "<?= url('bangunan') ?>";
        </script>
    <?php
    } else {
        $data['jenis_bangunan'] = $_POST['jenis_bangunan'];
        $data['alamat'] = $_POST['alamat'];
        $data['lng'] = $_POST['lng'];
        $data['lat'] = $_POST['lat'];
        $data['nomor_rumah'] = $_POST['nomor_rumah'];
        $data['luas_tanah'] = $_POST['luas_tanah'];
        $data['luas_bangunan'] = $_POST['luas_bangunan'];
        $data['id_warga'] = $_POST['id_warga'];
        $db->where('id_bangunan', $_POST['id_bangunan']);
        $db->update("tb_bangunan", $data);
    ?>
        <script type="text/javascript">
            window.alert('Berhasil Diubah');
            window.location.href = "<?= url('bangunan') ?>";
        </script>
    <?php }
}

if (isset($_GET['hapus'])) {
    $db->where('id_bangunan', $_GET['id']);
    $db->delete("tb_bangunan"); ?>
    <script type="text/javascript">
        window.alert('Berhasil Dihapus');
        window.location.href = "<?= url('bangunan') ?>";
    </script>
<?php }

if (isset($_GET['tambah']) or isset($_GET['ubah'])) {
    $id_bangunan = "";
    $foto_bangunan = "";
    $jenis_bangunan = "";
    $alamat = "";
    $lng = "";
    $lat = "";
    $nomor_rumah = "";
    $luas_tanah = "";
    $luas_bangunan = "";
    $id_warga = "";

    if (isset($_GET['ubah']) and isset($_GET['id'])) {
        $db->where('id_bangunan', $_GET['id']);
        $row = $db->ObjectBuilder()->getOne('tb_bangunan');
        if ($db->count > 0) {
            $id_bangunan = $row->id_bangunan;
            $foto_bangunan = $row->foto_bangunan;
            $jenis_bangunan = $row->jenis_bangunan;
            $alamat = $row->alamat;
            $lng = $row->lng;
            $lat = $row->lat;
            $nomor_rumah = $row->nomor_rumah;
            $luas_tanah = $row->luas_tanah;
            $luas_bangunan = $row->luas_bangunan;
            $id_warga = $row->id_warga;
        }
    }
?>

    <?= content_open('Form Data Bangunan') ?>
    <form method="post" enctype="multipart/form-data">
        <?= input_hidden('id_bangunan', $id_bangunan) ?>
        <div class="row">
        <div class="col-md-6">
        
        <div class="form-group" class="">
            <label>Foto Bangunan</label>
            <div class="row">
            <div class="col-md-10">
            <?= input_file('foto_bangunan', $foto_bangunan) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <label>Jenis Bangunan</label>
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
            <div class="row">
            <div class="col-md-5">
            <label>Longitude</label>
            <?= input_text('lng', $lng) ?>
            </div>
            <div class="col-md-5">
            <label>Latitude</label>
            <?= input_text('lat', $lat) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <label>Nomor Rumah</label>
            <div class="row">
            <div class="col-md-10">
            <?= input_text('nomor_rumah', $nomor_rumah) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <label>Luas Tanah</label>
            <div class="row">
            <div class="col-md-10">
            <?= input_text('luas_tanah', $luas_tanah) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <label>Luas Bangunan</label>
            <div class="row">
            <div class="col-md-10">
            <?= input_text('luas_bangunan', $luas_bangunan) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <label>Akun Warga</label>
            <div class="row">
            <div class="col-md-10">
            <?php
	    		$op['']='Pilih Akun Warga';
	    		foreach ($db->ObjectBuilder()->get('tb_warga') as $row) {
	    			$op[$row->id_warga]=$row->username;
	    		}
	    	?>
	    		<?=select('id_warga',$op,$id_warga)?>
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-6">
        <h3>Pilih Titik</h3>
        <div id="mapid" style="height:400px"></div>
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
    <?= content_close() ?>
<?php } else { ?>

    <?= content_open('Data Bangunan') ?>
    <a href="<?= url($url . '&tambah') ?>" class="btn btn-success"><i class="fa fa-plus"></i>Tambah</a>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto Bangunan</th>
                <th>Jenis Bangunan</th>
                <th>Alamat</th>
                <th>Lng</th>
                <th>Lat</th>
                <th>No.Rumah</th>
                <th>Luas Tanah</th>
                <th>Luas Bangunan</th>
                <th>Warga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $db->join('tb_warga b','a.id_warga=b.id_warga','LEFT');
            $get = $db->ObjectBuilder()->get('tb_bangunan a');
            foreach ($get as $row) { ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><img src="<?=assets('unggah/bangunan/'.$row->foto_bangunan)?>" style="width:50px;height:50px;"></td>
                    <td><?= $row->jenis_bangunan ?></td>
                    <td><?= $row->alamat ?></td>
                    <td><?= $row->lng ?></td>
                    <td><?= $row->lat ?></td>
                    <td><?= $row->nomor_rumah ?></td>
                    <td><?= $row->luas_tanah ?></td>
                    <td><?= $row->luas_bangunan ?></td>
                    <td><?= $row->username ?></td>
                    <td>
                        <a href="<?= url($url . '&ubah&id=' . $row->id_bangunan) ?>" class="btn btn-info"> <i class="fa fa-edit"></i>Ubah</a>
                        <a href="<?= url($url . '&hapus&id=' . $row->id_bangunan) ?>" class="btn btn-danger" onclick="return confirm('Hapus Data?')"> <i class="fa fa-trash"></i>Hapus</a>
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