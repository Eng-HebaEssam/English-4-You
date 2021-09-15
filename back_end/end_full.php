<?php 
ob_start();
session_start();
$pageTitle = 'end';
$Title = '';
include 'inital.php';
include "check_token.php";
    $getUser = $con->prepare("SELECT * FROM members WHERE username = ?");
    $getUser->execute(array($sessionUser));
    $info = $getUser->fetch();
    if (isset($_SESSION['user']) && $info['regstatus'] == 1) {
        if (isset($_POST['exam'])) {
            $i=0; 
            $exam_id = isset($_GET['exam_id']) && is_numeric($_GET['exam_id']) ? intval($_GET['exam_id']) : 0;
            $exams = $con->prepare("SELECT number FROM exams WHERE exam_id = ? AND type = 2");
            $exams->execute(array($exam_id));
            $exam = $exams->fetch();
            $number = $exam['number']; 
            $stmt = $con->prepare("SELECT 
                                        * 
                                    FROM 
                                        part
                                    where
                                    exam_id = ?
                                    ORDER BY RAND() ");
            $stmt->execute(array($exam_id));
            $parts = $stmt->fetchAll();
            foreach ($parts as $part){
                $stmt = $con->prepare('SELECT * FROM question where part_id = ? ORDER BY RAND() 
                LIMIT ' . $number);
                $stmt->execute(array($part['part_id']));
                $exams = $stmt->fetchAll(); 
                foreach ($exams as $key=>$exam ) { 
                    $ques    = $_POST['main' . $exam['id']];
                    $answer  = $exam['right_answer'];
                    $answer2 = $exam['answer'];
                    if($ques == $answer || $ques == $answer2){$i++;}
                }
            }
            $stmt = $con->prepare("SELECT user_id FROM answer WHERE user_id = ? AND exam_id = ?");
            $stmt->execute(array($_SESSION['uid'], $exam_id));
            $count = $stmt->rowCount();
            if ($count ==  0) { 
                $stmt = $con->prepare("INSERT INTO 
                                    answer(exam_id, mark, user_id, date)
                                    VALUES(:exam_id, :mark, :user_id, now())");
                $stmt->execute(array(
                    'exam_id'   => $exam_id,
                    'mark'      => $i,
                    'user_id'   => $_SESSION['uid']
                ));
            }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
   <meta content="width=device-width, initial-scale=1.0" name="viewport">
 
    <title>English 4 You</title>
    <meta content="" name="description" content="موقع الاستاذ سامح بهنسى لتعليم الأنجليزية">
    <meta content="" name="keywords" content="سامح بهنسى, لغة أنجليزية, english 4 you, master code">
   <!-- Favicons -->
   <link href="assets/img/favicon.ico" rel="icon">

   <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
 
   <!-- Google Fonts -->
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
 
   <!-- Vendor CSS Files -->
   <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/forms.css" rel="stylesheet">
</head>
<body>
    <section class="sectionlogin">
        <div class="row">
            <div class="col-md-8 order-2 order-md-1">
                <div class="main second_error">
                    <h2 class="mb-4"> لقد تم اداء الامتحان بنجاح </h2>
                    <table class="table table-bordered">
                        <tbody>
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">النتيجة</th>
                                    <th scope="col">النتيجة الكلية</th>
                                </tr>
                            </thead>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $number; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <button><a href="main.php">الرئيسية</a></button>
                </div>
            </div>
            <div class="col-md-4 order-1 order-md-2">
                <div class="second">
                <a href="main.php">
                    <picture>
                        <source srcset="assets/img/logy.png" media="(max-width: 768px)">
                        <source srcset="assets/img/140438-OSVA5L-77.png">
                        <img src="assets/img/140438-OSVA5L-77.png" alt="Flowers" width="250px">
                    </picture>    
                    </a>        </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</html>
<?php
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