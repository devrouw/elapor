<?php
$title = 'Data Kategori';
$judul = $title;
$url = 'data_kategori';
$setTemplate = true;

if (isset($_POST['simpan'])) {
    if ($_POST['id'] == "") {
        $data['nama_kategori'] = $_POST['nama_kategori'];
        $db->insert("tb_kategori", $data);
?>
        <script type="text/javascript">
            window.alert('Berhasil Disimpan');
            window.location.href = "<?= url('data_kategori') ?>";
        </script>
    <?php
    } else {
        $data['nama_kategori'] = $_POST['nama_kategori'];
        $db->where('id', $_POST['id']);
        $db->update("tb_kategori", $data);
    ?>
        <script type="text/javascript">
            window.alert('Berhasil Diubah');
            window.location.href = "<?= url('data_kategori') ?>";
        </script>
    <?php }
}

if (isset($_GET['hapus'])) {
    $db->where('id', $_GET['id']);
    $db->delete("tb_kategori"); ?>
    <script type="text/javascript">
        window.alert('Berhasil Dihapus');
        window.location.href = "<?= url('data_kategori') ?>";
    </script>
<?php }

if (isset($_GET['tambah']) or isset($_GET['ubah'])) {
    $id = "";
    $nama_kategori = "";

    if (isset($_GET['ubah']) and isset($_GET['id'])) {
        $db->where('id', $_GET['id']);
        $row = $db->ObjectBuilder()->getOne('tb_kategori');
        if ($db->count > 0) {
            $id = $row->id;
            $nama_kategori = $row->nama_kategori;
        }
    }
?>

    <?= content_open('Form Data Kategori') ?>
    <form method="post" enctype="multipart/form-data">
        <?= input_hidden('id', $id) ?>
        <div class="row">
        <div class="col-md-6"> 
        <div class="form-group" class="">
            <label>Nama Kategori</label>
            <div class="row">
            <div class="col-md-10">
            <?= input_text('nama_kategori', $nama_kategori) ?>
            </div>
            </div>
        </div>
        <div class="col-md-12">
        <br>
        <div class="form-group">
            <button type="submit" name="simpan" class="btn btn-info"> <i class="fa fa-save"></i>Simpan</button>
            <a href="<?= url($url) ?>" class="btn btn-danger"> <i class="fa fa-reply"></i>Kembali</a>
        </div>
        </div>
        </div>
        </div>
    </form>
    <?= content_close() ?>
<?php } else { ?>

    <?= content_open('Data Kategori') ?>
    <a href="<?= url($url . '&tambah') ?>" class="btn btn-success"><i class="fa fa-plus"></i>Tambah</a>
    <hr>
    <table class="table table-bordered table-striped" id="tbKategori">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $get = $db->ObjectBuilder()->get('tb_kategori');
            foreach ($get as $row) { ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->nama_kategori ?></td>
                    <td>
                    <a href="<?= url($url . '&ubah&id=' . $row->id) ?>" class="btn btn-info"> <i class="fa fa-edit"></i></a>
                    <a href="<?= url($url . '&hapus&id=' . $row->id) ?>" class="btn btn-danger" onclick="return confirm('Hapus Data?')"> <i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
    <script type="text/javascript">
            $(document).ready(function() {
    $('#example').DataTable();
} );
        </script>
    <?= content_close() ?>
<?php } ?>