<?php
	ob_start();
	session_start();
    $pageTitle = 'main';
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
        $category_id = isset($_GET['catygory_id']) && is_numeric($_GET['catygory_id']) ? intval($_GET['catygory_id']) : 0;
        $getlessons = $con->prepare("SELECT * FROM lessons WHERE cat_id = ?");
        $getlessons->execute(array($category_id));
        $count = $getlessons->rowCount();
        if ($count > 0) {
            $lessons = $getlessons->fetchAll();
            $categories = $con->prepare("SELECT category_name, image, category_description FROM category where category_id = ? AND ordering = ?");
            $categories->execute(array($category_id,$info['orders']));
            $category = $categories->fetch();
            if($category){
?>
<section style="background:url('assets/img/ee9.jpg') center center; height:400px"id="hero" class="d-flex align-items-center">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
      <h1><?php echo $category['category_name']; ?></h1>
    </div>
  </section>
<main>
    <section id ="section11" class="section11">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <img src="assets/img/learn-english-education-icons-vector-10706570.jpg" width="100%">
                            <h2><?php echo $category['category_name'];?></h2>
                            <p class="font-weight-light"><?php echo $category['category_description'];?></p>
                    </div>
                </div>
                <div class="col-md-9 ">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                          <section class="service" id="service">
                          <div class="section-title2">
                              <h2>جميع الدروس</h2>
                            </div>
                              <div class="row">
                              <?php foreach($lessons as $index => $lesson){ ?>
                                <div class="col-lg-4 col-md-6 mb-2" data-aos="fade-up">
                                  <div class="icon-box">
                                   <?php 
                                                $vars = array("bx-blanket", "bx-book-open", "bx-camera-movie", "bx-cast", "bx-clipboard", "bx-food-menu");
                                                $key = array_rand($vars);
                                            ?>
                                    <div class="icon"><i class="bx <?php echo $vars[$key]; ?>"></i></div>
                                    <h4 class="title"><a href="lesson.php?lesson_id=<?php echo $lesson['lesson_id']; ?>"><?php echo $lesson['lesson_name']; ?></a></h4>
                                    <p>
                                      <?php
                                          $stringCut = substr( $lesson['lesson_description'], 0, 100);
                                          $endPoint = strrpos($stringCut, ' ');
                                          $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                          echo $string ;?>
                                    </p>
                                    <a href="lesson.php?lesson_id=<?php echo $lesson['lesson_id']; ?>" class="icon-box_a">المحاضرة</a>
                                    <?php 
                                      $getexam = $con->prepare("SELECT exam_id FROM exams WHERE lesson_id = ? AND type = 1 ");
                                      $getexam->execute(array($lesson['lesson_id']));
                                      $getexam = $getexam->fetch();
                                      if(! empty($getexam)){
                                          echo '<span class="m-3">||</span><a href="exam.php?exam_id='.$getexam['exam_id'].'" class="icon-box_a">التدريب</a>';
                                      }
                                    ?>
                                  </div>
                                </div>
                                <?php } ?>
                              </div>
                            </section>
                        </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php 
        include $tpl . 'footer.php'; 
        include $tpl . 'scripts.php'; 
        } else { 
            header('Location: none.php');
            exit();
        }
    } else {
      header('Location: none.php');
      exit();
    }
}else {
    header('Location: index.php');
    exit();
}
ob_end_flush();
?>