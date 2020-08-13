<?php 
require_once "database.php";

//Hàm hiển thị toàn bộ danh mục
function list_all_appointment(){
    $sql = "SELECT appointments.*, account, customers.name,customers.phone ,time
    from appointments inner join customers on customers.id = appointments.id_customer
    inner join members on members.id = appointments.id_member
    inner join word_time on word_time.id = appointments.id_time ORDER BY id DESC";
    return query_exe($sql);
}

//Ham hien thi lich hen theo cancel
function appointment_list_cancel($cancel) {
    $sql = "SELECT appointments.*, account, customers.name,customers.phone ,time
    from appointments inner join customers on customers.id = appointments.id_customer
    inner join members on members.id = appointments.id_member
    inner join word_time on word_time.id = appointments.id_time where cancel = $cancel ORDER BY id DESC";
    return query_exe($sql);
}

//Hàm lấy ra 1 bản ghi
function list_one_appointment($id){
    return listOne('appointments','id',$id);
}
//Hamf lấy 1 dòng  mới thêm vào theo
function list_top_app($id_customer){
    $sql = "SELECT * from appointments  where id_customer =$id_customer ORDER BY id DESC limit 0,1";
    return query_limit($sql);
}
//Thêm dữ liệu vào bảng
function insert_appointment($id_member,$id_customer,$day,$id_time){
    $data =[
        'id_member' => $id_member,
        'id_customer'=>$id_customer,
        'day'=>$day,
        'id_time'=>$id_time,
        'cancel'=>0
    ];
    return insert('appointments',$data);
}

//function cập nhật loại hàng
function appointment_update($id,$cancel) {
    $data = [
    'cancel'=>$cancel
];
    update('appointments', $data, 'id', $id);
}
//function Xóa dữ liệu loại hàng
function appointment_delete($id) {
   return delete('appointments', 'id', $id);
}

//Ham hien thi toan bo lich hen theo id_customer
function appointment_custom($id_customer){
    $sql = "SELECT appointments.*, account,time,customers.name,customers.phone,members.name as member_name,members.images as member_images
    from appointments inner join customers on customers.id = appointments.id_customer
    inner join members on members.id = appointments.id_member
    inner join word_time on word_time.id = appointments.id_time 
    where id_customer= $id_customer ORDER BY id DESC";
    return query_exe($sql);
}

//Ham hien thi toan bo lich hen theo id_member
function appointment_member($id_member){
    $sql = "SELECT appointments.*, account, customers.name,customers.phone ,time
    from appointments inner join customers on customers.id = appointments.id_customer
    inner join members on members.id = appointments.id_member
    inner join word_time on word_time.id = appointments.id_time 
    where id_member= $id_member ORDER BY id DESC";
    return query_exe($sql);
}
//Ham hien thi lich hen theo id_customer va trang thai
function appointment_custom_status($id_customer,$cancel){
    $sql = "SELECT appointments.*, account,time,customers.name,customers.phone,members.name as member_name,members.images as member_images
    from appointments inner join customers on customers.id = appointments.id_customer
    inner join members on members.id = appointments.id_member
    inner join word_time on word_time.id = appointments.id_time 
    where id_customer= $id_customer and cancel=$cancel ORDER BY id DESC";
    return query_exe($sql);
}

//Ham hien thi lich hen theo id_member va trang thai
function appointment_member_status($id_member,$cancel){
    $sql = "SELECT appointments.*, account,time,customers.name,customers.phone
    from appointments inner join customers on customers.id = appointments.id_customer
    inner join members on members.id = appointments.id_member
    inner join word_time on word_time.id = appointments.id_time 
    where id_member= $id_member and cancel=$cancel ORDER BY id DESC";
    return query_exe($sql);
}