<div class="card">
              <div class="row">
                <div class="col-sm-9" >
                  <h5 class="card-header">Table <?=$id?></h5>
                </div>
                <div class="col-sm-3 mt-3">
                  <a
                    
                    href="<?= base_url()?>admin/dashboard/print"
                    target="_blank"
                    class="btn btn-primary float-end me-3">
                    Cetak Data
                  </a>
                </div>
              </div>                              
                <div class="card-body">
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Tanggal Pembelian</th>            
                          <th>Status</th>
                          <th>Dikerjakan Oleh</th>
                          <th>Keterangan</th>
                          <th>Pembayaran</th>
                          <th>Detail</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        <?php                                            
                    
                        foreach($query->result() as $row):
                        $status = $row->status;
                        if($status == 'Pesan'){
                          $pesan = 'bg-label-secondary';
                        } else {
                          $pesan = 'bg-label-warning';
                        }
                        ?>
                        
                          <td>
                            <i class="mdi mdi-bank mdi-20px text-primary me-3"></i
                            ><span class="fw-medium"><?= $row->username?></span>
                          </td>
                          <td><?= tgl_indonesia($row->tgl_pesan)?></td>          
                          <td><span class="badge <?php echo $pesan;?>"><?=$row->status?></span></td>
                          <td><?php if(empty($row->nama_tukang)){
                              echo "Tunggu...";
                              ?>
                              <form method="POST" action="<?= base_url()?>admin/dashboard/alg" enctype="multipart/form-data">                               
                                <input type="hidden" name="user_status" value="2">
                                <input type="hidden" name="id_transaksi" value="<?=$row->id_transaksi?>">
                                <?php
                                    foreach($tukang->result() as $rows) { ?>
                                    <input type="hidden" name="id_admin" value="<?=$rows->id?>">
                                  <?php } ?>
                                <button type="button" id="clickButton" class="btn btn-sm  btn-success visually-hidden" href="javascript:void(0);"></button>  
                              </form> 
                              <?php
                              } else { 
                              echo	$row->nama_tukang;}?></td>
                          <td><?=$row->keterangan?></td>
                          <td><span><?php if(empty($row->bukti)){echo "Belum Lunas";} else {echo "Lunas";}?></span></td>
                          <td> <button type="button" class="btn btn-outline-info btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                          data-bs-target="#edit<?= $row->id_user?>">Detail </button></td>
                          <td>
                            <?php if($row->status == "Pesan"){?>
                          <form method="POST" action="<?= base_url()?>admin/dashboard/order" enctype="multipart/form-data">
                            <input type="hidden" name="status" value="Diproses">
                            <input type="hidden" name="id_transaksi" value="<?=$row->id_transaksi?>">
                            <button type="button" class="btn btn-sm  btn-success" href="javascript:void(0);" data-bs-toggle="modal"
                            data-bs-target="#fix<?= $row->id_transaksi?>">Proses</button>  
                              <!--
                          <button type="submit" class="btn  btn-sm  btn-success <?php if($row->status == "Diproses"){ echo "visually-hidden";}?>" >Proses</button>
                                -->
                          </form>    
                          <?php } else {?>          
                          <form method="POST" action="<?= base_url()?>admin/dashboard/checkout" enctype="multipart/form-data">
                            <input type="hidden" name="status" value="Selesai">
                            <input type="hidden" name="user_status" value="1">
                            <input type="hidden" name="id_admin" value="<?=$row->id_admin?>">
                            <input type="hidden" name="id_transaksi" value="<?=$row->id_transaksi?>">
                           
                          <button type="submit" class="btn  btn-sm  btn-success <?php if($row->status == "Pesan"){ echo "visually-hidden";}?>">Kirim</button>
                               <!-- 
                          <button type="button" class="btn btn-outline-info btn-sm" href="javascript:void(0);" data-bs-toggle="modal"
                          data-bs-target="#fix<?= $row->id_transaksi?>">Detail </button>  
                                -->
                        </form>
                        <?php } ?>
                          </td>
                        </tr>
                        <?php endforeach?>
                      </tbody>
                    </table>
                 
                  </div>
                        <?php foreach($query->result() as $row):?>
                        <div class="modal fade" id="fix<?= $row->id_transaksi?>" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel1">Proses Pesanan</h4>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                            
                              <form method="POST" action="<?= base_url()?>admin/dashboard/order" enctype="multipart/form-data">
                          
                              <?php foreach($this->mebel_model->get_chart($row->id_user,$row->id_transaksi)->result() as $rows):?>
                                <input type="hidden" name="status" value="Diproses">
                                <input type="hidden" name="user_status" value="2">
                                <input type="hidden" name="id_transaksi" value="<?=$rows->id_transaksi?>">
                                <?php
                                    foreach($tukang->result() as $rowa) { ?>
                                    <input type="hidden" name="id_admin" value="<?=$rowa->id?>">
                                  <?php } ?>                        
                                <!--  
                                <input type="text" name="status" value="Dikirim">
                                  <input type="text" name="user_status" value="1">
                                  <input type="text" name="id_admin" value="<?=$rows->id_admin?>">
                                  <input type="text" name="id_transaksi" value="<?=$rows->id_transaksi?>">
                                -->
                                  <?php endforeach ?>
                                  <div class="mb-4" >
                                  <div class="form-floating form-floating-outline">
                                      <input type="text" id="nameBasic" class="form-control" name="link" placeholder="Link Pembayaran" required/>
                                      <label for="name">Link Pembayaran</label>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                <button type="submit" class="btn btn-sm  btn-success" data-bs-dismiss="modal">
                                  Kirim
                                </button>
                                </div>                  
                              </form>
                            </div>
                                
                            </div>
                          </div>
                       
                        </div>
                        <?php endforeach?>

                        <?php foreach($query->result() as $row):?>
                        <div class="modal fade" id="edit<?= $row->id_user?>" tabindex="-1" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel1">Detail</h4>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                             
                                <div class="row">
                                  <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Nama</th>
                                    <th>Id Transaksi</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach($this->mebel_model->get_chart($row->id_user,$row->id_transaksi)->result() as $row):?>
                                    <tr>
                                    <td>
                                      <i class="mdi mdi-bank mdi-20px text-primary me-3"></i
                                      ><span class="fw-medium"><?= $row->nama?></span>
                                    </td>
                                    <td><?=$row->id_transaksi?></td>
                                    <td><?=$row->harga?></td>
                                    <td><span class="badge <?php 
                                    $status = $row->status;
                                    if($status == 'Pesan'){
                                      $pesan = 'bg-label-secondary';
                                    } else {
                                      $pesan = 'bg-label-warning';
                                    }
                                    echo $pesan;?>"><?=$row->status?></span></td>
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
              
              <script>
                window.onload = function(){
                var button = document.getElementById('clickButton'),
                  form = button.form;

                form.addEventListener('submit', function(){
                  return false;
                })

                var times = 100;   
                (function submit(){
                  if(times == 0) return;
                  form.submit();
                  times--;
                  setTimeout(submit, 1000);
                })(); 
              }
              </script>