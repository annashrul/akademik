  
<?php 
    if($this->session->flashdata('sukses')){
      echo "<div class='alert alert-success alert-message'> <i class='fa fa-check'></i>  ";
      echo $this->session->flashdata('sukses');
      echo "</div>";
    }
  ?>
 
  <center><div class="btn-group dropdown" style="margin-top:10px;margin-bottom:0px;">
    <button type="button" class="btn btn-success">Manage Siswa</button>
    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="caret"></i></button>
    <ul class="dropdown-menu" role="menu">
      <?php foreach($guru as $j):?>
      <li style="font-size:14px;padding:5px"><a href="<?=base_url('admin/jadwal/jadwal_by_guru/'.$j->id_guru)?>" style="border-bottom:1px solid #EEEEEE;"><?=$j->nama?></a></li>
      <?php endforeach ?>
    </ul>
  </div></center>
  <table id="datatable" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Jurusan</th>
        <th>Pelajaran</th>
        <th>Hari</th>
        <th>Jam</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=1; foreach($jadwal as $j):?>
      <tr>
        <td><?=$no++?></td>
        <td><?=$j->nama?></td>
        <td><?=$j->daftar_kelas?></td>
        <td><?=$j->nama_jurusan?></td>
        <td><?=$j->nama_pelajaran?></td>
        <td><?=$j->hari?></td>
        <td><?=$j->jam?></td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>

  