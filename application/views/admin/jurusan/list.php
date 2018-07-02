<style type="text/css" media="screen">
  #alert_message{display:none;}
</style>
<div class="x_content">
  <div class="alert alert-success alert-message" id="alert_message"></div>
  <a href="#form" class="btn btn-primary" data-toggle="modal" onclick="submit('tambah')"><i class="fa fa-plus"></i> tambah</a>
  <table id="datatable" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Jurusan</th>
        <th>Pilihan</th>
      </tr>
    </thead>
    <tbody id="list_jurusan"></tbody>
  </table>
  <div class="modal fade" id="form" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="text-center"><?=$title?></h3>
        </div>
        <div class="modal-body">
          <p class="text-center" id="pesan" style="color:red!important;font-weight:600;"></p>
          <div class="form-group">
              <label>Nama Jurusan</label>
              <input type="text" name="nama_jurusan" id="nama_jurusan" class="form-control">
              <input type="hidden" name="id_jurusan" id="id_jurusan" value="">
          </div>
          <div class="form-group">
            <button type="button" class="btn btn-primary" name="btn-tambah" id="btn-tambah" onclick="tambahData()">Tambah</button>
            <button type="button" class="btn btn-primary" name="btn-edit" id="btn-edit" onclick="editData()">Edit</button>
            <button type="reset" data-dismiss="modal" class="btn btn-default" id="btn-batal" onclick="submit('batal')">Batal</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" charset="utf-8" async defer>
  ambilData();
  function ambilData(){
    $.ajax({
      url     : "<?=base_url('admin/jurusan/ambil')?>",
      type    : "POST",
      dataType: "JSON",
      success : function(hasil){
        var wrap  = '';
        var no    = 1;
        var i     = 0;
        for(i=0;i<hasil.length;i++){
          wrap +=
          "<tr>"+
            "<td>"+no+"</td>"+
            "<td>"+hasil[i].nama_jurusan+"</td>"+
            "<td>"+
              "<a href='#form' data-toggle='modal' class='btn btn-info' onClick='submit("+hasil[i].id_jurusan+")'><i class='fa fa-refresh'></i></a>"+
              "<a class='btn btn-danger' onclick='hapusData("+hasil[i].id_jurusan+")'><i class='fa fa-remove'></i></a>"+
            "</td>"+
          "</tr>";
          no++;
        }
        $("#list_jurusan").html(wrap);
      }
    });
  }

  function submit(x){
    if(x == 'tambah'){
      $("#btn-tambah").show();
      $("#btn-edit").hide();
    }else if(x == 'batal'){
      $("#nama_jurusan").val("");
    }else{
      $("#btn-tambah").hide();
      $("#btn-edit").show();

      $.ajax({
        url:'<?=base_url('admin/jurusan/ambilId')?>',
        type:'POST',
        dataType:'JSON',
        data:'id_jurusan='+x,
        success:function(hasil){
          console.log(hasil);
          if(x != 'tambah'){
            $("#id_jurusan").val(hasil.id_jurusan);
            $("#nama_jurusan").val(hasil.nama_jurusan);
          }else if(x == 'tambah'){
            $("#nama_jurusan").val(hasil.nama_jurusan);
          }
        }
      });
    }
  }
  function tambahData(){
    var jur={'nama_jurusan' : $("#nama_jurusan").val()}
    $.ajax({
      url : "<?=base_url('admin/jurusan/tambah')?>",
      type: 'POST',
      dataType : 'JSON',
      data: jur,
      success: function(hasil){
        $("#pesan").html(hasil.pesan);
        if(hasil.pesan == ""){
          $("#form").modal('hide');
          $("#nama_jurusan").val("");
          $("#alert_message").html('<i class="fa fa-check"></i> Data Berhasil Ditambahkan').show().delay('4000').slideUp('slow');
          ambilData();
        }
      }
    });
  }

  function editData(){
    var new_data = {
      "id_jurusan"  : $("#id_jurusan").val(),
      "nama_jurusan": $("#nama_jurusan").val(),
    }
    $.ajax({
      url:"<?=base_url('admin/jurusan/edit')?>",
      type:"POST",
      dataType:"JSON",
      data:new_data,
      success:function(hasil){
        $("#pesan").html(hasil.pesan);
        if(hasil.pesan == ""){
          $("#form").modal('hide');
          $("#id_jurusan").val("");
          $("#nama_jurusan").val("");
          $("#alert_message").html('<i class="fa fa-check"></i> Data Berhasil Diubah').show().delay('4000').slideUp('slow');
          ambilData();
        }
      }
    });
  }
  function hapusData(x){
    var tanya = confirm('Anda Yakin Akan Menghapus Data Ini ??');
    if(tanya){
      $.ajax({
        url:"<?=base_url('admin/jurusan/hapus')?>",
        type:"POST",
        dataType:"JSON",
        data:"id_jurusan="+x,
        success:function(hasil){
          $("#alert_message").html('<i class="fa fa-check"></i> Data Berhasil Dihapus').show().delay('4000').slideUp('slow');
          ambilData();
        }
      });
    }
  }
</script>