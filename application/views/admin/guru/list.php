<div class="x_content">
  <?php 
    if($this->session->flashdata('sukses')){
      echo "<div class='alert alert-success alert-message'> <i class='fa fa-check'></i>  ";
      echo $this->session->flashdata('sukses');
      echo "</div>";
    }
  ?>
  <a href="<?=base_url('admin/guru/tambah')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
  <table id="datatable" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>NIG</th>
        <th>Nama</th>
        <th>Email</th>
        <th>No Handphone</th>
        <th>Tgl Lahir</th>
        <th>Alamat</th>
        <th>Pilihan</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=1; foreach($guru as $g):?>
      <tr>
        <td><?=$no++?></td>
        <td><?=$g->nig?></td>
        <td><?=$g->nama?></td>
        <td><?=$g->email?></td>
        <td><?=$g->no_hp?></td>
        <td><?=date('F d Y',strtotime($g->tgl_lahir))?></td>
        <td><?=$g->alamat?></td>
        <td>
          <a href="<?=base_url('admin/guru/edit/'.$g->id_guru)?>" class="btn btn-info"><i class="fa fa-refresh"></i></a>
          <a href="<?=base_url('admin/guru/delete/'.$g->id_guru)?>" class="btn btn-danger" onclick="return confirm('Anda Yakin Akan Menghapus Data Ini ?')"><i class="fa fa-remove"></i></a>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal<?=$g->id_guru?>"><i class="fa fa-eye"></i></button>
            <!-- Modal -->
            <div id="myModal<?=$g->id_guru?>" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?=$g->nama?></h4>
                  </div>
                  <div class="modal-body">
                    <table class="table table-striped table-bordered">
                      <tr>
                        <img src="<?=base_url('assets/upload/guru/'.$g->photo)?>" alt="" style="width:100%;height:400px;">
                      </tr>
                      <tr>
                        <td>NIG (Nomor Induk Guru)</td>
                        <td><?=$g->nig?></td>
                      </tr>
                      <tr>
                        <td>nama</td>
                        <td><?=$g->nama?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><?=$g->email?></td>
                      </tr>
                      <tr>
                        <td>No Handphone</td>
                        <td><?=$g->no_hp?></td>
                      </tr>
                      <tr>
                        <td>Tanggal Lahir</td>
                        <td><?=date('F d Y',strtotime($g->tgl_lahir))?></td>
                      </tr>
                      <tr>
                        <td>Alamat</td>
                        <td><?=$g->alamat?></td>
                      </tr>
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /modals -->
        </td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
  <script src="<?=base_url('assets/admin/build/js/custom.min.js')?>"></script>
