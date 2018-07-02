<style type="text/css" media="screen">
  #pesan{font-weight:bold;color:red!important; }
  #form_edit{display: none;}
</style>

<div class="x_content">
	<div class="col-md-6" style="padding:0px 5px 0px 0px;">
		<h4 class="text-center" id="pesan"></h4><br/>
		<label>Nama Pelajaran</label>
		<input type="text" id="nama_pelajaran" name="nama_pelajaran" class="form-control">
    <label>Jurusan</label>
    <select name="id_jurusan" id="id_jurusan" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Jurusan">
			<option value="umum">Umum</option>
			<?php foreach($jurusan as $j):?>
      <option value="<?=$j->id_jurusan?>"><?=$j->nama_jurusan?></option>
      <?php endforeach ?>
    </select>
  </div>
  
  <div class="col-md-12" style="padding:0px 0px 0px 0px;margin-top:10px;">
  	<button type="submit" name="submit" onclick="submit()" class="btn btn-primary">Simpan</button>
	</div>
	<br/>
  <?php echo form_open('admin/pelajaran/hapus_banyak'); ?>
  <div class="col-md-12" style="padding:0px 0px 0px 0px;margin-top:10px;">
  	<input type="submit" class="btn btn-default" value="Delete" onclick="return confirm('anda yakin')">
  </div>
  <table id="datatable" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>pilih</th>
        <th>Nama Jurusan</th>
        <th>Keterangan</th>
        <th>Pilihan</th>
      </tr>
    </thead>
    <tbody id="list_jurusan">
    	<?php $no=1; foreach ($pelajaran as $p):?>
				<tr>
					<td><input type="checkbox" name="id_pelajaran[]" value="<?=$p->id_pelajaran ?>"></td>
					<td><?=$p->nama_pelajaran ?></td>
					<?php if($p->id_jurusan == NULL):?>
					<td>Umum</td>
					<?php else: ?>
					<td><?=$p->nama_jurusan?></td>
					<?php endif; ?>
					<td>
						<a class="btn btn-warning" href="#edit<?=$p->id_pelajaran?>" data-toggle="modal" title="Edit">
              <span class="fa fa-refresh"></span>
            </a>
						<a href="<?=base_url('admin/pelajaran/delete/'.$p->id_pelajaran)?>" class="btn btn-danger" onclick="return confirm('Anda Yakin Akan Menghapus Data Ini ??')"><i class="fa fa-remove"></i></a>
					</td>
				</tr>
			<?php endforeach ?>
    </tbody>
  </table>
	<?php echo form_close()?>
</div>

<?php foreach($pelajaran as $p):?>
<div id="edit<?=$p->id_pelajaran?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="myModalLabel">Edit Pelajaran</h3>
      </div>
      <form class="form-horizontal" method="post" action="<?=base_url('admin/pelajaran/edit')?>">
        <div class="modal-body">
          <div class="form-group">
            <labe">Nama</label>
            <input name="nama_pelajaran" id="nama_pelajaran" value="<?=$p->nama_pelajaran?>" class="form-control" type="text" placeholder="Nama Item">
            <input name="id_pelajaran" id="id_pelajaran" value="<?=$p->id_pelajaran?>" type="hidden">
          </div>
          <div class="form-group">
            <label>Keterangan</label>
              <select name="id_jurusan" id="id_jurusan" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Jurusan">
								<option value="umum"<?php if($p->keterangan == 'umum'){echo 'selected';} ?>>Umum</option>
								<?php foreach($jurusan as $j):?>
    						<option value="<?=$j->id_jurusan?>" <?php if($j->id_jurusan == $p->id_jurusan){echo 'selected';} ?>><?=$j->nama_jurusan?></option>
     						<?php endforeach ?>
    					</select>
            </div>
            <div class="modal-footer">
	            <button type="submit" onclick="edit()" class="btn btn-primary">Simpan</button>
	            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Tutup</button>
	          </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach ?>
<script type="text/javascript" charset="utf-8" async defer>
  
  function submit(){
	  var pel = {
	  	"nama_pelajaran" 	: $("#nama_pelajaran").val(),
	  	"id_jurusan" 			: $("#id_jurusan").val(),
	  }
	  $.ajax({
	  	url:"<?=base_url('admin/pelajaran/tambah')?>",
	  	type:"POST",
	  	dataType:"JSON",
	  	data:pel,
	  	success:function(hasil){
	  		// console.log(hasil);
	  		$("#pesan").html(hasil.pesan).delay('4000').slideUp('slow');;
	  		if(hasil.pesan == ''){
	  			// alert('Data Berhasil Disimpan');
	  			location.reload();
	  		}
	  	}
	  });
	}
	function edit(){
		// alert('test');
		var new_pel = {
	  	"nama_pelajaran" 	: $("#nama_pelajaran").val(),
	  	"id_jurusan" 			: $("#id_jurusan").val(),
	  	"id_pelajaran" 		: $("#id_pelajaran").val()
	  }
	  $.ajax({
	  	url:"<?=base_url('admin/pelajaran/edit')?>",
	  	type:"POST",
	  	dataType:"JSON",
	  	data:new_pel,
	  	success:function(hasil){
	  		$("#pesan").html(hasil.pesan).delay('4000').slideUp('slow');
	  		if(hasil.pesan == ''){
	  			location.reload();
	  		}
	  	}
	  });
	}
</script>

