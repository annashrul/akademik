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
  <form class="form-horizontal form-label-left" action="<?=base_url('admin/siswa/edit/'.$siswa->id_siswa)?>" method="POST" enctype="multipart/form-data">
  	<div class="col-md-6">
			<div class="form-group">
	      <label>NIS <small>(Nomor Induk Siswa)</small></label>
	      <input class="form-control" name="nis" placeholder="Nomor Induk Siswa" type="text" value="<?=$siswa->nis?>">
	    </div>
	    <div class="form-group">
	      <label>Nama</label>
	      <input class="form-control" name="nama" placeholder="Nama" type="text" value="<?=$siswa->nama?>">
	      <?=form_error('nama','<p class="text-left" style="color:#FC624D!important;font-weight:bold;font-size:12px;">','</p>'); ?>	
	    </div>
	    <div class="form-group">
	    	<label>Jenis Kelamin</label>
	    	<select type="text" name="jenis_kelamin" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Jenis Kelamin">
	    		<option value="cowo"<?php if($siswa->jenis_kelamin == 'cowo'){echo 'selected'; } ?>>Laki-Laki</option>
	    		<option value="cewe"<?php if($siswa->jenis_kelamin == 'cewe'){echo 'selected'; } ?>>Perempuan</option>
	    	</select>
	    </div>
	  	<div class="form-group">
	  		<label>Tanggal Lahir</label>
	      <input placeholder="Tanggal Lahir" name="tgl_lahir" class="form-control tanggal" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" value="<?=$siswa->tgl_lahir?>">
	      <?=form_error('tgl_lahir','<p class="text-left" style="color:#FC624D!important;font-weight:bold;font-size:12px;">','</p>'); ?>
			</div>
	    <div class="form-group">
	      <label>Angkatan</label>
	      <input class="form-control" name="angkatan" placeholder="Angkatan" type="number" value="<?=$siswa->angkatan?>">
	    </div>
	  </div>
	  <div class="col-md-6">
	    <div class="form-group">
        <label>Jurusan</label>
        <select name="id_jurusan" class="selectpicker show-tick form-control" data-live-search="true" title="PIlih Jurusan">
 					<?php foreach($jurusan as $j):?>
          <option value="<?=$j->id_jurusan?>"<?php if($j->id_jurusan == $siswa->id_jurusan):echo 'selected';endif;?>>
          	<?=$j->nama_jurusan?>
        	</option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="form-group">
	    	<label>Kelas</label>
	    	<select name="id_kelas" class="selectpicker show-tick form-control" data-live-search="true" title="PIlih Kelas">
	    		<?php foreach($kelas as $k):?>
          <option value="<?=$k->id_kelas?>"<?php if($k->id_kelas == $siswa->id_kelas):echo 'selected';endif;?>>
          	<?=$k->daftar_kelas?>
        	</option>
          <?php endforeach ?>
	    	</select>
	    </div>
	  	<div class="form-group">
	      <label>Photo</label>
	      <input type="file" name="photo" class="form-control">
	    </div>   
	    <div class="form-group">
	      <label>No Handphone</label>
	      <input type="number" name="no_hp" class="form-control" value="<?=$siswa->no_hp?>">
	      <?=form_error('no_hp','<p class="text-left" style="color:#FC624D!important;font-weight:bold;font-size:12px;">','</p>'); ?>	
	    </div>    
	    <div class="form-group">
	      <label>Alamat</label>
	      <textarea name="alamat" class="form-control"><?=$siswa->alamat?></textarea>
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
</div>
