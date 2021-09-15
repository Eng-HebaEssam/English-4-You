<?php
include("connect.php");
$key=$_POST['id'];  
$stmt = $con->prepare("SELECT * FROM audios WHERE audio_id = ?");
$stmt->execute(array($key));
$lesson = $stmt->fetch();
if(!empty($lesson)){ ?>
<div class="form-group ">
    <h4>عنوان الملف</h4>
    <input type="text" name="name" placeholder="اسم الملف" class="form-control" required value="<?php echo $lesson['audio_name']; ?>">
</div>
<div class="form-group ">
    <h4>وصف الملف</h4>
    <textarea name="description" class="form-control" style="height: 100px;" ><?php echo $lesson['audio_desc']; ?></textarea>
</div>
<?php 
} else{
    echo '<h2>هذا الدرس غير موجود</h2>';
}