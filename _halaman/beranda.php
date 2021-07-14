<?php
$title = 'Beranda';
$judul = $title;
$setTemplate = true;
?>
<?= content_open('Halaman Beranda') ?>
<h3> <?= $session->get("dinas") ?><h3><br>
<h3>Kabupaten Penajam Paser</h3>
<!-- Boxes untuk data aduan -->
<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <i class="fa fa-bell"></i>
              <p>Pengaduan Masuk</p>
            </div>
            <!-- <div class="icon">
              <i class="ion ion-bag"></i>
            </div> -->
            <a href="#" class="small-box-footer">Selengkapnya<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Belum ditangani</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Selengkapnya<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>Sudah ditangani</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    <?= content_close() ?>