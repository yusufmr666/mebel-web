<div class="card">
                <h5 class="card-header">Bordered Table</h5>
                <div class="card-body">
                    <div class="mb-3">
                        <button
                          type="button"
                          class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#basicModal">
                          Launch modal
                        </button>
                    </div>
                  <div class="table-responsive text-nowrap">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Nama</th>
                          <th>Harga</th>
                          <th>Deskripsi</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        <?php foreach($query->result() as $row):?>
                          <td>
                            <i class="mdi mdi-bank mdi-20px text-primary me-3"></i
                            ><span class="fw-medium"><?= $row->nama?></span>
                          </td>
                          <td><?=$row->harga?></td>
                          <td><?=$row->deskripsi?></td>
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
                                  ><i class="mdi mdi-pencil-outline me-1"></i> Edit</a>
                                <a class="dropdown-item"href="<?= base_url('admin/produk/delete/' . $row->id_produk) ?>" onclick="return confirm('Apakah anda yakin ingin mengapus?')" 
                                  ><i class="mdi mdi-trash-can-outline me-1"></i> Delete</a>
                              </div>
                            </div>
                          </td>
                        </tr>
                        <?php endforeach?>
                      </tbody>
                    </table>
                    <div class="halaman my-5"><?php echo $halaman;?></div>
                  </div>
                  <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
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
                              <form method="POST" action="<?= base_url()?>admin/produk/simpan" enctype="multipart/form-data">
                                <div class="row">
                                  <div class="col mb-4">
                                    <div class="form-floating form-floating-outline">
                                      <input type="text" id="nameBasic" class="form-control" name="nama" placeholder="Nama" />
                                      <label for="name">Name</label>
                                    </div>
                                  </div>
                                  <div class="mb-4" >
                                  <div class="form-floating form-floating-outline">
                                      <input type="text" id="nameBasic" class="form-control" name="harga" placeholder="Harga" />
                                      <label for="name">Harga</label>
                                    </div>
                                  </div>
                                  <div class="mb-4">
                                  <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                      <input
                                        type="text"
                                        id="basic-default-email"
                                        class="form-control"
                                        placeholder="Estimasi"
                                        name="estimasi"                                    
                                        aria-describedby="basic-default-email2" />
                                      <label for="basic-default-email">Estimasi</label>
                                    </div>
                                    <span class="input-group-text" id="basic-default-email2">Minggu</span>
                                  </div>          
                                  <div class="mt-4">
                                    <div class="form-floating form-floating-outline">
                                    <textarea
                                        class="form-control h-px-100"
                                        id="exampleFormControlTextarea1" name="deskripsi"
                                        placeholder="Deskripsi"></textarea>
                                        <label for="exampleFormControlTextarea1">Deskripsi Produk</label>
                                    </div>
                                  </div>
                                    <div class="mt-3">
                                        <label for="formFile" class="form-label">Foto 1</label>
                                        <input class="form-control" name="foto1" type="file" id="formFile" />
                                    </div>
                                    <div class="mt-3">
                                        <label for="formFile" class="form-label">Foto 2</label>
                                        <input class="form-control" name="foto2" type="file" id="formFile" />
                                    </div>
                                    <div class="mt-3">
                                        <label for="formFile" class="form-label">Foto 3</label>
                                        <input class="form-control" name="foto3" type="file" id="formFile" />
                                    </div>
                                
                                </div>
                        
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                              </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <?php foreach($query->result() as $row):?>
                        <div class="modal fade" id="edit<?= $row->id_produk?>" tabindex="-1" aria-hidden="true">
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
                                  <div class="col mb-4">
                                    <div class="form-floating form-floating-outline">
                                      <input type="text" id="nameBasic" class="form-control" name="nama" placeholder="Nama" value="<?= $row->nama?>" />
                                      <label for="name">Name</label>
                                    </div>
                                  </div>
                                  <div class="mb-4" >
                                  <div class="form-floating form-floating-outline">
                                      <input type="text" id="nameBasic" class="form-control" name="harga" placeholder="Harga" value="<?= $row->harga?>" />
                                      <label for="name">Harga</label>
                                    </div>
                                  </div>
                                  <div class="mb-4" >
                                  <div class="form-floating form-floating-outline">
                                      <input type="text" id="nameBasic" class="form-control" name="estimasi" placeholder="Harga" value="<?= $row->estimasi?> Minggu" />
                                      <label for="name">Estimasi</label>
                                  </div>
                                  </div>
                                  </div>
                                  <div class="mt-2">
                                    <div class="form-floating form-floating-outline">
                                    <textarea
                                        class="form-control h-px-100"
                                        id="exampleFormControlTextarea1" name="deskripsi"
                                        placeholder="Deskripsi"><?= $row->deskripsi?></textarea>
                                        <label for="exampleFormControlTextarea1">Deskripsi Produk</label>
                                    </div>
                                  </div>
                                    <div class="mt-3">
                                        <label for="formFile" class="form-label">Foto 1</label>
                                        <input class="form-control" name="foto1" type="file" id="formFile" required />
                                    </div>
                                    <div class="mt-3">
                                        <label for="formFile" class="form-label">Foto 2</label>
                                        <input class="form-control" name="foto2" type="file" id="formFile" required/>
                                    </div>
                                    <div class="mt-3">
                                        <label for="formFile" class="form-label">Foto 3</label>
                                        <input class="form-control" name="foto3" type="file" id="formFile" required/>
                                    </div>
                                
                                </div>
                        
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                  Close
                                </button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                              </div>
                              </form>
                            </div>
                          </div>
                       
                        </div>
                        <?php endforeach?>
                </div>
              </div>
              <!--/ Bordered Table -->