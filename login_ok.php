<?php
if(!isset($_POST['user_id']) || !isset($_POST['user_pw'])) exit;
$user_id = $_POST['user_id'];
$user_pw = $_POST['user_pw'];
$members = array('admin'=>array('pw'=>'welcome', 'name'=>'Admin'),
        'user2'=>array('pw'=>'pw2', 'name'=>'�νñ�'),
        'user3'=>array('pw'=>'pw3', 'name'=>'����'));
 
if(!isset($members[$user_id])) {
        echo "<script>alert('���̵� �Ǵ� �н����尡 �߸��Ǿ����ϴ�.');history.back();</script>";
        exit;
}
if($members[$user_id]['pw'] != $user_pw) {
        echo "<script>alert('���̵� �Ǵ� �н����尡 �߸��Ǿ����ϴ�.');history.back();</script>";
        exit;
}
session_start();
$_SESSION['user_id'] = $user_id;
$_SESSION['user_name'] = $members[$user_id]['name'];
?>
<meta http-equiv='refresh' content='0;url=index.php'>