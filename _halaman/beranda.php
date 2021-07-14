<?php
$title = 'Beranda';
$judul = $title;
$setTemplate = true;
?>
<?= content_open('Halaman Beranda') ?>
<h4 style="text-align: center"> <?= $session->get("dinas") ?><h4>
<h4 style="text-align: center">Kabupaten Penajam Paser</h4>
<br><br><br>
<!-- Boxes untuk data aduan -->
<div class="row align-items-center">
    <!--<div class="col-lg-1 "></div>-->
    <div class="col-md-auto"></div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua text-center">
            <div class="inner">
            <i class="fa fa-bell" style="font-size: 60px;"></i>
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
          <div class="small-box bg-green text-center">
            <div class="inner">
                <i class="fa fa-ban" style="font-size: 60px;"></i>
              <p>Belum ditangani</p>
            </div>
            <a href="#" class="small-box-footer">Selengkapnya<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow text-center">
            <div class="inner">
                <i class="fa fa-check-circle" style="font-size: 60px;"></i>
              <p>Sudah ditangani</p>
            </div>
            <a href="#" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-md-auto"></div>
        <!--<div class="col-lg-2"></div>-->
        </div>
    <?= content_close() ?>