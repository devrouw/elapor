<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=templates()?>dist/img/logo_dlh.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Hello</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="<?=url('beranda')?>">
            <i class="fa fa-dashboard"></i> <span>Beranda</span>
          </a>
        </li>
        <li>
          <a href="<?=url('data_kategori')?>">
            <i class="fa fa-tasks"></i> <span>Kategori</span>
          </a>
        </li>
        <li>
        <a href="<?=url('data_masyarakat')?>">
        <i class="fa fa-users"></i> <span>Data Masyarakat</span>
        </a>
        </li>
        <li>
        <a href="<?=url('data_pengaduan')?>">
        <i class="fa fa-exclamation-circle"></i> <span>Data Pengaduan</span>
        </a>
        </li>
        <li>
        <a href="<?=url('data_perbaikan')?>">
        <i class="fa fa-check-circle"></i> <span>Data Perkembangan Perbaikan</span>
        </a>
        </li>
        <li>
          <a href="<?=url('logout')?>">
            <i class="fa fa-sign-out"></i> <span>Keluar</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>