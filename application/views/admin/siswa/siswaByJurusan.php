<div class="x_content">
  <?php 
    if($this->session->flashdata('sukses')){
      echo "<div class='alert alert-success alert-message'> <i class='fa fa-check'></i>  ";
      echo $this->session->flashdata('sukses');
      echo "</div>";
    }
  ?>
  <div class="col-md-6" style="padding:0px;">
    <a href="<?=base_url('admin/siswa/tambah')?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
    <a href="<?=base_url('admin/siswa/report_pdf_by_jurusan/'.$siswa[0]->id_jurusan)?>" class="btn btn-primary" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
    <div class="btn-group dropdown" style="margin-top:-5px;">
      <button type="button" class="btn btn-success">Filter By Jurusan</button>
      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="caret"></i></button>
      <ul class="dropdown-menu" role="menu">
        <?php foreach($jurusan as $j):?>
        <li style="font-size:14px;padding:5px"><a href="<?=base_url('admin/siswa/siswa_by_jurusan/'.$j->id_jurusan)?>" style="border-bottom:1px solid #EEEEEE;"><?=$j->nama_jurusan?></a></li>
        <?php endforeach ?>
      </ul>
    </div>
    <div class="btn-group dropdown" style="margin-top:-5px;">
      <button type="button" class="btn btn-success">Filter By Kelas</button>
      <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="caret"></i></button>
      <ul class="dropdown-menu" role="menu">
        <?php foreach($siswa as $k):?>
        <li style="font-size:14px;padding:5px"><a href="<?=base_url('admin/siswa/siswa_by_kelas/'.$k->id_jurusan.'/'.$k->daftar_kelas)?>" style="border-bottom:1px solid #EEEEEE;"><?=$k->daftar_kelas?></a></li>
        <?php endforeach ?>
      </ul>
    </div>
    <a href="<?=base_url('admin/siswa')?>" class="btn btn-primary"><i class="fa fa-undo"></i></a>
    
  </div>
  
  <table id="datatable" class="table table-striped table-bordered" style="font-size:12px;">
    <thead>
      <tr>
        <th>No</th>
        <th>NIS</th>
        <th>Nama</th>
        <th>kelas</th>
        <th>Jurusan</th>
        <th>Alamat</th>
        <th>Tgl Lahir</th>
        <th>Status</th>
        <th>Pilihan</th>
      </tr>
    </thead>
    <tbody id="sortby">
      <?php $no=1; foreach($siswa as $s):?>
      <tr>
        <td><?=$no++?></td>
        <td><?=$s->nis?></td>
        <td><?=$s->nama?></td>
        <td><?=strtoupper($s->daftar_kelas)?></td>
        <td><?=$s->nama_jurusan?></td>
        <td><?=$s->alamat?></td>
        <td><?=date('F d Y',strtotime($s->tgl_lahir))?></td>
        <td><?=$s->status?></td>
        <td>
          <a href="<?=base_url('admin/siswa/edit/'.$s->id_siswa)?>" class="btn btn-info"><i class="fa fa-refresh"></i></a>
          <a href="<?=base_url('admin/siswa/delete/'.$s->id_siswa)?>" class="btn btn-danger" onclick="return confirm('Anda Yakin Akan Menghapus Data Ini ?')"><i class="fa fa-remove"></i></a>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal<?=$s->id_siswa?>"><i class="fa fa-eye"></i></button>
            <!-- Modal -->
            <div id="myModal<?=$s->id_siswa?>" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?=$s->nama?></h4>
                  </div>
                  <div class="modal-body">
                    <table class="table table-striped table-bordered">
                      <tr>
                        <img src="<?=base_url('assets/upload/siswa/'.$s->photo)?>" alt="" style="width:100%;height:400px;">
                      </tr>
                      <tr>
                        <td>NIS (Nomor Induk Siswa)</td>
                        <td><?=$s->nis?></td>
                      </tr>
                      <tr>
                        <td>nama</td>
                        <td><?=$s->nama?></td>
                      </tr>
                      <tr>
                        <td>Tanggal Lahir</td>
                        <td><?=date('F d Y',strtotime($s->tgl_lahir))?></td>
                      </tr>
                      <tr>
                        <td>Jurusan</td>
                        <td><?=$s->nama_jurusan?></td>
                      </tr>
                      <tr>
                        <td>No Handphone</td>
                        <td><?=$s->no_hp?></td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td><?=$s->alamat?></td>
                      </tr>
                      <tr>
                        <td>Status</td>
                        <td><?=$s->status?></td>
                      </tr>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /modals -->
        </td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
