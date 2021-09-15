<?php
include("connect.php");
$key=$_POST['id'];  
$stmt = $con->prepare("SELECT * FROM audios WHERE audio_id = ?");
$stmt->execute(array($key));
$audio = $stmt->fetch();
if(!empty($audio)){ ?>
<h4 class="title font-weight-bold mb-2"><?php echo $audio['audio_name']; ?></h4>
<audio controls controlsList="nodownload">
<source src="admin/uploads/<?php echo $audio['audio'];?>" type="audio/mp3">
</audio>
<p class="description"><?php echo $audio['audio_desc']; ?></p>

<?php 
} else{
    echo '<h2>هذا الملف غير موجود</h2>';
}