<?php foreach($kelas as $k):?>
<div id="edit<?=$k->id_kelas?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="myModalLabel">Edit Kelas <?=$k->daftar_kelas?></h3>
      </div>
      <form class="form-horizontal" method="post" action="<?=base_url('admin/kelas/update')?>">
        <div class="modal-body">
          <div class="form-group">
            <label>Kelas</label>
            <input name="id_kelas" type="text" value="<?=$k->id_kelas;?>">
            <input name="daftar_kelas" class="form-control" type="text" value="<?=$k->daftar_kelas;?>" placeholder="Kelas">
          </div>
          <div class="form-group">
            <label>Jurusan</label>
              <select name="id_jurusan" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Jurusan" placeholder="Pilih Jurusan" required>
                <?php foreach($jurusan as $j):?>
                <option value="<?=$j->id_jurusan?>"<?php if($j->id_jurusan == $k->id_jurusan){echo 'selected';}?>><?=$j->nama_jurusan?></option>
                <?php endforeach ?>
              </select>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Tutup</button>
          <button class="btn btn-info" type="submit">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach ?>
<form method="POST" action="<?=base_url('admin/kelas/insert')?>" id="frm_submit">
  <div class="col-md-12" style="padding:0px;">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Jurusan</th>
          <th>Kelas</th>
        </tr>
      </thead>
      <tbody id="table-details">
        <tr id="row1" class="jdr1">
          <td><span class="btn btn-sm btn-default">1</span><input type="hidden" value="6437" name="count[]"></td>
          <td>
            <select name="id_jurusan[]" class="form-control" required>
              <option value="">-- pilih jurusan --</option>
              <?php foreach($jurusan as $j):?>
              <option value="<?=$j->id_jurusan?>"><?=$j->nama_jurusan?></option>
              <?php endforeach ?>
            </select>
          </td>
          <td>
            <input type="hidden" name="id_kelas" id="id_kelas">
            <input type="text" class="form-control" name="daftar_kelas[]" id="daftar_kelas" required><p id="stts"></p>
          </td>     
        </tr>
      </tbody>
    </table>
    <button class="btn btn-primary  btn-add-more"><i class="fa fa-plus"></i></button>
    <button class="btn  btn-warning btn-remove-detail-row"><i class="glyphicon glyphicon-remove"></i></button>
    <button class="btn btn-success" type="submit" value="submit"><i class="fa fa-send"></i></button>
  </div>
</form>
<table id="datatable" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>No</th>
      <th>Jurusan</th>
      <th>Kelas</th>
      <th>Pilihan</th>
    </tr>
  </thead>
  <tbody id="list_kelas">
    <?php $no=1; foreach($kelas as $k):?>
    <tr>
      <td><?=$no++?></td>
      <td><?=$k->nama_jurusan?></td>
      <td><?=$k->daftar_kelas?></td>
      <td>
        <a class="btn btn-info" href="#edit<?=$k->id_kelas?>" data-toggle="modal" title="Edit">
          <span class="fa fa-refresh"></span>
        </a>
        <a class="btn btn-danger" href="<?=base_url('admin/kelas/delete/'.$k->id_kelas)?>" onclick="return confirm('Anda Yakin Akan Menghapus Data Ini ??')">
          <span class="fa fa-remove"></span>
        </a>
      </td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
<script type="text/javascript" charset="utf-8" async defer>
  function hapusData(id_kelas){
    var tanya = confirm('Anda Yakin Akan Mengahpus Data Ini ??');
    if(tanya){
      $.ajax({
        url:"<?=base_url('admin/kelas/delete')?>",
        type:"POST",
        dataType:"JSON",
        data:"id_kelas="+id_kelas,
        success:function(data){
          location.reload();
        }
      });
    }
  }
</script>

<script type="text/javascript" charset="utf-8" async defer>
  $(document).ready(function (){
    $("body").on('click', '.btn-add-more', function (e) {
      e.preventDefault();
      var $sr = ($(".jdr1").length + 1);
      var rowid = Math.random();
      var $html = '<tr class="jdr1" id="' + rowid + '">' +
        '<td><span class="btn btn-sm btn-default">' + $sr + '</span><input type="hidden" name="count[]" value="'+Math.floor((Math.random() * 10000) + 1)+'"></td>' +
        '<td>'+
          '<select name="id_jurusan[]" class="form-control" required>'+
            '<option value="">-- pilih jurusan --</option>'+
            <?php foreach($jurusan as $j):?>
            '<option value="<?=$j->id_jurusan?>"><?=$j->nama_jurusan?></option>'+
            <?php endforeach ?>
          '</select>'+
        '</td>' +
        '<td><input type="text" class="form-control" name="daftar_kelas[]" id="daftar_kelas" required><p id="stts"></p></td>'+
      '</tr>';
      $("#table-details").append($html);
    });
    $("body").on('click', '.btn-remove-detail-row', function (e) {
      e.preventDefault();
      if($("#table-details tr:last-child").attr('id') != 'row1'){
        $("#table-details tr:last-child").remove();
      }
    });

    $("#daftar_kelas").change(function(){
      $('#stts').html("checking ...");    
      var dk  = $("#daftar_kelas").val();
      $.ajax({
        type:"POST",
        url:"<?=base_url('admin/kelas/cek_kelas')?>",    
        data: "daftar_kelas=" + dk,
        success: function(data){
          if($("#daftar_kelas").val() == ""){
            $("#stts").html('kelas Tidak Boleh Kosong <i class="fa fa-info"></i>').css('color','red');
            $('#daftar_kelas').css('border', '1px solid red');
          }
          else if(data==0){
            $("#stts").html('kelas oke <i class="fa fa-check"></i>').css('color','green');
            $('#daftar_kelas').css('border', '1px solid #ccc');
          }
          else{
            $("#stts").html('kelas sudah tersedia <i class="fa fa-remove"></i>').css('color','red');
            $('#daftar_kelas').css('border', '1px solid red');
          }
        }
      });
    })

  });
</script>