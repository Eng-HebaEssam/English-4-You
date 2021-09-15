<?php
ob_start(); // Output Buffering Start
session_start();
$pageTitle = 'Lesson';
if (isset($_SESSION['username'])) {
    include 'inital.php';
    include 'includes/templates/header.php';
    include 'includes/templates/side.php';
    ?>
            <div class="main-panel ">
                <div class="content-wrapper ">
                    <div class="page-header ">
                        <h3 class="page-title ">
                            <span class="page-title-icon bg-gradient-primary text-white mr-2 ">
                                <i class="mdi mdi-home "></i>
                            </span>&nbsp; الصوتيات
                        </h3>
                        <div class="">
                            <button style="color:darkblue;font-size:15px " type="button " class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#add">أضافة ملف صوتي</button>
                        </div>
                    </div>
                    <?php 
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if (isset($_POST['add'])) {
                                $name 	        = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
                                $description    = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
                                $parent         = filter_var($_POST['category'],FILTER_SANITIZE_NUMBER_INT);
                                $ordering      = filter_var($_POST['ordering'],FILTER_SANITIZE_NUMBER_INT);
                                // Upload Variables
                                $videoName  = $_FILES['video']['name'];
                                $videoSize  = $_FILES['video']['size'];
                                $videoTmp	  = $_FILES['video']['tmp_name'];
                                $videoType  = $_FILES['video']['type'];
                                // List Of Allowed File Typed To Upload
                                $videoAllowedExtension = array("ogg", "wav", "mp3", "OGG", "WAV", "MP3");
                                // Get Avatar Extension
                                $videos = explode('.', $videoName);
                                $videoExtension = strtolower(end($videos));
                                if (isset($name)) {
                                    if (strlen($name) < 4) {$formErrors[] = 'يجب وضع اسم للملف اكبر من 4 حروف ';}
                                }
                                if (! empty($videoName) && ! in_array($videoExtension, $videoAllowedExtension)) {
                                    $formErrors[] = 'امتداد الملف هذا غير متوفر';
                                }
                                // Check If There's No Error Proceed The User Add
                                if (empty($formErrors)) {
                                        $video = $videoName;
                                        $uploads_dir = 'uploads';
                                        if (move_uploaded_file($videoTmp, "$uploads_dir/$video")){
                                            $stmt = $con->prepare("INSERT INTO 
                                                    audios(orders, audio_name, audio_desc, created_at, member_id, cat_id, audio, status)
                                                    VALUES(:orders, :lesson_name, :lesson_description, now(), :member_id, :cat_id, :video_name, 0)");
                                            $stmt->execute(array(
                                                'orders'           => $ordering,
                                                'lesson_name'           => $name,
                                                'lesson_description'    => $description,
                                                'member_id'             => $_SESSION['ID'],
                                                'cat_id'                => $parent,
                                                'video_name'            => $video
                                            ));
                                            if ($stmt) {
                                                echo '<div class="alert alert-success text-center alert-dismissible fade show" role="alert" id="alert-message">
                                                        تم اضافة الملف بنجاح
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>';
                                            }
                                        }
                                } else{
                                    foreach($formErrors as $formError){
                                        echo '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert" id="alert-message">
                                                    '.$formError.'
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>';
                                    }
                                }
                            }
                            if (isset($_POST['remove'])) {
                                $lessonid = filter_var($_POST['lessonid'], FILTER_SANITIZE_NUMBER_INT);
                                $check  = checkItem('audio_id', 'audios', $lessonid);
                                // If There's Such ID Show The Form
                                if ($check > 0) {
                                    $stmt = $con->prepare("SELECT audio FROM audios where audio_id = ? ");
                                    $stmt->execute(array($lessonid));
                                    $count = $stmt->rowCount();
                                    if ($check > 0) {
                                        $row = $stmt->fetch();
                                        if (!empty($row['audio'])) {
                                            $name = 'uploads/';
                                            unlink($name.$row['audio']);
                                        }
                                        $stmt = $con->prepare("DELETE FROM audios WHERE audio_id = :lessonid");
                                        $stmt->bindParam(":lessonid", $lessonid);
                                        $stmt->execute();
                                        if ($stmt) {
                                            echo '<div class="alert alert-success text-center alert-dismissible fade show" role="alert" id="alert-message">
                                                    تم حذف الملف بنجاح
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>';
                                        }
                                    }
                                } else {
                                    echo '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert" id="alert-message">
                                            هذا الملف غير موجود 
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>';
                                }
                            }
                            if (isset($_POST['activiate'])) {
                                $lesson_id = filter_var($_POST['lesson_id'], FILTER_SANITIZE_NUMBER_INT);
                                $check  = checkItem('audio_id', ' audios', $lesson_id);
                                // If There's Such ID Show The Form
                                if ($check > 0) {
                                    $stmt = $con->prepare("UPDATE  audios SET status = 1 WHERE audio_id = ?");
                                    $stmt->execute(array($lesson_id));
                                    $stmt->execute();
                                    if ($stmt) {
                                        echo '<div class="alert alert-success text-center alert-dismissible fade show" role="alert" id="alert-message">
                                                تم تفعيل الملف بنجاح
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert" id="alert-message">
                                            هذا الملف غير موجود 
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>';
                                }
                            }
                            if (isset($_POST['edit'])) {
                                $name 	        = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
                                $description    = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
                                $lessonid       = filter_var($_POST['lessonid'], FILTER_SANITIZE_NUMBER_INT);
                                if (isset($name)) {
                                    if (strlen($name) < 4) {$formErrors[] = 'يجب وضع اسم للملف ';}
                                }
                                // Check If There's No Error Proceed The User Add
                                if (empty($formErrors)) {
                                        $stmt = $con->prepare("UPDATE audios 
                                                                SET audio_name = ?, audio_desc = ?
                                                                WHERE audio_id  = ?");
                                        $stmt->execute(array($name, $description, $lessonid ));
                                        if ($stmt) {
                                            echo '<div class="alert alert-success text-center alert-dismissible fade show" role="alert" id="alert-message">
                                                    تم تعديل الملف بنجاح
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>';
                                        }
                                } else{
                                    foreach($formErrors as $formError){
                                        echo '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert" id="alert-message">
                                                    '.$formError.'
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>';
                                    }
                                }
                            }
                            if (isset($_POST['not_activiate'])) {
                                $cat_id = filter_var($_POST['lesson_id'], FILTER_SANITIZE_NUMBER_INT);
                                $check  = checkItem('audio_id', 'audios', $cat_id);
                                // If There's Such ID Show The Form
                                if ($check > 0) {
                                    $stmt = $con->prepare("UPDATE audios SET status = 0 WHERE audio_id = ?");
                                    $stmt->execute(array($cat_id));
                                    $stmt->execute();
                                    if ($stmt) {
                                        echo '<div class="alert alert-success text-center alert-dismissible fade show" role="alert" id="alert-message">
                                                تم الغاء تفعيل الملف بنجاح
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>';
                                    }
                                } else {
                                    echo '<div class="alert alert-danger text-center alert-dismissible fade show" role="alert" id="alert-message">
                                            هذا الملف غير موجود 
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>';
                                }
                            }
                        }
                        $stmt = $con->prepare("SELECT 
                                                audios.*, 
                                                category.category_name AS category_name
                                            FROM 
                                                audios
                                            INNER JOIN 
                                                category 
                                            ON 
                                                category.category_id = audios.cat_id 
                                            ORDER BY 
                                                audio_id asc");
                            $stmt->execute();
                            $rows = $stmt->fetchAll();
                            if (! empty($rows)) {
                    ?>
                    <div class="row ">
                        <div class="col-12 grid-margin ">
                            <div class="card ">
                                <div class="card-body ">
                                    <h4 class="card-title ">أخر الملفات الصوتية</h4>
                                    <div class="table-responsive ">
                                        <table class="table" id="datatableid">
                                            <thead>
                                                <tr>
                                                    <th> رقم الملف </th>
                                                    <th> اسم الملف الصوتي </th>
                                                    <th>الحالة</th>
                                                    <th>تاريخ الاضافة</th>
                                                    <th> القسم</th>
                                                    <th>لوحة التحكم</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
							            foreach($rows as $row) {?>
                                            <tr>
                                                <td> <?php echo $row['audio_id'];?></td>
                                                <td>
                                                    <!-- <img src="layout/images/faces/face1.jpg " class="mr-2 " alt="image ">  -->
                                                    <?php echo $row['audio_name'];?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if($row['status']==0){echo'<label class="badge badge-gradient-danger">غير مفعل</label>';}
                                                        else {echo'<label class="badge badge-gradient-primary"> مفعل</label>';}
                                                    ?>
                                                </td>
                                                <td> <?php echo $row['created_at'];?></td>
                                                <td> <?php echo $row['category_name'];?></td>
                                                <td>
                                                    <button type="button " class="btn btn-outline-success btn-sm lesson_edit main_view" value="<?php echo $row['audio_id'];?>">تعديل</button>
                                                    <input type="hidden" value="<?php echo $row['audio_id'];?>" id="lesson">
                                                    <button type="button " class="btn btn-outline-danger btn-sm lesson_delete"data-toggle="modal" data-target="#remove">حذف</button>
                                                    <?php  
                                                        if($row['status']== 0) {
                                                                echo'<button type="button " class="btn btn-outline-primary btn-sm activiate_lesson" data-toggle="modal" data-target="#activiate">تفعيل</button>';
                                                            } else {
                                                                echo'<button type="button " class="btn btn-outline-dark btn-sm not_activiate_lesson" data-toggle="modal" data-target="#not_activiate">الغاء التفعيل</button>';
                                                            }
                                                    ?>                                                
                                                </td>
                                            </tr>
                                        <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="remove" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger">
                                    <h2 class="text-light">حذف الملف </h2>
                                </div>
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                    <div class="modal-body">
                                        <h3 class="text-center">هل تريد حذف هذا الملف</h3>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" value="" name="lessonid" id="lessonid_2">
                                        <button type="submit" class="btn btn-danger" name="remove">حذف</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="activiate" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h2 class="text-light">تفعيل الملف الصوتي </h2>
                                </div>
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                    <div class="modal-body">
                                        <h3 class="text-center">هل تريد تفعيل هذا الملف</h3>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" value="" name="lesson_id" id="lesson_id">
                                        <button type="submit" class="btn btn-primary" name="activiate">تفعيل</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-success">
                                    <h2 class="text-light">تعديل الملف </h2>
                                </div>
                                <form class="float-right" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                    <div class="modal-body main_edit">
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit " class="btn btn-success" name="edit">تعديل الملف</button>   
                                        <input type="hidden" value="" name="lessonid" id="lesson_2">
                                        <button type="button " class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="not_activiate" tabindex="-1" aria-labelledby="removeLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-dark">
                                    <h2 class="text-light">الغاء تفعيل الملف</h2>
                                </div>
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                                    <div class="modal-body">
                                        <h3 class="text-center">هل تريد الغاء اظهار الملف </h3>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" value="" name="lesson_id" id="lesson_id_4">
                                        <button type="submit" class="btn btn-dark" name="not_activiate">الغاء التفعيل</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addlabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h2 class="text-light">اضافة ملف صوتي </h2>
                                </div>
                                <form class="float-right" action="audio.php" method="POST" enctype="multipart/form-data">
                                    <div class="modal-body">
                                            <div class="form-group ">
                                                <h4>عنوان الملف الصوتي</h4>
                                                <input type="text" name="name" placeholder="اسم الدرس" class="form-control" required>
                                            </div>
                                            <div class="form-group ">
                                                <h4>وصف الملف الصوتي</h4>
                                                <textarea name="description" class="form-control" style="height: 100px;"></textarea>
                                            </div>
                                            <div class="form-group ">
                                                <h4>الترتيب</h4>
                                                <input type="number" name="ordering" class="form-control" placeholder=" ترتيب القسم" />
                                            </div>
                                            <div class="form-group ">
                                                <h4>الملف الصوتي</h4>
                                                <input type="file" class="file-upload-default" name="video" required/>  
                                                <div class="input-group col-xs-12" style="background-color: #fff;">
                                                    <input type="text" class="form-control file-upload-info" disabled placeholder="تحميل الملف">
                                                    <span class="input-group-append">
                                                        <button class="file-upload-browse btn btn-gradient-primary" type="button" style="border-radius: 0;">تحميل</button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <h4>القسم</h4>
                                                <select name="category" class="form-control">
                                                    <option disabled selected>...</option>
                                                    <?php
                                                        $getAll = $con->prepare("SELECT * FROM category where parent = 0 ORDER BY ordering asc");
                                                        $getAll->execute();
                                                        $allCats = $getAll->fetchAll();
                                                        foreach ($allCats as $cat) {
                                                            echo "<option value='" . $cat['category_id'] . "'>" . $cat['category_name'] . "</option>";                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit " class="btn btn-info" name="add">اضافة ملف صوتي</button>    
                                        <button type="button " class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php
include 'includes/templates/footer.php'; ?>
<script>
    $('.main_view').click(function () {
        let id = $(this).val();
        var url = "edit_audio.php";
        $.ajax({
            type:"POST",
            url:url,
            data:"id="+id,
            success:function(data){
                $('.main_edit').html(data);
                $('#edit').modal('show');
            }
        });
    });
</script>
<?php
} else {
    header('Location: index.php');
    exit();
}
ob_end_flush(); 
?>