<form method="POST" action="<?=base_url('admin/jadwal/test')?>">
  <?php 
    if($this->session->flashdata('sukses')){
      echo "<div class='alert alert-success alert-message'> <i class='fa fa-check'></i>  ";
      echo $this->session->flashdata('sukses');
      echo "</div>";
    }
  ?>
  <div class="col-md-12" style="padding:0px;">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Guru</th>
          <th>Jurusan</th>
          <th>Kelas</th>
          <th>Pelajaran</th>
          <th>Hari</th>
          <th>Jam</th>
        </tr>
      </thead>
      <tbody id="table-details">
        <tr id="row1" class="jdr1">
          <td>
            <select name="id_guru" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Guru" required>
              <?php foreach($guru as $g):?>
              <option value="<?=$g->id_guru?>"><?=$g->nama?></option>
              <?php endforeach ?>
            </select>
          </td>
          <td>
            <select name="id_jurusan" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Jurusan" required>
              <?php foreach($jurusan as $j):?>
              <option value="<?=$j->id_jurusan?>"><?=$j->nama_jurusan?></option>
              <?php endforeach ?>
            </select>
          </td>
          <td>
            <select name="id_kelas" class="form-control" style="height:42px;">
              <option>Pilih Kelas</option>
            </select>
          </td>
          <td>
            <select name="id_pelajaran" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Pelajaran" required>
              <?php foreach($pelajaran as $p):?>
              <option value="<?=$p->id_pelajaran?>"><?=$p->nama_pelajaran?></option>
              <?php endforeach ?>
            </select>
          </td>
          <td>
            <select name="hari" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Hari" required>
              <option value="Senin">Senin</option>
              <option value="Selasa">Selasa</option>
              <option value="Rabu">Rabu</option>
              <option value="Kamis">Kamis</option>
              <option value="Jumat">Jumat</option>
            </select>
          </td>     
          <td><input type="text" class="form-control" name="jam" required style="height:42px;"></td> 
        </tr>
      </tbody>
    </table>
    <button class="btn btn-primary  btn-add-more"><i class="fa fa-plus"></i></button>
    <button class="btn  btn-warning btn-remove-detail-row"><i class="glyphicon glyphicon-remove"></i></button>
    <button class="btn btn-success" type="submit" value="submit"><i class="fa fa-send"></i></button>
  </div>
</form>
<style type="text/css" media="screen">
  td.senin{background:#3f51b5!important;color:white!important;font-weight:bold;}
  td.selasa{background:#EEEEEE!important;color:black!important;font-weight:bold;}
  td.rabu{background:#b71c1c!important;color:white!important;font-weight:bold;}
  td.kamis{background:black!important;color:white!important;font-weight:bold;}
  td.jumat{background:#FFFFFF!important;color:black!important;font-weight:bold;}
</style>
<center>
  <div class="btn-group dropdown" style="margin-top:10px;margin-bottom:0px;">
    <button type="button" class="btn btn-success">Manage Siswa</button>
    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="caret"></i></button>
    <ul class="dropdown-menu" role="menu">
      <?php foreach($guru as $j):?>
      <li style="font-size:14px;padding:5px"><a href="<?=base_url('admin/jadwal/jadwal_by_guru/'.$j->id_guru)?>" style="border-bottom:1px solid #EEEEEE;"><?=$j->nama?></a></li>
      <?php endforeach ?>
    </ul>
  </div>
</center>
<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Jurusan</th>
      <th>Kelas</th>
      <th>Pelajaran</th>
      <th>Hari</th>
      <th>Jam</th>
      <th>Pilihan</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1; foreach($jadwal as $j):?>
    <tr>
      <?php if($j->hari == 'Senin'): ?>
      <td class="senin"><?=$no++?></td>
      <td class="senin"><?=$j->nama?></td>
      <td class="senin"><?=$j->nama_jurusan?></td>
      <td class="senin"><?=$j->daftar_kelas?></td>
      <td class="senin"><?=$j->nama_pelajaran?></td>
      <td class="senin"><?=$j->hari?></td>
      <td class="senin"><?=$j->jam?></td>
      <?php elseif($j->hari == 'Selasa'): ?>
      <td class="selasa"><?=$no++?></td>
      <td class="selasa"><?=$j->nama?></td>
      <td class="selasa"><?=$j->nama_jurusan?></td>
      <td class="selasa"><?=$j->daftar_kelas?></td>
      <td class="selasa"><?=$j->nama_pelajaran?></td>
      <td class="selasa"><?=$j->hari?></td>
      <td class="selasa"><?=$j->jam?></td>
      <?php elseif($j->hari == 'Rabu'): ?>
      <td class="rabu"><?=$no++?></td>
      <td class="rabu"><?=$j->nama?></td>
      <td class="rabu"><?=$j->nama_jurusan?></td>
      <td class="rabu"><?=$j->daftar_kelas?></td>
      <td class="rabu"><?=$j->nama_pelajaran?></td>
      <td class="rabu"><?=$j->hari?></td>
      <td class="rabu"><?=$j->jam?></td>
      <?php elseif($j->hari == 'Kamis'): ?>
      <td class="kamis"><?=$no++?></td>
      <td class="kamis"><?=$j->nama?></td>
      <td class="kamis"><?=$j->nama_jurusan?></td>
      <td class="kamis"><?=$j->daftar_kelas?></td>
      <td class="kamis"><?=$j->nama_pelajaran?></td>
      <td class="kamis"><?=$j->hari?></td>
      <td class="kamis"><?=$j->jam?></td>
      <?php elseif($j->hari == 'Jumat'): ?>
      <td class="jumat"><?=$no++?></td>
      <td class="jumat"><?=$j->nama?></td>
      <td class="jumat"><?=$j->nama_jurusan?></td>
      <td class="jumat"><?=$j->daftar_kelas?></td>
      <td class="jumat"><?=$j->nama_pelajaran?></td>
      <td class="jumat"><?=$j->hari?></td>
      <td class="jumat"><?=$j->jam?></td>
      <?php endif; ?>
      <td>
        <a class="btn btn-info btn-sm" href="#edit<?=$j->id_jadwal?>" data-toggle="modal" title="Edit"><i class="fa fa-refresh"></i></a>
        <a href="<?=base_url('admin/jadwal/delete/'.$j->id_jadwal)?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda Yakin Akan Menghapus Data Ini ??')"><i class="fa fa-remove"></i></a>
      </td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>

<?php foreach($jadwal as $j):?>
<div id="edit<?=$j->id_jadwal?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog" style="width:1000px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="myModalLabel">Edit Jadwal</h3>
      </div>
      <form class="form-horizontal" method="post" action="<?=base_url('admin/jadwal/update')?>">
        <div class="modal-body">
          <div class="form-group">
            <label>Guru</label>
            <select name="id_guru" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Guru" required>
              <?php foreach($guru as $g):?>
              <option value="<?=$g->id_guru?>" <?php if($g->id_guru == $j->id_guru){echo 'selected';} ?>><?=$g->nama?></option>
              <?php endforeach ?>
            </select>
            <input name="id_jadwal" id="id_jadwal" value="<?=$j->id_jadwal?>" type="hidden">
          </div>
          <div class="form-group">
            <label>Jurusan</label>
            <select name="id_jurusan" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Jurusan" required>
              <?php foreach($jurusan as $jur):?>
              <option value="<?=$jur->id_jurusan?>"<?php if($jur->id_jurusan == $j->id_jurusan){echo 'selected';} ?>><?=$jur->nama_jurusan?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label>Kelas</label>
            <select name="id_kelas" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Kelas" required>
              <?php foreach($kelas as $k):?>
              <option value="<?=$k->id_kelas?>"<?php if($k->id_kelas == $j->id_kelas){echo 'selected';} ?>><?=$k->daftar_kelas?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label>Pelajaran</label>
            <select name="id_pelajaran" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Pelajaran" required>
              <?php foreach($pelajaran as $p):?>
              <option value="<?=$p->id_pelajaran?>"<?php if($p->id_pelajaran == $j->id_pelajaran){echo 'selected';} ?>><?=$p->nama_pelajaran?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label>Hari</label>
            <select name="hari" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Hari" required>
              <option value="Senin"<?php if($j->hari == 'Senin'){echo 'selected';} ?>>Senin</option>
              <option value="Selasa"<?php if($j->hari == 'Selasa'){echo 'selected';} ?>>Selasa</option>
              <option value="Rabu"<?php if($j->hari == 'Rabu'){echo 'selected';} ?>>Rabu</option>
              <option value="Kamis"<?php if($j->hari == 'Kamis'){echo 'selected';} ?>>Kamis</option>
              <option value="Jumat"<?php if($j->hari == 'Jumat'){echo 'selected';} ?>>Jumat</option>
            </select>
          </div>
          <div class="form-group">
            <label>Jam</label>
            <input type="text" name="jam" class="form-control" value="<?=$j->jam?>">
          </div>
          <div class="modal-footer">
            <button type="submit" onclick="edit()" class="btn btn-primary">Simpan</button>
            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Tutup</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach ?>
<script type="text/javascript">
  $('select[name="id_jurusan"]').on('change', function(){
    $.ajax({
      type : 'POST', 
      url  : '<?php echo site_url('admin/jadwal/get_kelas'); ?>', 
      data : {
        id_jurusan : $(this).val()
      }, 
      success : function(option){
        $('select[name="id_kelas"]').html(option); 
      }
    }); 
  });
</script>