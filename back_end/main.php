<?php
	ob_start();
	session_start();
    $pageTitle = 'main';
    $Title = 'main';
    include 'inital.php';
    include 'check_token.php';
    $getUser = $con->prepare("SELECT * FROM members WHERE username = ?");
    $getUser->execute(array($sessionUser));
    $info = $getUser->fetch();
    if (isset($_SESSION['user']) && $info['regstatus'] == 1) {
        include $tpl . 'header2.php'; 
        $username  = $info['username'];
        $groupid  = $info['groupid'];
        $categories = $con->prepare("SELECT category_name, category_id FROM category where parent = 0 And category_id= ? ORDER BY category_id asc");
        $categories->execute(array($groupid));
        $category_name = $categories->fetch();

        $activities = $con->prepare("SELECT post_name FROM post where type = 0 AND cat_id = ?   ORDER BY post_id  DESC limit 1");
        $activities->execute(array($groupid));
        $activity = $activities->fetch();

        $posts = $con->prepare("SELECT post_name FROM post where type = 1 ORDER BY post_id  DESC limit 1 ");
        $posts->execute();
        $post = $posts->fetch();
?>
  <section style="background:url('assets/img/ee9.jpg') center center; height:400px"id="hero" class="d-flex align-items-center">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
      <h1>الرئيسية</h1>
    </div>
  </section>
<main>
  <div id="carouselExampleSlidesOnly" class="carousel slide text-center bg-dark text-light" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <h2 class="p-2"> <?php echo $category_name['category_name']; ?></h2>
            </div>
            <div class="carousel-item">
                <h3 class="p-2"> اخر المنشورات المضافة: <?php echo ($activity)? $activity['post_name']: 'لا يوجد منشورات بعد'; ?></h3>
            </div>
            <div class="carousel-item">
                <h3 class="p-2"> اخر المقالات المضافة: <?php echo ($post) ? $post['post_name'] : 'لا يوجد مقالات بعد'; ?></h3>
            </div>
        </div>
  </div><!-- End Breadcrumbs Section -->
  <section id ="section11" class="section11">
      <div class="container">
          <div class="row">
              <div class="col-md-3">
                  <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                      <div class="main">
                          <img src="assets/img/learn-english-education-icons-vector-10706570.jpg" width="100%" height="100%">
                          <h2>المحتوى الدراسى</h2>
                          <p class="font-weight-light"><?php echo $category_name['category_name'];?></p>
                      </div>
                      <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">جميع الكورسات</a>
                      <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">الامتحانات الشاملة</a>
                      <a class="nav-link" id="v-pills-records-tab" data-toggle="pill" href="#v-pills-records" role="tab" aria-controls="v-pills-records" aria-selected="false">الصوتيات</a>
                      <a class="nav-link" id="v-pills-records-tab" data-toggle="pill" href="#v-pills-dictionary" role="tab" aria-controls="v-pills-dictionary" aria-selected="false">القاموس</a>

                      <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">البث المباشر</a>

                    </div>
              </div>
              <div class="col-md-9">
                  <div class="tab-content" id="v-pills-tabContent">
                      <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <section id="service" class="service">
                          <div class="container">
                            <div class="section-title2">
                              <h2>جميع الكورسات</h2>
                            </div>
                            <div class="row">
                              <?php
                                $stmt = $con->prepare("SELECT 
                                                            * 
                                                            FROM 
                                                                category
                                                            WHERE 
                                                                parent = ?
                                                            AND
                                                                Visibility = 1 
                                                            AND
                                                              ordering = ?
                                                            ORDER BY ordering desc");
                                $stmt->execute(array($category_name['category_id'],$info['orders']));
                                $categories = $stmt->fetchAll();
                                $vars = array("bx-blanket", "bx-book-open", "bx-camera-movie", "bx-cast", "bx-clipboard", "bx-food-menu");
                              $key = array_rand($vars);
                                foreach($categories as $category){
                               
                                ?>
                              <div class="col-lg-4 col-md-6 mb-4 d-flex align-items-stretch">
                                <div class="icon-box">
                                  <div class="icon"><i class="bx <?php echo $vars[$key]; ?>"></i></div>
                                  <h4><a href="coursecontent.php?catygory_id=<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></a></h4>
                                </div>
                              </div>
                              <?php } ?>
                            </div>
                          </div>
                        </section>
                      </div>
                      <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                          <section id="service" class="service">
                            <div class="section-title2">
                              <h2>الامتحانات الشاملة</h2>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">الامتحان</th>
                                        <th scope="col">تاريخ الامتحان</th>
                                        <th scope="col">نوع الامتحان</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $formErrors = array(); 
                                        $stmt = $con->prepare("SELECT 
                                                                    *  
                                                                FROM 
                                                                    exams
                                                                WHERE 
                                                                    type = 2 
                                                                AND
                                                                  categ_id = ?
                                                                AND 
                                                                  orders = ?
                                                                ORDER BY exam_date desc");
                                        $stmt->execute(array($category_name['category_id'], $info['orders']));
                                        $exams = $stmt->fetchAll();
                                        foreach($exams as $exam) {
                                    ?>
                                      <tr>
                                        <th scope="row"><?php echo $exam['exam_name']; ?></th>
                                        <td><?php echo $exam['exam_date']; ?></td>
                                        <td>
                                            <?php 
                                                if($exam['exam_desc'] == ''){
                                                    echo '<label class="bg-primary text-light" style="font-size: 15px;">على المنصة</label>';
                                                } else {
                                                    echo '<label class="bg-warning text-light" style="font-size: 15px;">Form</label>';
                                                }
                                            ?>
                                        </td>
                                        <td><a href="
                                        <?php 
                                                if($exam['exam_desc'] != ''){
                                                    echo $exam['exam_desc'];
                                                } else {
                                                    echo 'full_exam.php?full_exam_id='.$exam['exam_id'];
                                                }
                                            ?>
                                        ">الذهاب للامتحان</a></td>
                                      </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                          </section>
                      </div>
                      <div class="tab-pane fade" id="v-pills-records" role="tabpanel" aria-labelledby="v-pills-records-tab">
                          <section id="service" class="service">
                            <div class="section-title2">
                              <h2>الصوتيات</h2>
                            </div>
                            <section id="more-features" class="p-3">
                              <div class="container">
                                <div class="row">
                                    <?php
                                        $stmt = $con->prepare("SELECT 
                                                                    *  
                                                                FROM 
                                                                  audios
                                                                WHERE 
                                                                  status = 1 
                                                                AND
                                                                  cat_id = ?
                                                                AND 
                                                                  orders = ?
                                                                ORDER BY audio_id desc");
                                        $stmt->execute(array($category_name['category_id'], $info['orders']));
                                        $audios = $stmt->fetchAll();
                                        if($audios) {
                                        foreach($audios as $key=>$audio) {
                                    ?>
                                        <div class="col-lg-6">
                                          <div class="box wow fadeInLeft">
                                            <div class="icon">
                                            <?php if(fmod($key, 2)==0) {
                                              echo '<i class="bx bx-caret-right-circle"></i>';
                                            } else{echo '<div class="icon"><i class="bx bx-caret-right-square"></i></div>';} ?>
                                            </div>
                                            <h4 class="title"><li class="btn main_view p-0 text-right" value="<?php echo $audio['audio_id'];?>"><?php echo $audio['audio_name']; ?></li></h4>
                                            <h5 class="font-weight-light mt-3"><?php echo $audio['created_at']; ?></h5>
                                            <button style="color: #ef6603;" class="btn main_view p-0 text-left" value="<?php echo $audio['audio_id'];?>">تشغيل</button>
                                          </div>
                                        </div>
                                  <?php } }  else {
                                      echo '<h2 class="text-primary text-center"> لا يوجد ملفات صوتية الان</h2>';
                                  }
                                    ?>
                                </div>
                              </div>
                            </section>
                        </section>
                      </div>
<div class="tab-pane fade" id="v-pills-dictionary" role="tabpanel" aria-labelledby="v-pills-dictionary-tab">
                        <section id="service" class="service">
                          <div class="container">
                            <div class="section-title2">
                              <h2>القاموس</h2>
                            </div>
                            <div class="row">
                              <div class="col-lg-6 col-md-6 mb-4 d-block align-items-stretch">
                                <div class="icon-box">
                                  <div class="icon"><i class="bx bx-world"></i></div>
                                  <h4><a href="https://context.reverso.net/%D8%A7%D9%84%D8%AA%D8%B1%D8%AC%D9%85%D8%A9/">القاموس</a></h4>
                                </div>
                              </div>
                             
                            </div>
                          </div>
                        </section>
                      </div>
                      <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <section id="service" class="service">
                        <div class="container">
                            <div class="section-title2">
                              <h2>البث المباشر</h2>
                            </div>
                            <div class="row">
                                <?php
                                    $formErrors = array(); 
                                    $stmt = $con->prepare("SELECT 
                                                                    *  
                                                            FROM 
                                                                live
                                                            WHERE 
                                                                cat_id = ? 
                                                            AND 
                                                              orders = ?
                                                            limit 1");
                                    $stmt->execute(array($groupid, $info['orders']));
                                    $live = $stmt->fetch();
                                    if(isset($live['live_id'])){ ?>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">تاريخ الامتحان</th>
                                                    <th scope="col">البث المباشر</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td><?php echo $live['date']; ?></td>
                                                    <td><a href="<?php echo $live['link']; ?>">الذهاب للبث</a></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php } else { ?>
                                    <h2 class="text-primary text-center"> لا يوجد بث الان</h2>
                                    <?php } ?>
                            </div>

                        </div>
                        
                        </section>
                      </div>
                      
                  </div>
                 
              </div>
              <hr>
          </div>                  
      </div>
     
  </section>
</main>
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h2 class="text-light">الملف الصوتي</h2>
            </div>
                <div class="modal-body main_edit text-center">
                        
                </div>
                <div class="modal-footer">
                    <button type="button " class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                </div>
        </div>
    </div>
</div>
<?php
include $tpl . 'footer.php'; 
include $tpl . 'scripts.php';  ?>
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
}else {
    header('Location: index.php');
    exit();
}
ob_end_flush();
?>