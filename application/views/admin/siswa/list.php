
<?php 
  if($this->session->flashdata('sukses')){
    echo "<div class='alert alert-success alert-message'> <i class='fa fa-check'></i>  ";
    echo $this->session->flashdata('sukses');
    echo "</div>";
  }
?>

<div class="btn-group dropdown pull-right">
  <button type="button" class="btn btn-success">Manage Siswa</button>
  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="caret"></i></button>
  <ul class="dropdown-menu" role="menu">
    <?php foreach($jurusan as $j):?>
    <li style="font-size:14px;padding:5px"><a href="<?=base_url('admin/siswa/siswa_by_jurusan/'.$j->id_jurusan)?>" style="border-bottom:1px solid #EEEEEE;"><?=$j->nama_jurusan?></a></li>
    <?php endforeach ?>
  </ul>
</div>
<a href="<?=base_url('admin/siswa/report_pdf')?>" class="btn btn-primary pull-right" target="_blank">pdf <i class="fa fa-file-pdf-o"></i></a>
<?=form_open('admin/siswa/hapus_banyak'); ?>
<a href="<?=base_url('admin/siswa/tambah')?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
<button type="submit" class="btn btn-danger" onclick="return confirm('anda yakin')">delete masal <i class="fa fa-remove"></i></button>
<table id="datatable" class="table table-striped table-bordered" style="font-size:12px;">
  <thead>
    <tr>
      <th>Pilih</th>
      <th>NIS</th>
      <th>Nama</th>
      <th>Kelas</th>
      <th>Jurusan</th>
      <th>Alamat</th>
      <th>Tgl Lahir</th>
      <th>Status</th>
      <th>Pilihan</th>
    </tr>
  </thead>
  <tbody id="sortby" >
    <?php foreach($siswa as $s):?>
    <tr>
      <td>
        <input type="checkbox" name="id_siswa[]" value="<?=$s->id_siswa ?>">
      </td>
      <td><?=$s->nis?></td>
      <td><?=$s->nama?></td>
      <td><?=strtoupper($s->daftar_kelas)?></td>
      <td><?=$s->nama_jurusan?></td>
      <td><?=substr($s->alamat,0,30)?></td>
      <td><?=longdate_indo($s->tgl_lahir);?></td>
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
                      <img src="<?=base_url('assets/upload/siswa/'.$s->photo)?>" alt="" style="width:100%;height:500px;">
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
                      <td><?=longdate_indo($s->tgl_lahir);?></td>
                    </tr>
                    <tr>
                      <td>Jenis Kelamin</td>
                      <td><?php if($s->jenis_kelamin == 'cowo'){echo 'Laki-Laki'; }else{echo 'Perempuan';} ?></td>
                    </tr>
                    <tr>
                      <td>Angkatan</td>
                      <td><?=$s->angkatan?></td>
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
<?=form_close()?>
