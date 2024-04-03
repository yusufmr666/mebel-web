<div class="card">
                <h5 class="card-header">Table <?=$id?></h5>
                <div class="card-body">
                    </div>
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th width="65%">Nama</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        <?php foreach($query->result() as $row):?>
                          <td>
                            <?php 
                            $jmlchat = $this->db->query("SELECT * FROM faqone WHERE id_user='$row->id_user' and id_status='2' and id_faq='$row->id_faq'")->num_rows();
                            ?>
                            <i class="mdi mdi-bank mdi-20px text-primary me-3"></i
                            ><span class="fw-medium"><?= $row->username?></span> <span class="badge badge-center rounded-pill bg-danger"><?=$jmlchat?></span>
                          </td>
                          <!--
                          <td><?=$row->harga?></td>
                          <td><?=$row->deskripsi?></td>
                        -->
                          <td>
                            <a class="btn btn-outline-info btn-sm" href="<?= base_url('admin/chat/detail/' . $row->id_faq) ?>">
                            Detail</a>                          
                          </td>
                        </tr>
                        <?php endforeach?>
                      </tbody>
                    </table>
                    <div class="halaman my-5"><?php echo $halaman;?></div>
                  </div>
                        
                </div>
              </div>
              <!--/ Bordered Table -->