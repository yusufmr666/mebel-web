<div class="card">
                <h5 class="card-header">Table <?=$id?></h5>
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Harga</th>
                          <th>Status</th>
                          <th>Dikerjakan Oleh</th>
                        <th>Detail</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        <?php foreach($query->result() as $row):?>
                          <td>
                            <i class="mdi mdi-bank mdi-20px text-primary me-3"></i
                            ><span class="fw-medium"><?= tgl_indonesia($row->tgl_pesan)?></span>
                          </td>
                          <td><?=$row->id_transaksi?></td>
                          <td> <span class="badge bg-label-success"><?=$row->status?></span></td>
                          <td> <button class="btn btn-outline-info btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                          data-bs-target="#edit<?= $row->id_transaksi?>"
                                  >Detail </button></td>
                           <!--
                          <td>
                           
                            <div class="dropdown">
                              <button
                                type="button"
                                class="btn p-0 dropdown-toggle hide-arrow"
                                data-bs-toggle="dropdown">
                                <i class="mdi mdi-dots-vertical"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                          data-bs-target="#edit<?= $row->id_produk?>"
                                  ><i class="mdi mdi-pencil-outline me-1"></i> Edit</a
                                >
                                <a class="dropdown-item" href="javascript:void(0);"
                                  ><i class="mdi mdi-trash-can-outline me-1"></i> Delete</a
                                >
                              </div>
                            </div>
                          </td>
                          -->
                        </tr>
                        <?php endforeach?>
                      </tbody>
                    </table>
                    <div class="halaman my-5"><?php echo $halaman;?></div>
                  </div>
                  <?php foreach($query->result() as $row):?>
                        <div class="modal fade" id="edit<?= $row->id_transaksi?>" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel1">Detail Order</h4>
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
                                  <?php foreach($this->mebel_model->get_charts($row->id_transaksi)->result() as $row):?>
                                    <td>
                                      <i class="mdi mdi-bank mdi-20px text-primary me-3"></i
                                      ><span class="fw-medium"><?= $row->nama?></span>
                                    </td>
                                    <td><?=$row->harga?></td>
                                    <td> <span class="badge bg-label-success"><?=$row->status?></span></td>
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

              <?php
              	function tgl_indonesia($date){
                  $Bulan = array("Januari","Februari","Maret","April",
                          "Mei","Juni","Juli","Agustus","September",
                          "Oktober","November","Desember");
                  $Hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
                  $tahun = substr($date, 0, 4);
                  $bulan = substr($date, 5, 2);
                  $tgl = substr($date, 8, 2);
                  $hari = date("w", strtotime($date));
                  return $result = $Hari[$hari].", ".$tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." ";
                }
              ?>