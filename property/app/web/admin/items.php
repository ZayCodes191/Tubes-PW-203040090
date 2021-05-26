<?php
    include 'template/headerCMS.php';
    include 'business/services/PropertyService.php';
    include 'business/services/CategoryService.php';
    include 'business/services/UserService.php';

    $properties = propertyGetAll();
    $categories = categoryGetAll();

    if(isset($_POST['create'])){
        $res = propertyCreate([
            'image' => $_FILES['image'],
            'price' => $_POST['price'],
            'description' => $_POST['description'],
            'owner_name' => $_POST['owner_name'],
            'owner_contact' => $_POST['owner_contact'],
            'category_id' => $_POST['category_id'],
            'title' => $_POST['title']
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
                title: 'Success Create Property',
                icon: 'success',
                confirmButtonText: 'Ok'
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = '?route=admin/items';
                } else if (result.isDenied) {
                    window.location.href = '?route=admin/items';
                }
              })
              </script>";
        }
    }
    if(isset($_POST['update'])){
        $res = propertyUpdate([
            'id' => $_POST['id'],
            'image' => $_FILES['image'] ?? null,
            'price' => $_POST['price'],
            'description' => $_POST['description'],
            'owner_name' => $_POST['owner_name'],
            'owner_contact' => $_POST['owner_contact'],
            'category_id' => $_POST['category_id'],
            'title' => $_POST['title']
        ]);
        if($res['code']!=200){
            echo "<script>Swal.fire({
                title: 'Failed to update Property',
                text: 'Something bad happen (500)',
                icon: 'error',
                confirmButtonText: 'Ok'
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = '?route=admin/items';
                } else if (result.isDenied) {
                    window.location.href = '?route=admin/items';
                }
              })
              </script>";
        }else{
            echo "<script>Swal.fire({
                title: 'Property updated',
                icon: 'success',
                confirmButtonText: 'Ok'
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = '?route=admin/items';
                } else if (result.isDenied) {
                    window.location.href = '?route=admin/items';
                }
              })
              </script>";
            //   header('location: ?route=admin/items');
        }
    }

    if(isset($_POST['delete'])){
        $res = propertyDelete([
            'id' => $_POST['id']
        ]);
        if($res['code']!=200){
            echo "<script>Swal.fire({
                title: 'Failed to delete Property',
                text: 'Something bad happen (500)',
                icon: 'error',
                confirmButtonText: 'Ok'
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = '?route=admin/items';
                } else if (result.isDenied) {
                    window.location.href = '?route=admin/items';
                }
              })
              </script>";
        }else{
            echo "<script>Swal.fire({
                title: 'Property Deleted',
                icon: 'success',
                confirmButtonText: 'Ok'
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = '?route=admin/items';
                } else if (result.isDenied) {
                    window.location.href = '?route=admin/items';
                }
              })
              </script>";
            //   header('location: ?route=admin/items');
        }
    }
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <button class="btn btn-primary btn-lg"  data-toggle="modal" data-target="#createModal">+ Add New Property</button>
                    <hr/>
                    <!-- Page Heading -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Property List</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Owner Name</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Category</th>
                                            <th>Owner Name</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach($properties as $property){?>
                                        <tr>
                                            <td> <?=$property['id']?> </td>
                                            <td><?=$property['title']?></td>
                                            <td> <img src="<?=$property['image']?>" width="50px"></td>
                                            <td><?=categoryGetOneByID($property['category_id'])['name']?></td>
                                            <td><?=$property['owner_name']?></td>
                                            <td><?=$property['created_at']?></td>
                                            <td>
                                                <?=$property['updated_at']?>
                                            </td>
                                            <td>
                                                <!-- <button class="btn btn-success">Details</button> -->
                                                <button class="btn btn-success"  data-toggle="modal" data-target="#detailModel-<?=$property['id']?>">Details</button>
                                                <button class="btn btn-warning"  data-toggle="modal" data-target="#editModel-<?=$property['id']?>">Edit</button>
                                                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModel-<?=$property['id']?>">Delete</button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="editModel-<?=$property['id']?>" tabindex="-1" role="dialog" aria-labelledby="editModelLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModelLabel">Edit Property</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="<?=$property['id']?>">
                                                <div class="form-group">
                                                    <label>Image (Let it empty if you won't change the image)</label>
                                                    <input class="form-control" type="file" name="image">
                                                </div>
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input class="form-control" type="text" name="title" value="<?=$property['title']?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Price (Rp.)</label>
                                                    <input class="form-control" type="text" name="price" value="<?=$property['price']?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea class="form-control" type="text" name="description" required><?=$property['description']?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Owner Name</label>
                                                    <input class="form-control" type="text" name="owner_name" value="<?=$property['owner_name']?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Owner Contact</label>
                                                    <input class="form-control" type="text" name="owner_contact" value="<?=$property['owner_contact']?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Category</label>
                                                    <select class="form-control" type="text" name="category_id" required>
                                                    <?php foreach($categories as $category){ ?>
                                                        <option value="<?=$category['id']?>" <?php if($property['category_id'] == $category['id']) echo 'selected';?> > <?=$category['name']?></option>
                                                    <?php } ?>
                                                    </select>
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
                                        <div class="modal fade" id="deleteModel-<?=$property['id']?>" tabindex="-1" role="dialog" aria-labelledby="deleteModelLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModelLabel">Delete Property</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="">
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="<?=$property['id']?>">
                                                <p>Yakin mau delete property dengan ID <strong><?=$property['id']?></strong> ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button name="delete" type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>

                                        <!-- modal details -->
                                        <div class="modal fade" id="detailModel-<?=$property['id']?>" tabindex="-1" role="dialog" aria-labelledby="detailModelLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModelLabel">Details Property</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            
                                            <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <img class="img-thumbnail" src="<?=$property['image']?>">
                                                    
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Title</label>
                                                        <input class="form-control" type="text" name="title" value="<?=$property['title']?>" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Price</label>
                                                        <input class="form-control" type="text" name="price" value="Rp. <?=$property['price']?>" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea class="form-control" type="text" name="description" disabled><?=$property['description']?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Owner Name</label>
                                                        <input class="form-control" type="text" name="owner_name" value="<?=$property['owner_name']?>" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Owner Contact</label>
                                                        <input class="form-control" type="text" name="owner_contact" value="<?=$property['owner_contact']?>" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Category</label>
                                                        <input value="<?=categoryGetOneByID($property['category_id'])['name']?>" class="form-control" type="text" name="category_id" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Created At</label>
                                                        <input value="<?=$property['created_at']?>" class="form-control" type="text" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Updated At</label>
                                                        <input value="<?=$property['updated_at']?>" class="form-control" type="text" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Created By</label>                                                        
                                                        <input class="form-control" type="text" value="<?=userGetOneByID($property['user_id'])['email']?>"  disabled>
                                                    </div>
                                                </div>
                                            </div>
                                                
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
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
                        <h5 class="modal-title" id="createModalLabel">Add New Property</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" type="text" name="title" required>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input class="form-control" type="file" name="image" required>
                        </div>
                        <div class="form-group">
                            <label>Price (Rp.)</label>
                            <input class="form-control" type="text" name="price" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" type="text" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Owner Name</label>
                            <input class="form-control" type="text" name="owner_name" required>
                        </div>
                        <div class="form-group">
                            <label>Owner Contact</label>
                            <input class="form-control" type="text" name="owner_contact" required>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" type="text" name="category_id" required>
                            <?php foreach($categories as $category){ ?>
                                <option value="<?=$category['id']?>"> <?=$category['name']?></option>
                            <?php } ?>
                            </select>
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