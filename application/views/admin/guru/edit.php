	<div class="x_content">
	  <form class="form-horizontal form-label-left" action="<?=base_url('admin/guru/edit/'.$guru->id_guru)?>" method="POST" enctype="multipart/form-data">
		  	<div class="form-group">
		  		<label>Tanggal Lahir</label>
		      <input placeholder="Tanggal Lahir" name="tgl_lahir" class="form-control tanggal" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" value="<?=$guru->tgl_lahir?>">
		      <?=form_error('tgl_lahir','<p class="text-left" style="color:#FC624D!important;font-weight:bold;font-size:12px;">','</p>'); ?>
				</div>
				<div class="form-group">
		      <label>NIG <small>(contoh : pgri301)</small></label>
		      <input class="form-control" name="nig" placeholder="NIG" type="text" value="<?=$guru->nig?>" disabled>
		      <?=form_error('nig','<p class="text-left" style="color:#FC624D!important;font-weight:bold;font-size:12px;">','</p>'); ?>	
		    </div>
		    <div class="form-group">
		      <label>Nama</label>
		      <input class="form-control" name="nama" placeholder="Nama" type="text" value="<?=$guru->nama?>"">
		      <?=form_error('nama','<p class="text-left" style="color:#FC624D!important;font-weight:bold;font-size:12px;">','</p>'); ?>	
		    </div>
		    <div class="form-group">
		      <label>Email</label>
		      <input type="email" id="email" name="email" class="form-control" value="<?=$guru->email?>"">
		      <?=form_error('email','<p class="text-left" style="color:#FC624D!important;font-weight:bold;font-size:12px;">','</p>'); ?>	
		    </div>
		  	<div class="form-group">
		      <label>Photo</label>
		      <input type="file" name="photo" class="form-control">
		    </div>   
		    <div class="form-group">
		      <label>No Handphone</label>
		      <input type="number" name="no_hp" class="form-control" value="<?=$guru->no_hp?>">
		      <?=form_error('no_hp','<p class="text-left" style="color:#FC624D!important;font-weight:bold;font-size:12px;">','</p>'); ?>	
		    </div>    
		    <div class="form-group">
		      <label>Alamat</label>
		      <textarea name="alamat" class="form-control"><?=$guru->alamat?></textarea>
		      <?=form_error('alamat','<p class="text-left" style="color:#FC624D!important;font-weight:bold;font-size:12px;">','</p>'); ?>	
		    </div>
	    <div class="ln_solid"></div>
	    <div class="form-group">
        <button id="send" type="submit" class="btn btn-primary">Simpan</button>
        <button id="send" type="reset" class="btn btn-default">Batal</button>
        <a href="<?=base_url('admin/guru')?>" class="btn btn-dark">Kembali</a>
	    </div>
	  </form>
	</div>
</div>