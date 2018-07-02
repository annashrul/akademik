<div class="container">
  <div class="row jumbotron">
    <form method="POST" action="" id="frm_submit">
      <div class="col-md-12">
        <fieldset><legend>Journey Details</legend>
          <!-- Text input-->
          <table style="width: 100%" class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Guru</th>
                <th>Kelas</th>
                <th>Jurusan</th>
                <th>Pelajaran</th>
                <th>Hari</th>
                <th>Jam</th>
              </tr>
            </thead>
            <tbody id="table-details">
              <tr id="row1" class="jdr1">
                <td><span class="btn btn-sm btn-default">1</span><input type="hidden" value="6437" name="count[]"></td>
                <td>
                  <select name="id_guru[]" class="form-control">
                    <option value="">-- pilih guru --</option>
                    <?php foreach($guru as $g):?>
                    <option value="<?=$g->id_guru?>"><?=$g->nama?></option>
                    <?php endforeach ?>
                  </select>
                </td>
                <td>
                  <select name="id_kelas[]" class="form-control">
                    <option value="">-- pilih kelas --</option>
                    <?php foreach($kelas as $k):?>
                    <option value="<?=$k->id_kelas?>"><?=$k->daftar_kelas?></option>
                    <?php endforeach ?>
                  </select>
                </td>
                <td>
                  <select name="id_jurusan[]" class="form-control">
                    <option value="">-- pilih jurusan --</option>
                    <?php foreach($jurusan as $j):?>
                    <option value="<?=$j->id_jurusan?>"><?=$j->nama_jurusan?></option>
                    <?php endforeach ?>
                  </select>
                </td>
                <td>
                  <select name="id_pelajaran[]" class="form-control">
                    <option value="">-- pilih pelajaran --</option>
                    <?php foreach($pelajaran as $p):?>
                    <option value="<?=$p->id_pelajaran?>"><?=$p->nama_pelajaran?></option>
                    <?php endforeach ?>
                  </select>
                </td>
                <td><input type="text" class="form-control" name="hari[]"></td>     
                <td><input type="text" class="form-control" name="jam[]"></td>     
              </tr>
            </tbody>
          </table>
          <button class="btn btn-primary btn-sm btn-add-more">Add More</button>
          <button class="btn btn-sm btn-warning btn-remove-detail-row"><i class="glyphicon glyphicon-remove"></i></button>
        </fieldset>
      </div>
      <div class="col-md-12">
        <hr>
        <input class="btn btn-success pull-right" type="submit" value="submit">
      </div>
    </form>
  </div>
  <div class="row">
    <div class="alert alert-dismissable alert-success" style="display: none">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>Data inserted successfully</strong>.
    </div>
    <div class="alert alert-dismissable alert-danger"  style="display: none">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>Sorry something went wrong</strong>
    </div>
  </div>
</div>
<!-- <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/material.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script> -->
<script>
  $(document).ready(function (){
    $("body").on('click', '.btn-add-more', function (e) {
      e.preventDefault();
      var $sr = ($(".jdr1").length + 1);
      var rowid = Math.random();
      var $html = '<tr class="jdr1" id="' + rowid + '">' +
        '<td><span class="btn btn-sm btn-default">' + $sr + '</span><input type="hidden" name="count[]" value="'+Math.floor((Math.random() * 10000) + 1)+'"></td>' +
        '<td>'+
          '<select name="id_guru[]" class="form-control">'+
            '<option value="">-- pilih guru --</option>'+
            <?php foreach($guru as $g):?>
            '<option value="<?=$g->id_guru?>"><?=$g->nama?></option>'+
            <?php endforeach ?>
          '</select>'+
        '</td>' +
        '<td>'+
          '<select name="id_kelas[]" class="form-control">'+
            '<option value="">-- pilih kelas --</option>'+
            <?php foreach($kelas as $k):?>
            '<option value="<?=$k->id_kelas?>"><?=$k->daftar_kelas?></option>'+
            <?php endforeach ?>
          '</select>'+
        '</td>' +
        '<td>'+
          '<select name="id_jurusan[]" class="form-control">'+
            '<option value="">-- pilih jurusan --</option>'+
            <?php foreach($jurusan as $j):?>
            '<option value="<?=$j->id_jurusan?>"><?=$j->nama_jurusan?></option>'+
            <?php endforeach ?>
          '</select>'+
        '</td>' +
        '<td>'+
          '<select name="id_pelajaran[]" class="form-control">'+
            '<option value="">-- pilih pelajaran --</option>'+
            <?php foreach($pelajaran as $p):?>
            '<option value="<?=$p->id_pelajaran?>"><?=$p->nama_pelajaran?></option>'+
            <?php endforeach ?>
          '</select>'+
        '</td>' +
        '<td><input type="text" class="form-control" name="hari[]"></td>'+
        '<td><input type="text" class="form-control" name="jam[]"></td>'+
      '</tr>';
      $("#table-details").append($html);
  });
  $("body").on('click', '.btn-remove-detail-row', function (e) {
    e.preventDefault();
    if($("#table-details tr:last-child").attr('id') != 'row1'){
      $("#table-details tr:last-child").remove();
    }
  });

  $("#frm_submit").on('submit', function (e) {
    e.preventDefault();
    $.ajax({
      url: '<?php echo base_url() ?>admin/jadwal/batchInsert',
      type: 'POST',
      data: $("#frm_submit").serialize()
    }).always(function (response){
      var r = (response.trim());
      if(r == 1){
        $(".alert-success").show();
      }
      else{
        $(".alert-danger").show();
      }
    });
  });
});
</script>


