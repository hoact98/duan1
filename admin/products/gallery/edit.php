<?php
$id = $_GET['id'];
$gall = gallery_list_one($id);
$products = product_list_all();
if (isset($_POST['btnUpdate'])) {
    extract($_REQUEST);
    $okUpload = false;
    if(checkType($_FILES['images']['name'],array('jpg','png','gif','tiff')) && checkSize($_FILES['images']['size'],0,5*1024*1024)){
        $okUpload = true;
        $images = uniqid() . $_FILES['images']['name'];
    }else{
        $images =$image;
    }
    if(checkType($_FILES['images']['name'], array('jpg', 'png', 'gif', 'tiff'))==false && $_FILES['images']['size']>0){
        $errors['errors_img'] = 'File không đúng định dạng';
    }
    if(array_filter($errors)==false){
        gallery_update($id, $id_product, $images,$title);
    if($okUpload){
        move_uploaded_file($_FILES['images']['tmp_name'], '../images/products/'.$images);
    }
    $_SESSION['message']= 'Cập nhật dữ liệu thành công';
    header('Location:'. ROOT . 'admin/?page=products');
    die();
    }
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sửa ảnh sản phẩm </h6>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="form-group">
                            <!--Load products -->
                            <label for="id_product">Chọn sản phẩm</label>
                            <input list="products" name="id_product" id="id_product" class="form-control" value="<?= ($pro['id'] == $product['id_product'])?$pro['id']:'' ?>">
                            <datalist id="browsers">
                                <?php foreach ($products as $pro) : ?>
                                    <?php if ($pro['id'] == $product['id_product']) : ?>
                                        <option value="<?= $pro['id'] ?>" selected></option>
                                    <?php else : ?>
                                        <option value="<?= $pro['id'] ?>"></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </datalist>
                        </div>
                <div class="form-group">
                    <label for="name">Tên ảnh</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nhập tên ảnh" value="<?=isset($name)?$name:$gall['name']?>">
                </div>
                <?php if ($gall['images'] != '') : ?>
                    <img src="../images/categories/<?= $gall['images'] ?>" width="120" alt="">
                    <input type="hidden" name="image" value="<?= $gall['images'] ?>">
                <?php endif; ?>

                <div class="form-group">
                    <input type="file" name="images" class="form-file-input border" id="">
                    <?php if (isset($errors['errors_img'])) : ?>
                                <p class="text-danger mt-2"><?= $errors['errors_img'] ?></p>
                            <?php endif; ?>
                </div>
                <input type="hidden" name="id" value="<?= $gall['id'] ?>">
                <button type="submit" name="btnUpdate" class="btn btn-primary">Ghi lại</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->