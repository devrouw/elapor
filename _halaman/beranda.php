<?php
$title = 'Beranda';
$judul = $title;
$setTemplate = true;
?>
<?= content_open('Halaman Beranda') ?>
Selamat Datang <?=$session->get("dinas")?> di Beranda
<?= content_close() ?>