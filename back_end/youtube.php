<?php
	ob_start();
	session_start();
    $pageTitle = 'liveyou';
    $Title = 'main';
	include 'inital.php';
    include "check_token.php";
    $getUser = $con->prepare("SELECT * FROM members WHERE username = ?");
    $getUser->execute(array($sessionUser));
    $info = $getUser->fetch();
    if (isset($_SESSION['user']) && $info['regstatus'] == 1) {
        include $tpl . 'header2.php';
        $username  = $info['username'];
        $groupid  = $info['groupid'];
        $lesson_id = isset($_GET['lesson_id']) && is_numeric($_GET['lesson_id']) ? intval($_GET['lesson_id']) : 0;
        $getlessons = $con->prepare("SELECT * FROM lessons WHERE lesson_id = ?");
        $getlessons->execute(array($lesson_id));
        $count = $getlessons->rowCount();
        if ($count > 0) {
            $lesson = $getlessons->fetch();
            $stmt = $con->prepare("SELECT 
                                    answer.mark  
                                FROM 
                                    answer
                                INNER JOIN 
                                    exams 
                                ON 
                                    exams.exam_id = answer.exam_id
                                where 
                                    exams.lesson_id = ?
                                AND
                                    exams.type = 1
                                ");
            $stmt->execute(array($lesson['lesson_id']));
            $mark = $stmt->fetch();
            $main_mark = $mark? $mark['mark'] : 0;
?>
<section style="background:url('assets/img/ee9.jpg') center center; height:400px"id="hero" class="d-flex align-items-center">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
        <h1><?php echo $lesson['lesson_name']; ?></h1>
    </div>
</section>
    <main id="main" >
        <?php if ($lesson['Approve'] > 0){ ?>
            <section class="section11" >
                <div class="container">
                    <?php 
                        // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        //     if (isset($_POST['comment_main'])) {
                        //         $comment 	= filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
                        //         $userid 	= $_SESSION['uid'];
                        //         if (! empty($comment)) {
                        //             $stmt = $con->prepare("INSERT INTO 
                        //                 comments(comment, status, comment_data, lesson_id, member_id)
                        //                 VALUES(:zcomment, 0, NOW(), :lesson_id, :zuserid)");
                        //             $stmt->execute(array(
                        //                 'zcomment' => $comment,
                        //                 'lesson_id' => $lesson['lesson_id'],
                        //                 'zuserid' => $userid
                        //             ));
                        //             if ($stmt) {
                        //                 echo '<div class="alert mt-3 alert-success text-center alert-dismissible fade show" role="alert" id="alert-message">
                        //                         تم اضافة التعليق في انتظار الموافقة
                        //                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        //                             <span aria-hidden="true">&times;</span>
                        //                         </button>
                        //                     </div>';
                        //             }
                        //         } else {
                        //             echo '<div class="alert mt-3 alert-warning alert-dismissible text-center fade show" role="alert" id="alert-message">
                        //                     يجب عليك اضافة التعليق
                        //                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        //                         <span aria-hidden="true">&times;</span>
                        //                     </button>
                        //                 </div>';
                        //         }
                        //     }
                        // }
                    ?>
                    <div class="row">
                        <div class="card text-center" style="width: 100%; padding:0;">
                            <div class="card-header">
                                <h2><?php echo $lesson['lesson_name']; ?></h2>
                                <h5 class="text-left text-muted"><?php echo $lesson['lesson_data']; ?></h5>
                            </div>
                            <div class="video main_video"><?php
                                        if($lesson['video'] != ''){
                                            echo '
                                            <div class="embed-responsive embed-responsive-16by9">
                                                '.$lesson['video'].'
                                            </div>
                                            ';
                                        } else {
                                            echo '
                                            <video width="100%" controls controlsList="nodownload" oncontextmenu="return false;">
                                                <source src="admin/uploads/'.$lesson['video_name'].'">
                                            </video> 
                                            ';
                                        }
                                ?> 
                            </div>
                            <div class="card-footer">
                                <h2 class="text-right pt-3">تفاصيل البث</h2>
                                <p class="text-right pb-3"><?php echo $lesson['lesson_description']; ?></p>
                                <!-- <hr>
                                <div class="main_comments text-right">
                                    <h2> التعليقات</h2>
                                    <?php    
                                        $stmt = $con->prepare("SELECT 
                                                                    comments.*, members.username AS Member, members.avatar As image  
                                                                FROM 
                                                                    comments
                                                                INNER JOIN 
                                                                    members 
                                                                ON 
                                                                    members.userid = comments.member_id
                                                                WHERE 
                                                                    lesson_id = ?
                                                                AND 
                                                                    status = 1
                                                                ORDER BY 
                                                                    lesson_id desc");
                                        $stmt->execute(array($lesson['lesson_id']));
                                        $comments = $stmt->fetchAll();
                                    ?>
                                    
                                    <?php 
                                        if($comments){
                                            foreach ($comments as $comment) {
                                                ?>
                                                <div class="row mb-3">
                                                    <div class="col-1">
                                                        <img src="assets/img/team/2.png" class="card-img-top" alt="...">
                                                    </div>
                                                    <div class="col-11">
                                                        <h3><?php echo $comment['Member'] ?></h3>
                                                        <p><?php echo $comment['comment'] ?></p>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        } else {
                                            echo '<p class="text-right pb-3"> لا يوجد تعليقات </p>';
                                        }
                                    ?>
                                    <hr>
                                    <form  action="lesson.php?lesson_id=<?php echo $lesson['lesson_id']; ?>" method="POST">
                                        <h2 class="mb-3">اضافة التعليقات</h2>
                                        <textarea name="comment" placeholder="اضافة تعليق" style="min-height: 130px;"></textarea>
                                        <button class="mt-3" type="submit" name="comment_main" style="font-size:17px;padding: 10px 30px;">ارسال</button>
                                    </form>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } else {
            echo '
                <section style="height:500px">
                    <div class="container">
                        <div class="alert alert-warning alert-dismissible fade show text-center" style="font-size:20px;margin-top:150px;" role="alert">
                        هذا البث غير موجود 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    </div>
                </section>
                
            ';
        } ?>
    </main>
    <?php
            include $tpl . 'footer.php'; 
            include $tpl . 'scripts.php'; 
        } else { 
            header('Location: 404-error.php');
            exit();
        }
}else {
    header('Location: index.php');
    exit();
}
ob_end_flush();
?>