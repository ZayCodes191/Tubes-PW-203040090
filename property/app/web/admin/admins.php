<?php
    include 'template/headerCMS.php';
    include 'business/services/UserService.php';
    $admins = userGetAll();
    if(isset($_POST['create'])){
        $res = userCreate([
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ]);
        if($res['code']!=201){
            echo "<script>Swal.fire({
                title: 'Failed to create admin',
                text: 'Something bad happen (500)',
                icon: 'error',
                confirmButtonText: 'Ok'
              })</script>";
        }else{
            echo "<script>Swal.fire({
                title: 'Success Create admin',
                icon: 'success',
                confirmButtonText: 'Ok'
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = '?route=admin/admins';
                } else if (result.isDenied) {
                    window.location.href = '?route=admin/admins';
                }
              })
              </script>";
        }
    }
    if(isset($_POST['update'])){
        $res = userUpdate([
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'id' => $_POST['id']
        ]);
        if($res['code']!=200){
            echo "<script>Swal.fire({
                title: 'Failed to update admin',
                text: 'Something bad happen (500)',
                icon: 'error',
                confirmButtonText: 'Ok'
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = '?route=admin/admins';
                } else if (result.isDenied) {
                    window.location.href = '?route=admin/admins';
                }
              })
              </script>";
        }else{
            echo "<script>Swal.fire({
                title: 'admin updated',
                icon: 'success',
                confirmButtonText: 'Ok'
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = '?route=admin/admins';
                } else if (result.isDenied) {
                    window.location.href = '?route=admin/admins';
                }
              })
              </script>";
            //   header('location: ?route=admin/admins');
        }
    }

    if(isset($_POST['delete'])){
        $res = userDelete([
            'id' => $_POST['id']
        ]);
        if($res['code']!=200){
            echo "<script>Swal.fire({
                title: 'Failed to delete admin',
                text: 'Something bad happen (500)',
                icon: 'error',
                confirmButtonText: 'Ok'
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = '?route=admin/admins';
                } else if (result.isDenied) {
                    window.location.href = '?route=admin/admins';
                }
              })
              </script>";
        }else{
            echo "<script>Swal.fire({
                title: 'admin Deleted',
                icon: 'success',
                confirmButtonText: 'Ok'
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = '?route=admin/admins';
                } else if (result.isDenied) {
                    window.location.href = '?route=admin/admins';
                }
              })
              </script>";
            //   header('location: ?route=admin/admins');
        }
    }
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <button class="btn btn-primary btn-lg"  data-toggle="modal" data-target="#createModal">+ Add New Admin</button>
                    <hr/>
                    <!-- Page Heading -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Admin List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach($admins as $admin){?>
                                        <tr>
                                            <td><?=$admin['id']?></td>
                                            <td><?=$admin['email']?></td>
                                            <td><?=$admin['created_at']?></td>
                                            <td><?=$admin['updated_at']?></td>
                                            <td>
                                                <!-- <button class="btn btn-success">Details</button> -->
                                                <button class="btn btn-warning"  data-toggle="modal" data-target="#editModel-<?=$admin['id']?>">Edit</button>
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModel-<?=$admin['id']?>">Delete</button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editModel-<?=$admin['id']?>" tabindex="-1" role="dialog" aria-labelledby="editModelLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModelLabel">Edit Admin</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="">
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="<?=$admin['id']?>">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input class="form-control" type="text" name="email" value="<?=$admin['email']?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Password</label>
                                                    <input class="form-control" type="password" name="password" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button name="update" type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                        <!-- modal delete -->
                                        <div class="modal fade" id="deleteModel-<?=$admin['id']?>" tabindex="-1" role="dialog" aria-labelledby="deleteModelLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModelLabel">Delete Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="">
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="<?=$admin['id']?>">
                                                <p>Yakin mau delete admin <strong><?=$admin['email']?></strong> ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button name="delete" type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Add New Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="text" name="email" value="" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" type="password" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button name="create" type="submit" class="btn btn-primary">Create</button>
                    </div>
                    </form>
                    </div>
                </div>
                </div>
<?php
    include 'template/footerCMS.php';
?>