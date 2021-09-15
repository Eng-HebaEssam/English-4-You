<?php
    ob_start();
    if(!isset($_SESSION)){session_start();} 
    $pageTitle = 'free';
    $Title = 'free';
    if (isset($_SESSION['user'])) {
		header('Location: main.php');
	}
    include 'inital.php';
    include $tpl . 'header.php';   
?>
 <section style="background:url('assets/img/55ecc3fc2636d363f0566.jpg') center center; height:400px"id="hero" class="d-flex align-items-center">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
      <h1 style="font-size:50px;">الفيديوهات المجانية</h1>
      
    </div>
  </section>
  <main id="main">
    <section id="courses" class="courses">
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">

          <div class="col-lg-6 col-md-6 d-flex align-items-stretch mb-3">
            <div class="course-item">
              <img src="assets/img/3.jpg" class="img-fluid w-100" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                </div>

                <h3><a href="course-details.html">Grammer</a></h3>
                <p>القواعد للصف الثالث الثانوى</p>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                  <h4><a style="color:#fff" href="https://www.youtube.com/watch?v=Q1cjKj6KRXs" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true">مشاهدة </a></h4>
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- End Course Item-->

          
          <div class="col-lg-6 col-md-6 d-flex align-items-stretch mb-3">
            <div class="course-item">
              <img src="assets/img/2.jpg" class="img-fluid w-100" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                </div>

                <h3><a href="course-details.html">الترقيم</a></h3>
                <p>الترقيم - punctuation</p>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                  <h4><a style="color:#fff" href="https://www.youtube.com/watch?v=BfJOHLpVnuM&t=3703s" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true">مشاهدة </a></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row" data-aos="zoom-in" data-aos-delay="100"> 
          <div class="col-lg-6 col-md-6 d-flex align-items-stretch mb-3">
            <div class="course-item">
              <img src="assets/img/1.jpg" class="img-fluid w-100" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                </div>

                <h3><a href="course-details.html">مهارات الكتابة</a></h3>
                <p>مهارات الكتابة</p>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                  <h4><a style="color:#fff" href="https://www.youtube.com/watch?v=sOgEC5o1tuA&t=949s" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true">مشاهدة </a></h4>
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- End Course Item-->

          <div class="col-lg-6 col-md-6 d-flex align-items-stretch mb-3">
            <div class="course-item">
              <img src="assets/img/english1.jpg" class="img-fluid w-100" alt="...">
              <div class="course-content">
                <div class="d-flex justify-content-between align-items-center mb-3">
                </div>

                <h3><a href="course-details.html">حل أسئلة مراجعة</a></h3>
                <p>برومو حل أسئلة email- paragraph</p>
                <div class="trainer d-flex justify-content-between align-items-center">
                  <div class="trainer-profile d-flex align-items-center">
                  <h4><a style="color:#fff" href="https://www.youtube.com/watch?v=FHo3-wGbvYg&t=5s" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true">مشاهدة </a></h4>
                  </div>
                </div>
              </div>
            </div>
          </div> 
          <!-- End Course Item-->
        </div>
      </div>
    </section>
  </main>
  <!-- ======= Footer ======= -->
  <?php 
    include $tpl . 'footer.php'; 
    include $tpl . 'scripts.php'; 
    ob_end_flush();
?>