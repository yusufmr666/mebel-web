<div class="card">
                <h5 class="card-header">Bordered Table</h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>ID Transaksi</th>
                          <th>Status</th>
                          <th>Detail</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        <?php
                         foreach($user_id as $row) { 
                          $id_user = $row->user_status;
                         }
                         if($id_user == 1){
                          $datas = $query;
                         } else {
                          $datas = $wait;
                         }
                       
                        foreach($datas->result() as $row):
                        $status = $row->status;
                        ?>
                        
                          <td>
                            <i class="mdi mdi-bank mdi-20px text-primary me-3"></i
                            ><span class="fw-medium"><?= $row->username?></span>
                          </td>
                          <td><?=$row->id_transaksi?></td>
                          <td><?=$status?></td>
                          <td> <button class="btn btn-outline-info btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                          data-bs-target="#edit<?= $row->id_user?>"
                                  >Detail </button></td>
                          <td>
                          <form method="POST" action="<?= base_url()?>admin/dashboard/order" enctype="multipart/form-data">
                            <input type="hidden" name="status" value="Diproses">
                            <input type="hidden" name="user_status" value="2">
                            <input type="hidden" name="id_transaksi" value="<?=$row->id_transaksi?>">
                          <button type="submit" class="btn  btn-sm  btn-success <?php if($status == "Diproses"){ echo "visually-hidden";}?>" >Proses</button>
                          </form>
                          <form method="POST" action="<?= base_url()?>admin/dashboard/order" enctype="multipart/form-data">
                            <input type="hidden" name="status" value="Selesai">
                            <input type="hidden" name="user_status" value="1">
                            <input type="hidden" name="id_transaksi" value="<?=$row->id_transaksi?>">
                          <button type="submit" class="btn  btn-sm  btn-success <?php if($status == "Pesan"){ echo "visually-hidden";}?>">Selesai</button>
                          <form>
                          </td>
                        </tr>
                        <?php endforeach?>
                      </tbody>
                    </table>
                  </div>
                        <?php foreach($datas->result() as $row):?>
                        <div class="modal fade" id="edit<?= $row->id_user?>" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel1">Modal title</h4>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                              <form method="POST" action="<?= base_url()?>admin/produk/edit" enctype="multipart/form-data">
                                <div class="row">
                                  <input type="hidden" name="id" value="<?=$row->id_produk?>"/>
                                  <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                  <?php foreach($this->mebel_model->get_chart($row->id_user,$status)->result() as $row):?>
                                    <td>
                                      <i class="mdi mdi-bank mdi-20px text-primary me-3"></i
                                      ><span class="fw-medium"><?= $row->nama?></span>
                                    </td>
                                    <td><?=$row->harga?></td>
                                    <td><?=$row->status?></td>
                                  </tr>
                                  <?php endforeach?>
                                </tbody>
                              </table>
                                </div>
                        
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                              </div>
                              </form>
                            </div>
                          </div>
                       
                        </div>
                        <?php endforeach?>
                </div>
              </div>
              <!--/ Bordered Table -->
