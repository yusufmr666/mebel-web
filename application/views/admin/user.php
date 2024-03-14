<div class="card">
                <h5 class="card-header">Bordered <?=$id?></h5>
                <div class="card-body">
                    <div class="mb-3">
                        <button
                          type="button"
                          class="btn btn-primary"
                          data-bs-toggle="modal"
                          data-bs-target="#basicModal">
                          Tambah User
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
                            ><span class="fw-medium"><?= $row->username?></span>
                          </td>
                          <td><?=$row->email?></td>
                          <td><?=$row->level?></td>
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
                          data-bs-target="#edit<?= $row->id?>"
                                  ><i class="mdi mdi-pencil-outline me-1"></i> Edit</a
                                >
                                <a class="dropdown-item" href="<?= base_url('admin/user/delete/' . $row->id) ?>" onclick="return confirm('Apakah anda yakin ingin mengapus?')" 
                                  ><i class="mdi mdi-trash-can-outline me-1"></i> Delete</a
                                >
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
                              <form method="POST" action="<?= base_url()?>admin/user/simpan" enctype="multipart/form-data">
                                <div class="row">
                                <div class="col mb-4">
                                  <div class="form-floating form-floating-outline mb-3">
                                    <input
                                      type="text"
                                      class="form-control"
                                      id="username"
                                      name="username"
                                      placeholder="Enter your username"
                                      autofocus />
                                    <label for="username">Username</label>
                                  </div>
                                  </div>
                                  <div class="mb-4">
                                  <div class="form-floating form-floating-outline mb-3">
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
                                    <label for="email">Email</label>
                                  </div>
                                  </div>
                                  <div class="mb-4">
                                  <div class="mb-3 form-password-toggle">
                                    <div class="input-group input-group-merge">
                                      <div class="form-floating form-floating-outline">
                                        <input
                                          type="password"
                                          id="password"
                                          class="form-control"
                                          name="password"
                                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                          aria-describedby="password" />
                                        <label for="password">Password</label>
                                      </div>
                                      <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                                    </div>
                                  </div>
                                  </div>
                                  <input type="hidden" name="level" value="admin">                              
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
                        <div class="modal fade" id="edit<?= $row->id?>" tabindex="-1" aria-hidden="true">
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
                              <form method="POST" action="<?= base_url()?>admin/user/edit" enctype="multipart/form-data">
                                <div class="row">
                                  <input type="hidden" name="id" value="<?=$row->id?>"/>
                                  <div class="col mb-4">
                                    <div class="form-floating form-floating-outline">
                                      <input type="text" id="nameBasic" class="form-control" name="username" placeholder="Username" value="<?= $row->username?>" />
                                      <label for="name">Name</label>
                                    </div>
                                  </div>
                                  <div class="mb-4">
                                  <div class="mb-3 form-password-toggle">
                                    <div class="input-group input-group-merge">
                                      <div class="form-floating form-floating-outline">
                                        <input
                                          type="password"
                                          id="password"
                                          class="form-control"
                                          name="password"
                                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                          aria-describedby="password" required />
                                        <label for="password">Password</label>
                                      </div>
                                      <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                                    </div>
                                    </div>
                                    <div class="mt-4">
                                    <div class="form-floating form-floating-outline">
                                      <input type="text" id="nameBasic" class="form-control" name="email" placeholder="Email" value="<?= $row->email?>" />
                                      <label for="name">Email</label>
                                    </div>
                                  </div>
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

            