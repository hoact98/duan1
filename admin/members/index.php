<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    member_delete($id);
    $_SESSION['message'] = "Xóa dữ liệu thành công";
    header('location:' . ROOT . 'admin/?page=member');
    die;
}
if (isset($_POST['btn-del'])) {
    extract($_REQUEST);
    foreach ($id as $id_member) {
        member_delete($id_member);
    }
    $_SESSION['message'] = "Xóa dữ liệu thành công";
    header('location:' . ROOT . 'admin/?page=member');
    die;
}
$member =  member_list();
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-success alert-bold">
            <h6 class="font-weight-bold alert-text"><?= $_SESSION['message'] ?></h6>
        </div>
    <?php endif; ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách thành viên <a href="<?= ROOT ?>admin/?page=member&action=add" class="btn btn-primary ml-3">Thêm mới</a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form action="" method="POST" class="col-12">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkall" class="checkall">
                                </th>
                                <th>Mã thành viên</th>
                                <th>Tên tài khoản</th>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th>Ảnh đại diện</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th>Vai trò</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkall" class="checkall">
                                </th>
                                <th>Mã thành viên</th>
                                <th>Tên tài khoản</th>
                                <th>Họ tên</th>
                                <th>Số điện thoại</th>
                                <th>Ảnh đại diện</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th>Vai trò</th>
                                <th>Thao tác</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($member as $r) : ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="id[]" value="<?= $r['id'] ?>">
                                    </td>
                                    <td><?= $r['id'] ?></td>
                                    <td><?= $r['account'] ?></td>
                                    <td><?= $r['name'] ?></td>
                                    <td><?= $r['phone'] ?></td>
                                    <td>
                                        <img src="../images/users/<?= $r['images'] ?>" width="90" alt="">
                                    </td>
                                    <td><?= $r['email'] ?></td>
                                    <td><?= $r['address'] ?></td>
                                    <?php if ($r['role'] == 1) : ?>
                                        <td>Quản trị</td>
                                    <?php elseif ($r['role'] == 2) : ?>
                                        <td>Lễ tân</td>
                                    <?php else : ?>
                                        <td>Thợ cắt</td>
                                    <?php endif; ?>
                                    <td>
                                        <a href="<?= ROOT ?>admin/?page=member&action=edit&id=<?= $r['id'] ?>" class="btn btn-warning d-block p-2 w-75 mb-2"><i class="far fa-edit"></i></a>
                                        <a href="<?= ROOT ?>admin/?page=member&id=<?= $r['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa không')" class="btn btn-danger d-block p-2 w-75"><i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary" id="btndel-category" name="btn-del">Xóa mục đánh dấu</button>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->