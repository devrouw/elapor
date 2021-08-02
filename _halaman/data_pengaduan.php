<?php
$title = 'Data Pengaduan';
$judul = $title;
$url = 'data_pengaduan';
$setTemplate = true;

if (isset($_GET['tolak'])) {
    $data['status'] = '2';
    $db->where('id_pengaduan', $_GET['id']);
    $db->update("tb_pengaduan", $data); ?>
    <script type="text/javascript">
        window.alert('Data Aduan Ditolak');
        window.location.href = "<?= url('data_pengaduan') ?>";
    </script>
<?php }

if (isset($_GET['proses'])) {
    $data['status'] = '1';
    $db->where('id_pengaduan', $_GET['id']);
    $db->update("tb_pengaduan", $data);?>
    <script type="text/javascript">
        document.getElementById('tes').style.display = 'none';
        window.alert('Data Aduan Berhasil Diproses');
        window.location.href = "<?= url('data_pengaduan') ?>";
    </script>
<?php } ?>

    <?= content_open('Data Pengaduan Masuk') ?>
    <hr>
    <table class="table table-bordered table-striped" id="example">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelapor</th>
                <th>Kategori</th>
                <th>Foto Aduan</th>
                <th>Keterangan</th>
                <th>No Telp</th>
                <th>Lokasi GPS</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $db->join('tb_masyarakat b','a.nik=b.nik','LEFT');
            $db->where('a.status', '0');
            $db->orderBy("a.id_pengaduan","desc");
            $get = $db->ObjectBuilder()->get('tb_pengaduan a');
            foreach ($get as $row) { ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->nama_lengkap ?></td>
                    <td><?= $row->kategori ?></td>
                    <td><div class="zoom"><img src="<?=assets('unggah/'.$row->foto_aduan)?>" style="width:50px;height:50px;"></div></td>
                    <td><?= $row->pesan ?></td>
                    <td><?= $row->no_telpon ?></td>
                    <td><a href="http://maps.google.com/maps?q=<?= $row->lat ?>,<?= $row->lng ?>" target="_BLANK"><?= $row->lat ?>,<?= $row->lng ?></a></td>
                    <td>Belum ditangani</td>
                    <td>
                        <a href="<?= url($url . '&proses&id=' . $row->id_pengaduan) ?>" class="btn btn-success" onclick="return confirm('Proses Data?')"> <i class="fa fa-edit"></i>Proses</a>
                        <a href="<?= url($url . '&tolak&id=' . $row->id_pengaduan) ?>" class="btn btn-danger" onclick="return confirm('Tolak Data?')"> <i class="fa fa-trash"></i>Tolak</a>
                    </td>
                </tr>
            <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
    <?= content_close() ?>

    <?= content_open('Data Pengaduan Ditolak') ?>
    <hr>
    <table class="table table-bordered table-striped" id="example">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelapor</th>
                <th>Kategori</th>
                <th>Foto Aduan</th>
                <th>Keterangan</th>
                <th>No Telp</th>
                <th>Lokasi GPS</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $db->join('tb_masyarakat b','a.nik=b.nik','LEFT');
            $db->where('a.status', '2');
            $get = $db->ObjectBuilder()->get('tb_pengaduan a');
            foreach ($get as $row) { ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->nama_lengkap ?></td>
                    <td><?= $row->kategori ?></td>
                    <td><div class="zoom"><img src="<?=assets('unggah/'.$row->foto_aduan)?>" style="width:50px;height:50px;"></div></td>
                    <td><?= $row->pesan ?></td>
                    <td><?= $row->no_telpon ?></td>
                    <td><a href="http://maps.google.com/maps?q=<?= $row->lat ?>,<?= $row->lng ?>" target="_BLANK"><?= $row->lat ?>,<?= $row->lng ?></a></td>
                    <td>Ditolak</td>
                </tr>
            <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
    <?= content_close() ?>
