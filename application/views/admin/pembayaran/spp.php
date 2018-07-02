
<div class="x_content" style="height:auto;">
	<form action="<?php echo base_url().'admin/pembayaran/pembayaran_spp'?>" method="post" style="margin-bottom:10px;">
		<?php 
	    if($this->session->flashdata('sukses')){
	      echo "<div class='alert alert-success alert-message'> <i class='fa fa-check'></i>  ";
	      echo $this->session->flashdata('sukses');
	      echo "</div>";
	    }
	  ?>
    <div class="col-md-3" style="padding:0px 5px 0px 0px;">
    	<label>NIS</label>
    	<input type="text" name="nis" id="nis" class="form-control" onkeyup="autofill()"></th>         
    </div>
  	<div id="detail_data"></div>      
  </form>
  <table id="datatable" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>NIS</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Jurusan</th>
        <th>jenis</th>
        <th>Biaya</th>
        <th>Bulan</th>
        <th>Tunai</th>
        <th>Kembalian</th>
        <th>Opsi</th>
      </tr>
    </thead>
    <tbody>
    	<?php $no=1; foreach($detailPembayaran as $dp):?>
    	<tr>
    		<td><?=$no++?></td>
    		<td><?=$dp->nis?></td>
    		<td><?=$dp->nama?></td>
    		<td><?=$dp->id_kelas?></td>
    		<td><?=$dp->jurusan?></td>
    		<td><?=$dp->jenis?></td>
    		<td><?='Rp.'.number_format($dp->biaya)?> || <?=ucwords(''.terbilang($dp->biaya).'')?></td>
    		<td><?=$dp->bulan?></td>
    		<td><?='Rp.'.number_format($dp->jumlah_uang)?></td>
    		<?php if($dp->kembalian == 'uang pas'){?>
    		<td><?=$dp->kembalian?></td>
    		<?php }elseif($dp->kembalian == 'uang kurang'){?>
    		<td><?=$dp->kembalian?></td>
        <?php }else{?>
        <td><?='Rp.'.number_format($dp->kembalian)?></td>
    		<?php } ?>
        <td><a href="<?=base_url('admin/pembayaran/cetak_pembayaran/'.$dp->id_detail_pembayaran)?>" class="btn btn-default" target="_blank"><i class="fa fa-print"></i></a></td>
    	</tr>
    	<?php endforeach ?>
    </tbody>
  </table>
</div>

<script type="text/javascript">
	function autofill(){
		var nis = $("#nis").val();
		$.ajax({
      type: "POST",
      url : "<?=base_url().'admin/pembayaran/get_data_pembayaran_spp';?>",
      data: "nis="+nis,
    }).success(function(msg){
      	$('#detail_data').html(msg);
    	});
	}
</script>