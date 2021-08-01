<?php
$title = 'Data Masyarakat';
$judul = $title;
$url = 'data_masyarakat';
$setTemplate = true;

if (isset($_POST['simpan'])) {
    $file=upload('foto_profil','');
    if($file!=false){
        $data['foto_profil']=$file;
    }
    if ($_POST['nik'] == "") {
        $data['nama_lengkap'] = $_POST['nama_lengkap'];
        $data['tempat_lahir'] = $_POST['tempat_lahir'];
        $data['tgl_lahir'] = $_POST['tgl_lahir'];
        $data['jenis_kelamin'] = $_POST['jenis_kelamin'];
        $data['alamat'] = $_POST['alamat'];
        $data['email'] = $_POST['email'];
        $data['password'] = $_POST['password'];
        $data['no_telpon'] = $_POST['no_telpon'];
        $data['kode_pos'] = $_POST['kode_pos'];
        $data['kabupaten'] = $_POST['kabupaten'];
        $data['kecamatan'] = $_POST['kecamatan'];
        $data['kelurahan'] = $_POST['kelurahan'];
        $db->insert("tb_masyarakat", $data);
?>
        <script type="text/javascript">
            window.alert('Berhasil Disimpan');
            window.location.href = "<?= url('data_masyarakat') ?>";
        </script>
    <?php
    } else {
        $data['nama_lengkap'] = $_POST['nama_lengkap'];
        $data['tempat_lahir'] = $_POST['tempat_lahir'];
        $data['tgl_lahir'] = $_POST['tgl_lahir'];
        $data['jenis_kelamin'] = $_POST['jenis_kelamin'];
        $data['alamat'] = $_POST['alamat'];
        $data['email'] = $_POST['email'];
        $data['password'] = $_POST['password'];
        $data['no_telpon'] = $_POST['no_telpon'];
        $data['kode_pos'] = $_POST['kode_pos'];
        $data['kabupaten'] = $_POST['kabupaten'];
        $data['kecamatan'] = $_POST['kecamatan'];
        $data['kelurahan'] = $_POST['kelurahan'];
        $db->where('nik', $_POST['nik']);
        $db->update("tb_masyarakat", $data);
    ?>
        <script type="text/javascript">
            window.alert('Berhasil Diubah');
            window.location.href = "<?= url('data_masyarakat') ?>";
        </script>
    <?php }
}

if (isset($_GET['hapus'])) {
    $db->where('nik', $_GET['nik']);
    $db->delete("tb_masyarakat"); ?>
    <script type="text/javascript">
        window.alert('Berhasil Dihapus');
        window.location.href = "<?= url('data_masyarakat') ?>";
    </script>
<?php }

if (isset($_GET['tambah']) or isset($_GET['ubah'])) {
    $nama_lengkap = "";
    $tempat_lahir = "";
    $tgl_lahir = "";
    $jenis_kelamin = "";
    $alamat = "";
    $no_telpon = "";
    $kode_pos = "";
    $kabupaten = "";
    $kecamatan = "";
    $kelurahan = "";
    $email = "";
    $password = "";

    if (isset($_GET['ubah']) and isset($_GET['nik'])) { ?>
        <script type="text/javascript">
        var element = document.querySelector("div.form-group");

document.querySelector('select[name=category]').addEventListener('change', function(){
  if(this.value == 'Laptop')
    element.style.display = 'none';
  else
    element.style.display = 'block';
})
        </script>
        <?php
        $db->where('nik', $_GET['nik']);
        $row = $db->ObjectBuilder()->getOne('tb_masyarakat');
        if ($db->count > 0) {
            $nik = $row->nik;
            $nama_lengkap = $row->nama_lengkap;
            $foto_profil = $row->foto_profil;
            $tempat_lahir = $row->tempat_lahir;
            $tgl_lahir = $row->tgl_lahir;
            $jenis_kelamin = $row->jenis_kelamin;
            $alamat = $row->alamat;
            $no_telpon = $row->no_telpon;
            $kode_pos = $row->kode_pos;
            $kabupaten = $row->kabupaten;
            $kecamatan = $row->kecamatan;
            $kelurahan = $row->kelurahan;
            $email = $row->email;
            $password = $row->password;
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
            <?= input_text('nama_lengkap', $nama_lengkap) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
            <div class="col-md-5">
            <label>Tempat Lahir</label>
            <?= input_text('tempat_lahir', $tempat_lahir) ?>
            </div>
            <div class="col-md-5">
            <label>Tanggal Lahir</label>
            <?= input_text('tgl_lahir', $tgl_lahir) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
            <div class="col-md-5">
            <label>Jenis Kelamin</label>
            <?php
	    		$op['Perempuan']='Perempuan';
                $op['Laki-Laki']='Laki-Laki';
	    		// foreach ($db->ObjectBuilder()->get('tb_warga') as $row) {
	    		// 	$op[$row->id_warga]=$row->username;
	    		// }
	    	?>
	    		<?=select('jenis_kelamin',$op,$jenis_kelamin)?>
            </div>
            <div class="col-md-5">
            <label>No Telepon</label>
            <?= input_text('no_telpon', $no_telpon) ?>
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
            <label>Kode Pos</label>
            <?= input_text('kode_pos', $kode_pos) ?>
            </div>
            <div class="col-md-5">
            <label>Kabupaten</label>
            <?= input_text('kabupaten', $kabupaten) ?>
            </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
            <div class="col-md-5">
            <label>Kecamatan</label>
            <?= input_text('kecamatan', $kecamatan) ?>
            </div>
            <div class="col-md-5">
            <label>Kelurahan</label>
            <?= input_text('kelurahan', $kelurahan) ?>
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-6">
        <h3>Data Akun</h3>
        <div class="form-group" class="">
            <label>Foto Profil</label>
            <div class="row">
            <div class="col-md-6">
            <img src="<?=assets('unggah/'.$row->foto_profil)?>" style="width:80px;height:80px;">
            </div>
            <div class="col-md-4">
            <?= input_file('foto_profil', $foto_profil) ?>
            </div>
            </div>
        </div>
        <div class="form-group" class="">
            <label>Email</label>
            <div class="row">
            <div class="col-md-10">
            <?= input_text('email', $email) ?>
            </div>
            </div>
        </div>
        <div class="form-group" class="">
            <label>Password</label>
            <div class="row">
            <div class="col-md-10">
            <?= input_password('password', $password) ?>
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
    <?= content_close() ?>
<?php } else { ?>

    <?= content_open('Data Masyarakat') ?>
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
                        <a href="<?= url($url . '&ubah&nik=' . $row->nik) ?>" class="btn btn-info"> <i class="fa fa-edit"></i>Ubah</a>
                        <a href="<?= url($url . '&hapus&nik=' . $row->nik) ?>" class="btn btn-danger" onclick="return confirm('Hapus Data?')"> <i class="fa fa-trash"></i>Hapus</a>
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