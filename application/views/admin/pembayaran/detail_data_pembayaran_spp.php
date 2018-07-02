<?php 
  $s=$siswa->row_array();
?>
<div class="col-md-3" style="padding:0px 5px 0px 0px;">
  <label>Nama</label>
  <input type="text" name="nama" value="<?=$s['nama']?>" class="form-control" readonly>
</div>
<div class="col-md-3" style="padding:0px 5px 0px 0px;">
  <label>Kelas</label>
  <input type="text" name="id_kelas" value="<?=$s['daftar_kelas']?>" class="form-control" readonly>
</div>
<div class="col-md-3" style="padding:0px 5px 0px 0px;">
  <label>Jurusan</label>
  <input type="text" name="jurusan" value="<?=$s['nama_jurusan']?>" class="form-control" readonly>
</div>

<style type="text/css" media="screen">
  .detail_biaya{margin-top:10px;margin-bottom:10px;padding:0px 5px 0px 0px;}
</style>
<div class="col-md-2 detail_biaya">
  <label>Jenis Pembayaran</label>
  <select name="jenis" id="example" class="form-control input-sm" required>
    <?php foreach($pembayaran as $p): ?>
    <option data-info="<?=$p->biaya?>"><?=$p->jenis?></option>
    <?php endforeach; ?>
  </select>
</div>
<div class="col-md-2 detail_biaya">  
  <label>Biaya</label>
  <input type="text" name="biaya" id="biaya" value="<?=$pembayaran[0]->biaya?>"" class="form-control input-sm" readonly>
</div>
<div class="col-md-2 detail_biaya">
  <label>Bulan</label>  
  <select name="bulan" class="form-control input-sm" required>
    <option value="januari">januari</option>
    <option value="februari">februari</option>
    <option value="maret">maret</option>
    <option value="april">april</option>
    <option value="mei">mei</option>
    <option value="juni">juni</option>
    <option value="juli">juli</option>
    <option value="agustus">agustus</option>
    <option value="september">september</option>
    <option value="oktober">oktober</option>
    <option value="november">november</option>
    <option value="desember">desember</option>
  </select>
</div>
<div class="col-md-2 detail_biaya">
  <label>Tunai</label>
  <input type="text" name="jumlah_uang" id="uang" class="form-control input-sm" required>
</div>
<div class="col-md-2 detail_biaya" id="wrap_kembalian">
  <label id="lab">Kembalian</label>
  <input type="text" name="kembalian" id="kembalian" class="form-control input-sm">
</div>
<div class="col-md-2 detail_biaya" id="wrap_kembalian">
  <label id="lab">Tanggal</label>
  <input type="text" name="tanggal_bayar" id="tgl_bayar" class="form-control input-sm" value="<?=date('d F Y')?>" readonly>
</div>
<div class="col-md-2 detail_biaya">
  <label></label>
  <button type="submit" class="btn btn-sm btn-primary" style="margin-top:10px;">Bayar</button>
</div>


<script>
$(document).ready(function() {
    $('#example').change(function(){
        $('#biaya').val( $(this).find('option:selected').data('info') ); 
    });
});

$(function(){
  $('#uang').on("input",function(){
    var total=$('#biaya').val();
    var jumuang=$('#uang').val();
    var hsl=jumuang.replace(/[^\d]/g,"");
    // $('#jml_uang2').val(hsl);
    if(jumuang > total){
      $('#wrap_kembalian').show();
      $('#kembalian').val(hsl-total);
    }else if(jumuang == total){
      $('#wrap_kembalian').show();
      $('#kembalian').val("uang pas");
      // $('#wrap_kembalian').hide();
    }else{
      $('#wrap_kembalian').show();
      $('#kembalian').val("uang kurang");
    }
  })
});
</script> 

    
					