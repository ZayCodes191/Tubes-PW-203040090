<?php
    include 'template/headerCMS.php';
    include 'business/services/CategoryService.php';
    $categories = categoryGetAll();
    if(isset($_POST['create'])){
        $res = categoryCreate([
            'name' => $_POST['name']
        ]);
        if($res['code']!=201){
            echo "<script>Swal.fire({
                title: 'Failed to create category',
                text: 'Something bad happen (500)',
                icon: 'error',
                confirmButtonText: 'Ok'
              })</script>";
        }else{
            echo "<script>Swal.fire({
                title: 'Success Create Category',
                icon: 'success',
                confirmButtonText: 'Ok'
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = '?route=admin/items/categories';
                } else if (result.isDenied) {
                    window.location.href = '?route=admin/items/categories';
                }
              })
              </script>";
        }
    }
    if(isset($_POST['update'])){
        $res = categoryUpdate([
            'id' => $_POST['id'],
            'name' => $_POST['name']
        ]);
        if($res['code']!=200){
            echo "<script>Swal.fire({
                title: 'Failed to update category',
                text: 'Something bad happen (500)',
                icon: 'error',
                confirmButtonText: 'Ok'
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = '?route=admin/items/categories';
                } else if (result.isDenied) {
                    window.location.href = '?route=admin/items/categories';
                }
              })
              </script>";
        }else{
            echo "<script>Swal.fire({
                title: 'Category updated',
                icon: 'success',
                confirmButtonText: 'Ok'
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = '?route=admin/items/categories';
                } else if (result.isDenied) {
                    window.location.href = '?route=admin/items/categories';
                }
              })
              </script>";
            //   header('location: ?route=admin/items/categories');
        }
    }

    if(isset($_POST['delete'])){
        $res = categoryDelete([
            'id' => $_POST['id']
        ]);
        if($res['code']!=200){
            echo "<script>Swal.fire({
                title: 'Failed to delete category',
                text: 'Something bad happen (500)',
                icon: 'error',
                confirmButtonText: 'Ok'
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = '?route=admin/items/categories';
                } else if (result.isDenied) {
                    window.location.href = '?route=admin/items/categories';
                }
              })
              </script>";
        }else{
            echo "<script>Swal.fire({
                title: 'Category Deleted',
                icon: 'success',
                confirmButtonText: 'Ok'
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = '?route=admin/items/categories';
                } else if (result.isDenied) {
                    window.location.href = '?route=admin/items/categories';
                }
              })
              </script>";
            //   header('location: ?route=admin/items/categories');
        }
    }
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <button class="btn btn-primary btn-lg"  data-toggle="modal" data-target="#createModal">+ Add New Category</button>
                    <hr/>
                    <!-- Page Heading -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach($categories as $category){?>
                                        <tr>
                                            <td><?=$category['id']?></td>
                                            <td><?=$category['name']?></td>
                                            <td><?=$category['slug']?></td>
                                            <td><?=$category['created_at']?></td>
                                            <td><?=$category['updated_at']?></td>
                                            <td>
                                                <!-- <button class="btn btn-success">Details</button> -->
                                                <button class="btn btn-warning"  data-toggle="modal" data-target="#editModel-<?=$category['id']?>">Edit</button>
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModel-<?=$category['id']?>">Delete</button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editModel-<?=$category['id']?>" tabindex="-1" role="dialog" aria-labelledby="editModelLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModelLabel">Edit Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Name Category</label>
                                                    <input type="hidden" name="id" value="<?=$category['id']?>">
                                                    <input class="form-control" type="text" name="name" value="<?=$category['name']?>" required>
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
                                        <div class="modal fade" id="deleteModel-<?=$category['id']?>" tabindex="-1" role="dialog" aria-labelledby="deleteModelLabel" aria-hidden="true">
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
                                                <input type="hidden" name="id" value="<?=$category['id']?>">
                                                <p>Yakin mau delete category <strong><?=$category['name']?></strong> ?</p>
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
                        <h5 class="modal-title" id="createModalLabel">Add New Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name Category</label>
                            <input class="form-control" type="text" name="name" required>
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