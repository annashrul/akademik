
<body class="nav-md">
  <div class="container body">
    <div class="main_container">

      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
          </div>

          <div class="clearfix"></div>
          <!--ADMIN-->
          <?php if($this->session->userdata('hak_akses') == 'admin'): ?>
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <ul class="nav side-menu">
                <li><a href="<?=base_url('admin/dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="<?=base_url('admin/guru')?>"><i class="fa fa-users"></i> Guru</a></li>
                <li><a href="<?=base_url('admin/siswa')?>"><i class="fa fa-child"></i> Siswa</a></li>
                <li><a href="<?=base_url('admin/jurusan')?>"><i class="fa fa-cogs"></i> Jurusan</a></li>
                <li><a href="<?=base_url('admin/kelas')?>"><i class="fa fa-home"></i> Kelas</a></li>
                <li><a href="<?=base_url('admin/pelajaran')?>"><i class="fa fa-book"></i> Pelajaran</a></li>
                <li><a href="<?=base_url('admin/jadwal')?>"><i class="fa fa-tasks"></i> Jadwal</a></li>
                <li><a href="<?=base_url('admin/jadwal/test')?>"><i class="fa fa-tasks"></i> debug</a></li>
                <li><a><i class="fa fa-exchange"></i> Pembayaran <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="<?=base_url('admin/pembayaran/spp')?>">SPP</a></li>
                    <li><a href="<?=base_url('admin/pembayaran/pembangunan')?>">Pembangunan</a></li>
                    <li><a href="<?=base_url('admin/pembayaran/ujikom')?>">UJIKOM</a></li>
                  </ul>
                </li>
                <li><a href="<?=base_url('auth/logout')?>"><i class="fa fa-sign-out"></i> Logout</a></li>
              </ul>
            </div>
          </div>
          <!--END ADMIN-->
          <!--GURU-->
          <?php elseif($this->session->userdata('hak_akses') == 'guru'): ?>
          
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <ul class="nav side-menu">
                <li><a href="<?=base_url('admin/dashboard')?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="<?=base_url('admin/jadwal')?>"><i class="fa fa-tasks"></i> Jadwal</a></li>
                <li><a href="<?=base_url('admin/guru/nilai')?>"><i class="fa fa-file-archive-o"></i> Nilai</a></li>
                <li><a href="<?=base_url('auth/logout')?>"><i class="fa fa-sign-out"></i> Logout</a></li>
              </ul>
            </div>
          </div>
          <!--END GURU-->
          <!--SISWA-->
          <?php else: ?>
          <!-- <div class="profile clearfix">
          <div class="profile_pic">
            <img src="" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Siswa</span>
              <h2></h2>
            </div>
          </div>
          <br/> -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <ul class="nav side-menu">
                <!-- <li><a href="<?=base_url('admin/guru')?>"><i class="fa fa-users"></i> Guru</a></li>
                <li><a href="<?=base_url('admin/siswa')?>"><i class="fa fa-child"></i> Siswa</a></li> -->
                <li><a href="<?=base_url('auth/logout')?>"><i class="fa fa-sign-out"></i> Logout</a></li>
              </ul>
            </div>
          </div>
          <?php endif ?>
          <!--END SISWA-->
        </div>
      </div>
     
      <div class="right_col" role="main">
        <div class="">
          <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2><?=$title?></h2>
                <div class="clearfix"></div>
              </div>
    
  
