<?php
$title = 'Beranda';
$judul = $title;
$setTemplate = true;
?>
<?= content_open('Halaman Beranda') ?>
Selamat Datang <?= $session->get("dinas") ?> di Beranda

<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small card -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <?= content_close() ?>