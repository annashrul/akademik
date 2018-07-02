
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle" style="border:1px solid black;">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <?php if($this->session->userdata('hak_akses') == 'admin'):?>
                <li class="" >
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?=base_url('assets/admin/production/images/img.jpg')?>" alt="">
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href=""> Profile</a></li>
                    <li><a href="<?=base_url('auth/logout')?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
                <li class="" style="padding-top:17px;">
                  <p class="text-center"><b>admin</b></p>
                </li>
                <?php elseif($this->session->userdata('hak_akses') == 'guru'):?>
                <li class="" >
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?=base_url('assets/upload/guru/'.$guru->photo)?>" alt="">
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href=""> Profile</a></li>
                    <li><a href="<?=base_url('auth/logout')?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
                <li class="" style="padding:5px;">
                  <p class="text-center"><?=$guru->nama?> <br/> <?='<b>( '.$guru->nig.' )</b>';?></p>
                </li>
              <?php elseif($this->session->userdata('hak_akses') == 'siswa'):?>
                <li class="" >
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?=base_url('assets/upload/siswa/'.$siswa->photo)?>" alt="">
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href=""> Profile</a></li>
                    <li><a href="<?=base_url('auth/logout')?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
                <li class="" style="padding:5px;">
                  <p class="text-center"><?=$siswa->nama?> <br/> <?='<b>( '.$siswa->nis.' )</b>';?></p>
                </li>
                <?php endif ?>
                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        
        
      

