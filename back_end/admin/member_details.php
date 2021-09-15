<?php
ob_start(); // Output Buffering Start
session_start();
$pageTitle = 'Lesson';
if (isset($_SESSION['username'])) {
    include 'inital.php';
    $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
    $stmt = $con->prepare("SELECT members.*, 
                                    category.category_name as category_name
                                    FROM members 
                                    inner join category
                                    on category.category_id = members.groupid
                                    where userid = ? ");
    $stmt->execute(array($userid));
    $row = $stmt->fetch();
    if (! empty($row)) {
        include 'includes/templates/header.php';
        include 'includes/templates/side.php';
        ?>
        <div class="main-panel ">
            <div class="content-wrapper ">
                <div class="page-header ">
                    <h3 class="page-title ">
                        <span class="page-title-icon bg-gradient-primary text-white mr-2 ">
                            <i class="mdi mdi-home "></i>
                        </span>&nbsp; <?php echo $row['username']; ?> 
                    </h3>
                    <button id="print" style=" color:darkblue;font-size:18px;width:100px" class="mb-2 btn btn-outline-info btn-sm">الطباعة</button>
                </div>
                <div class="row" id="printTable">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $row['username']; ?></h4>
                                <div class="d-flex">
                                    <div class="d-flex align-items-center text-muted font-weight-light">
                                        <i class="mdi mdi-clock icon-sm mr-2"></i>
                                        <span> تاريخ التسجيل : <?php echo $row['date']; ?> </span>
                                    </div>
                                </div>
                                <hr>
                                <div class="mt-5 align-items-top">
                                    <h2>التفاصيل</h2>
                                    <ul>
                                        <li>القسم : <?php echo $row['category_name']; ?></li>
                                        <li>البريد الالكترونى : <?php echo $row['email']; ?></li>
                                        <li>رقم هاتف ولي الامر : <?php echo $row['phone']; ?></li>
                                         <li>رقم هاتف الطالب : <?php echo $row['phone_2']; ?></li>
                                          <li>المحافظة : <?php echo $row['country']; ?></li>
                                          <li>المركز : <?php echo $row['city']; ?></li>
                                        <li>الحالة : <?php echo $row['regstatus'] == 1 ? 'مفعل' :'غير مفعل'; ?></li>
                                        <li>ترتيب الشهر : <?php echo $row['orders']; ?></li>
                                    </ul>
                                </div>
                                <hr>
                                <div class="mt-5 align-items-top">
                                    <h2>نتائج الامتحانات</h2>
                                    <div class="table-responsive">
                                        <table class="table" id="datatableid_2">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">الامتحان</th>
                                                <th scope="col">تاريخ الاداء</th>
                                                <th scope="col">النتيجة</th>
                                                <th scope="col">نوع الامتحان</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $formErrors = array(); 
                                                    $stmt = $con->prepare("SELECT 
                                                                                answer.*, exams.exam_name AS exam_name, exams.type as type  
                                                                            FROM 
                                                                                answer
                                                                            INNER JOIN 
                                                                                exams 
                                                                            ON 
                                                                                exams.exam_id = answer.exam_id 
                                                                            WHERE 
                                                                                answer.user_id = ? 
                                                                            ORDER BY date desc");
                                                    $stmt->execute(array($userid));
                                                    $exams = $stmt->fetchAll();
                                                    foreach ($exams as $exam) {  ?>
                                                <tr>
                                                    <td><?php echo $exam['exam_name'] ?></td>
                                                    <td><?php echo $exam['date'] ?></td>
                                                    <td><?php echo $exam['mark'] ?></td>
                                                    <td>
                                                        <?php 
                                                            if($exam['type'] == 1){
                                                                echo '<label class="badge badge-primary " style="font-size: 15px;">جزئي</label>';
                                                            } elseif($exam['type'] == 2) {
                                                                echo '<label class="badge badge-warning" style="font-size: 15px;">شامل</label>';
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="mt-5 align-items-top">
                                    <h2>تفاصيل الحضور</h2>
                                    <div class="table-responsive">
                                        <table class="table" id="datatableid">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">الدرس</th>
                                                <th scope="col">تاريخ الحضور</th>
                                                <th scope="col">تاريخ الانصراف</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $formErrors = array(); 
                                                    $stmt = $con->prepare("SELECT 
                                                                                lesson_member.*, lessons.lesson_name AS lesson_name
                                                                            FROM 
                                                                                lesson_member
                                                                            INNER JOIN 
                                                                                lessons 
                                                                            ON 
                                                                                lesson_member.lesson_id = lessons.lesson_id 
                                                                            WHERE 
                                                                                lesson_member.member_id = ? 
                                                                            ORDER BY date desc");
                                                    $stmt->execute(array($userid));
                                                    $exams = $stmt->fetchAll();
                                                    foreach ($exams as $exam) {  ?>
                                                <tr>
                                                    <td><?php echo $exam['lesson_name'] ?></td>
                                                    <td><?php echo $exam['date'] ?></td>
                                                    <td><?php echo $exam['last_date'] ?></td>
                                                </tr>
                                                <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="mt-5 align-items-top">
                                    <h2>تفاصيل الغياب</h2>
                                    <div class="table-responsive">
                                        <table class="table" id="datatableid_3">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">الدرس</th>
                                                <th scope="col">تاريخ الدرس</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $stmt = $con->prepare("SELECT category_id FROM category where parent = ?");
                                                    $stmt->execute(array($row['groupid']));
                                                    $cats = $stmt->fetchAll();
                                                    foreach($cats as $cat){ 
                                                        $lessons = $con->prepare("SELECT * FROM lessons Where cat_id = ?");
                                                        $lessons->execute(array($cat['category_id']));
                                                        $lessons = $lessons->fetchAll();
                                                        foreach($lessons as $lesson){
                                                            $stmt = $con->prepare("SELECT 
                                                                                    lesson_id
                                                                                FROM 
                                                                                    lesson_member
                                                                                WHERE 
                                                                                    member_id = ?
                                                                                And
                                                                                    lesson_id = ? ");
                                                            $stmt->execute(array($userid, $lesson['lesson_id']));
                                                            $exams = $stmt->fetchAll();
                                                            if(empty($exams)){
                                                                echo '
                                                                    <tr>
                                                                        <td>'.$lesson['lesson_name'].'</td>
                                                                        <td>'.$lesson['lesson_data'].'</td>
                                                                    </tr>
                                                                ';
                                                            }
                                                        }
                                                    }
                                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <h2 class="main_h2" style="text-align: center;">
                                    <img style="max-width: 100%;" src="layout/images/sign.png" alt="">
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
        <?php
        include 'includes/templates/footer.php'; ?>
        <script>
            $('#datatableid_2').DataTable({
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
                        }
                    });
        </script>
        <script>
            $('#datatableid_3').DataTable({
                        "language": {
                            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
                        }
                    });
        </script>
        <script>
            function printData()
            {
                var divToPrint=document.getElementById("printTable");
                newWin= window.open("");
                newWin.document.write(divToPrint.outerHTML);
                var css =`table, td, th {
                    border: 1px solid black;
                    text-align:center;
                    margin:auto;
                    direction:rtl;
                }
                .main_h2{text-align:center}
                li{list-style: none;}
                body{text-align:right;}
                .dataTables_length, .dataTables_filter, .pagination{display:none;}
                #datatableid_wrapper .row:first-child{display:none;}
                #datatableid_wrapper .row:last-child{display:none;}
                th {
                    background-color: #7a7878;
                    text-align:center
                }`;
            var div = $("<div />", {
                html: '&shy;<style>' + css + '</style>'
            }).appendTo( newWin.document.body);
                newWin.print();
                newWin.close();
            }

            $('#print').on('click',function(){
            printData();
            })
        </script>
        <?php
    } else {
        header('Location: error-404.html');
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
ob_end_flush(); 
?>
                        