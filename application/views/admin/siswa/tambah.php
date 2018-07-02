<?php 
  if($this->session->flashdata('sukses')){
    echo "<div class='alert alert-success alert-message'> <i class='fa fa-check'></i>  ";
    echo $this->session->flashdata('sukses');
    echo "</div>";
  }
?>
<table class="table table-striped table-bordered">
	<thead>
		<td colspan="5" align="center"><b>DAFTAR NIS TERAKHIR DI MASING-MASING JURUSAN</b></td>
		<tr>
			<td align="center">EIND ( <b>eind18001</b> )</td>
			<td align="center">RPL ( <b>rpl18001</b> )</td>
			<td align="center">TKJ ( <b>tkj18001</b> )</td>
			<td align="center">TKR ( <b>tkr18001</b> )</td>
			<td align="center">TPTU ( <b>tptu18001</b> )</td>
		</tr>
	</thead>
	<tbody>
		<tr>
		<?php foreach($last_nis as $ln):?>
			<td align="center"><b><?=$ln->nis?></b></td>
		<?php endforeach ?>
		</tr>
	</tbody>
</table>
<form class="form-horizontal form-label-left" action="<?=base_url('admin/siswa/tambah')?>" method="POST" enctype="multipart/form-data">
	<div class="col-md-6" style="height:357px;padding:0px 5px 0px 0px;">
		<div class="form-group">
      <label>NIS <small>(Nomor Induk Siswa)</small></label>
      <input class="form-control" name="nis" placeholder="Nomor Induk Siswa" type="text" id="nis" autocomplete="off">
      <p id="stts" style="font-weight: bold;"></p>
      <?=form_error('nis','<p class="text-left" style="color:#FC624D!important;font-weight:bold;font-size:12px;">','</p>'); ?>	
    </div>
    <div class="form-group">
      <label>Nama</label>
      <input class="form-control" name="nama" placeholder="Nama" type="text">
      <?=form_error('nama','<p class="text-left" style="color:#FC624D!important;font-weight:bold;font-size:12px;">','</p>'); ?>	
    </div>
    <div class="form-group">
    	<label>Jenis Kelamin</label>
    	<select type="text" name="jenis_kelamin" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Jenis Kelamin">
    		<option value="cowo">Laki-Laki</option>
    		<option value="cewe">Perempuan</option>
    	</select>
    </div>
  	<div class="form-group">
  		<label>Tanggal Lahir</label>
      <input placeholder="Tanggal Lahir" name="tgl_lahir" class="form-control tanggal" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date">
      <?=form_error('tgl_lahir','<p class="text-left" style="color:#FC624D!important;font-weight:bold;font-size:12px;">','</p>'); ?>
		</div>
    <div class="form-group">
      <label>Angkatan</label>
      <input class="form-control" name="angkatan" placeholder="Angkatan" type="number">
      <?=form_error('angkatan','<p class="text-left" style="color:#FC624D!important;font-weight:bold;font-size:12px;">','</p>'); ?>	
    </div>
  </div>
  <div class="col-md-6" style="padding:0px 0px 0px 0px;">
    <div class="form-group">
      <label>Jurusan</label>
      <div class="form-group">
        <select name="id_jurusan" id="id_jurusan" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Jurusan" required>
          <?php foreach($jurusan as $j):?>
          <option value="<?=$j->id_jurusan?>"><?=$j->nama_jurusan?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>
    <div class="form-group">
    	<label>Kelas</label>
    	<select name="id_kelas" class="form-control">
      	<option>Pilih Kelas</option>
    	</select>
    </div>
  	<div class="form-group">
      <label>Photo</label>
      <input type="file" name="photo" class="form-control">
    </div>   
    <div class="form-group">
      <label>No Handphone</label>
      <input type="number" name="no_hp" class="form-control">
      
      <?=form_error('no_hp','<p class="text-left" style="color:#FC624D!important;font-weight:bold;font-size:12px;">','</p>'); ?>	
    </div>    
    <div class="form-group">
      <label>Alamat</label>
      <textarea name="alamat" class="form-control"></textarea>
      <?=form_error('alamat','<p class="text-left" style="color:#FC624D!important;font-weight:bold;font-size:12px;">','</p>'); ?>	
    </div>
    <div class="ln_solid"></div>
    <div class="form-group">
      <button id="send" type="submit" class="btn btn-primary">Simpan</button>
      <button id="send" type="reset" class="btn btn-default">Batal</button>
      <a href="<?=base_url('admin/siswa')?>" class="btn btn-dark">Kembali</a>
    </div>
  </div>
</form>


<script type="text/javascript">
  $('select[name="id_jurusan"]').on('change', function(){
    $.ajax({
      type : 'POST', 
      url  : '<?php echo site_url('admin/siswa/get_kelas'); ?>', 
      data : {
        id_jurusan : $(this).val()
      }, 
      success : function(option){
        $('select[name="id_kelas"]').html(option); 
      }
    }); 
  });
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#nis").change(function(){
			$('#stts').html("checking ...");    
			var nis  = $("#nis").val();
			$.ajax({
				type:"POST",
				url:"<?=base_url('admin/siswa/cek_nis')?>",    
				data: "nis=" + nis,
				success: function(data){
					if($("#nis").val() == ""){
						$("#stts").html('NIS Tidak Boleh Kosong <i class="fa fa-info"></i>').css('color','red');
						$('#nis').css('border', '1px solid red');
					}
					else if(data==0){
						$("#stts").html('NIS oke <i class="fa fa-check"></i>').css('color','green');
						$('#nis').css('border', '1px solid #ccc');
					}
					else{
						$("#stts").html('NIS sudah tersedia <i class="fa fa-remove"></i>').css('color','red');
						$('#nis').css('border', '1px solid red');
					}
				}
			});
		})
	});
</script>
