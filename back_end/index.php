<?php
    ob_start();
    if(!isset($_SESSION)){session_start();} 
    $pageTitle = 'Homepage';
    $Title = 'Homepage';
    if (isset($_SESSION['user'])) {
		header('Location: main.php');
	}
    include 'inital.php';
    include $tpl . 'header.php';   
?>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-end align-items-center">
    <div id="heroCarousel" class="container carousel carousel-fade" data-ride="carousel" style="min-height: 560px;">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">مرحبا بك فى <span><br> English 4 You</span></h2>
          <p class="animate__animated fanimate__adeInUp">موقع تعليمى يهتم باللغة الأنجليزية وتعليمها بأسلوب ميسر</p>
          <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">المزيد عنا </a>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">الفيديوهات المجانية</h2>
          <p class="animate__animated animate__fadeInUp">تحتوى المنصة على كثير من الفيديوهات المجانية </p>
          <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">الفيديوهات المجانية</a>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">المقالات </h2>
          <p class="animate__animated animate__fadeInUp">تحتوى المنصة على العديد من المقالات التى توضح جوانب اللغة  الأنجليزية</p>
          <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">المقالات</a>
        </div>
      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon bx bx-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon bx bx-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>

    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
      <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
      </g>
      <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
      </g>
      <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
      </g>
    </svg>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">
        <div class="section-title" data-aos="zoom-out">
          <h2>نبذة تعريفية</h2>
          <p >من نحن ؟</p>
        </div>
      </div>
    </section>
       <!-- ======= Why Us Section ======= -->
       <section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
        <div class="container">
  
          <div class="row">
            <div class="col-lg-6 video-box">
              <img src="assets/img/learn-english-design-vector-7178226.jpg" class="img-fluid" alt="">
              <a href="https://www.youtube.com/watch?v=YlDg7X11s5U" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a>
            </div>
  
         <div class="col-lg-6 d-flex flex-column justify-content-center p-5">
  
              <div class="icon-box">
                <!-- <div class="icon"><i class="bx bx-message-rounded-error"></i></div> -->
                <h4 class="title "><a href="">مستر سامح بهنسى </a></h4>
                <p class="description">مدرس اللغة الأنجليزية</p>
               
              </div>
              <div class="p-3">
                  <div class="icon-box">
                    <div class="icon"><i class="bx bx-bookmark-heart"></i></div>
                    <h4 class="title"><a href="#" data-toggle="modal" data-target="#exampleModal">معلومات شخصية</a></h4> 
                    <p class="description">من مواليد محافة كفرالشيخ عام 1978 خريج كلية التربية شعبة اللغة الانجليزية ...</p>
                  </div>
                  <div class="icon-box">
                    <div class="icon"><i class="bx bx-bookmark-heart"></i></div>
                    <h4 class="title"><a href="#" data-toggle="modal" data-target="#exampleModal1">الدورات </a></h4>
                    <p class="description">دورة تدريبية خاصة (التنمية المهنية لمعلمى المرحلة الثانوية) .... </p>
                  </div>
                  <div class="icon-box">
                    <div class="icon"><i class="bx bx-bookmark-heart"></i></div>
                    <h4 class="title"><a href="#" data-toggle="modal" data-target="#exampleModal2">المناصب</a></h4>
                    <p class="description">رئاسة كنترولى الشهيد عزت الشافعى والشهيد هشام بركات...</p>
                  </div>
              </div>
  
            </div>
          </div>
  
        </div>
      </section>
      <!-- End Why Us Section -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"style="background-color:#ef6603">
        <h5 class="modal-title"  id="exampleModalLabel">معلومات شخصية</h5>
      </div>
      <div class="modal-body text-right">
      مستر سامح بهنسى من مواليد محافة كفرالشيخ عام 1978 خريج كلية التربية شعبة اللغة الانجليزية جامعة الازهر الشريف بالقاهرة تقدير عام جيد جدا تلقى علوم اللة الانجليزية على يد اساتذة الجامعة الامريكية وعين شمس والقاهرة بالاضافة الى الازهر الشريف عمل فى مدرسة الشهيد عزت الشافعى الثانوية بنات القديمة من عام 2011 وحتى 2019 ثم انتقل الى مدرسة المستشار هشام بركات من 2019 حتى الان شارك فى العديد من الحصص النموذجية بالمدارس والمعلنة عبر الانترنت تلقى العديد من الدورات وحصل على العديد من الشهادات
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" style="color:#ef6603" data-dismiss="modal">أنهاء</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"style="background-color:#ef6603">
        <h5 class="modal-title"  id="exampleModalLabel">الدورات </h5>
        
      </div>
      <div class="modal-body text-right">
      1- دورة تدريبية خاصة (التنمية المهنية لمعلمى المرحلة الثانوية) من<br> 25 - 9 - 2019 حتى 26 - 9 - 2019 
<br> 2- برنامج التكوين المهنى والاخلاقى للقيادات التربوية من<br> 11 - 3 - 2018 حتى 15 - 3 - 2018
<br>3- تدريب دمج التكنولوجيا بالتعليم من<br> 13 - 9 - 2018 حتى 17 - 9 - 2018
<br>4- دورة تدريبية TOT من 26 - 11 - 2018 حتى 29 - 11 - 2018
<br>5-  دورة تدريبية لشغل وظيفة توجية (الاكاديمية المهنية للمعلم من<br> 16 - 12 - 2018 حتى 19 - 12 - 2018
<br>6- تدريب power point بمركز التطوير التكنولوجى من<br> 16 - 12 - 2018 حتى 17 - 12 - 2018
<br>7- دورة تنمية مهارات المعلمين - مصادر بنك المعرفة - بحوث الفعل من 7 - 11 - 2017 حتى 9 - 11 - 2017
<br>8- دورة تدريبية للمعم المحترف (محافظة القاهرة) الاكاديمية الكندية للتدريب والاستشارات C.A.T.C من5- 6 - 2014 حتى 6-6-2014.
<br>9- برنامج تدريبى لمعلمين المرحلة الثانوية على التعليم النشط (كلية التربية) من 26 - 2 - 2012 جتى 29 - 2 - 2012
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" style="color:#ef6603" data-dismiss="modal">أنهاء</button>
        
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header"style="background-color:#ef6603">
        <h5 class="modal-title"  id="exampleModalLabel">المناصب</h5>
        
      </div>
      <div class="modal-body text-right">
      تقدير من اللجنة المركزية للتعليم المتميز اثناء فترة وكيل الوزارة ا / محمد سعيد عطية 
تقدير للمشاركة فى الارشاد التعليمى 2015 - 2016
رئاسة كنترولى الشهيد عزت الشافعى والشهيد هشام بركات      
المشاركة فى الكنترو ل المركزى لادارة شرق التعليمية للمرحلة الثانوية
</div>
      <div class="modal-footer">
        <button type="button" class="btn" style="color:#ef6603" data-dismiss="modal">أنهاء</button>
      
      </div>
    </div>
  </div>
</div><!-- End Why Us Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features" dir="ltr">
      <div class="container">

        <ul class="nav nav-tabs row d-flex">
          <li class="nav-item col-3" data-aos="zoom-in">
            <a class="nav-link " data-toggle="tab" href="#tab-1">
              <i class="ri-discuss-line"></i>
              <h4 class="d-none d-lg-block">تناقش مع زملاؤك</h4>
            </a>
          </li>
          <li class="nav-item col-3" data-aos="zoom-in" data-aos-delay="100">
            <a class="nav-link" data-toggle="tab" href="#tab-2">
              <i class="ri-edit-2-line"></i>
              <h4 class="d-none d-lg-block">تدرب على كثير من الأمتحانات </h4>
            </a>
          </li>
          <li class="nav-item col-3" data-aos="zoom-in" data-aos-delay="200">
            <a class="nav-link" data-toggle="tab" href="#tab-3">
              <i class="ri-award-line"></i>
              <h4 class="d-none d-lg-block">أحصل على مهارات جديدة</h4>
            </a>
          </li>
          <li class="nav-item col-3" data-aos="zoom-in" data-aos-delay="300">
            <a class="nav-link active show" data-toggle="tab" href="#tab-4">
              <i class="ri-message-3-line"></i>
              <h4 class="d-none d-lg-block">تواصل مع معلمك</h4>
            </a>
          </li>
        </ul>
      </div>
    </section><!-- End Features Section -->

    <section id="counts" class="counts  section-bg">
      <div class="container">

        <div class="row no-gutters ">

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="bx bx-user-voice"></i>
              <span data-toggle="counter-up">الصوتيات</span>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="bx bx-album"></i>
              <span data-toggle="counter-up">الجرامر</span>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="bx bx-world"></i>
              <span data-toggle="counter-up">الكلمات</span>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
            <div class="count-box">
              <i class="bx bx-book"></i>
              <span data-toggle="counter-up">القراءة</span>
          </div>

        </div>


      </div>
    </section>

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>مميزات المنصة</h2>
          <p>ما توفرة لك المنصة ؟</p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="icon-box" data-aos="zoom-in-left">
              <div class="icon"><i class="las la-video" style="color: #ff689b;"></i></div>
              <h4 class="title"><a href="free.php">الفيديوهات المجانية</a></h4>
              <p class="description">
                الدرس ليس عبارة عن فيديو فقط بل هو عبارة عن موضوع له مرفقات من فيديو وورق شرح وامتحانات جزئية</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mt-5 mt-md-0">
            <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="100">
              <div class="icon"><i class="las la-file-archive" style="color: #e9bf06;"></i></div>
              <h4 class="title"><a href="log.php">الكثير من الملفات</a></h4>
              <p class="description">
                بعد الاطلاع على الدرس ستجد مرفقات للدرس من ملف ورقي تستطيع قرائته وتحميلة</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-5 mt-lg-0 ">
            <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="200">
              <div class="icon"><i class="las la-file-alt" style="color: #3fcdc7;"></i></div>
              <h4 class="title"><a href="log.php">الكثير من المنشورات</a></h4>
              <p class="description">
                عند الدخول للمنصة يوجد الكثير من المنشورات التى تخبرك بكل جديد عن المنصة</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mt-5">
            <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="300">
              <div class="icon"><i class="las la-file" style="color:#41cf2e;"></i></div>
              <h4 class="title"><a href="posts.php">الكثير من المقالات</a></h4>
              <p class="description">
                يوجد الكثير من المقالات التي يمكنك الاطلاع عليها ومناقشة معلمك واصدقائك فيها</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mt-5">
            <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="400">
              <div class="icon"><i class="las la-folder" style="color: #d6ff22;"></i></div>
              <h4 class="title"><a href="log.php">المهمات</a></h4>
              <p class="description">
                عند الدخول للمنصة يوجد الكثير من المهمات التي يجب الاطلاع عليها</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mt-5">
            <div class="icon-box" data-aos="zoom-in-left" data-aos-delay="500">
              <div class="icon"><i class="las la-edit" style="color: #4680ff;"></i></div>
              <h4 class="title"><a href="log.php">الامتحانات الشاملة والجزئية</a></h4>
              <p class="description">
                احرص على اداء جميع الامتحانات الجزيئية الخاصة بالدرس وجميع الامتحانات الشاملة</p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>أخر الأعمال</h2>
          <p>فيديوهات ومقالات مجانية </p>
        </div>

        <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up">
          <li data-filter="*" class="filter-active">جميع الأعمال</li>
          <li data-filter=".filter-app">الفيديوهات</li>
          <li data-filter=".filter-card">المقالات</li>
          <li data-filter=".filter-web">أخرى</li>
        </ul>

        <div class="row portfolio-container" data-aos="fade-up">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-img"><img src="assets/img/1024x1024bb.png" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>مهارات الكتابة</h4>
              <a href="assets/img/1024x1024bb.png" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
              <a href="free.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a> 
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-img"><img src="assets/img/event.png" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>المهام</h4>
              <a href="assets/img/event.png" data-gall="portfolioGallery" class="venobox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
              <a href="log.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-img"><img src="assets/img/reading.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>punctuation</h4>
              <!-- <p>App</p> -->
              <a href="assets/img/reading.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="App 2"><i class="bx bx-plus"></i></a>
              <a href="free.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="assets/img/posts.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>عشرة أسباب تدفعك إلى تعلّم الأنجليزية</h4>
              <!-- <p>Card</p> -->
              <a href="assets/img/posts" data-gall="portfolioGallery" class="venobox preview-link" title="Card 2"><i class="bx bx-plus"></i></a>
              <a href="posts.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-img"><img src="assets/img/190394-OXLSBR-951.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>المنشورات</h4>
              <!-- <p>Web</p> -->
              <a href="assets/img/190394-OXLSBR-951.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
              <a href="log.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-img"><img src="assets/img/1-full.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>Grammar </h4>
              
              <a href="assets/img/1-full.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="App 3"><i class="bx bx-plus"></i></a>
              <a href="free.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="assets/img/exam.png" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>طرق تعلم الأنجليزية</h4>
              
              <a href="assets/img/exam.png" data-gall="portfolioGallery" class="venobox preview-link" title="Card 1"><i class="bx bx-plus"></i></a>
              <a href="posts.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-img"><img src="assets/img/1263522.gif" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>ماهو الفرق بين الإنجليزي الأمريكي والإنجليزي البريطاني؟</h4>
              
              <a href="assets/img/1263522.gif" data-gall="portfolioGallery" class="venobox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>
              <a href="posts.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-img"><img src="assets/img/eqwlb.jpg" class="img-fluid" alt=""></div>
            <div class="portfolio-info">
              <h4>البث المباشر من يوتيوب</h4>
              
              <a href="assets/img/eqwlb.jpg" data-gall="portfolioGallery" class="venobox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
              <a href="log.php" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials" >
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>أراء طلابنا </h2>
          <p>رأى طلابنا ف الشرح</p>
        </div>

        <div class="owl-carousel testimonials-carousel" data-aos="fade-up" dir="ltr">

          <div class="testimonial-item">
            <p>
              <!-- <i class="bx bxs-quote-alt-right quote-icon-right"></i>  -->
              جزيل الشكر مستر سامح عظيم اللغة ... انا بتابع مع طلبة سعادتك ....والله انا لم ارى مدرس لغة انجليزية بهذا الاسلوب المنساب السلس مع كامل احترامى لكل المدرسين المتمكنيين من مهنتهم .. بس انا حبيت طريقة سعادتك جدا ... جزيل الشكر
              <!-- <i class="bx bxs-quote-alt-left quote-icon-left"></i> -->
            </p>
            <img src="assets/img/testimonials/1.png" class="testimonial-img" alt="">
            <h3>أكرامى دعبس</h3>
            <!-- <h4>Ceo &amp; Founder</h4> -->
          </div>

          <div class="testimonial-item">
            <p>
              <!-- <i class="bx bxs-quote-alt-left quote-icon-left"></i> -->
             مسترنا الغالي ربنا يبارك في حضرتك و يجزيك خير علي تعب حضرتك معانا ♥️♥️
              <!-- <i class="bx bxs-quote-alt-right quote-icon-right"></i> -->
            </p>
            <img src="assets/img/testimonials/2.png" class="testimonial-img" alt="">
            <h3>النوسانى</h3>
     
          </div>

          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              شكرآ لحضرتك يا مستر 💖على المجهود الكبير الي بتعملو معانا 👍
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            <img src="assets/img/testimonials/3.png" class="testimonial-img" alt="">
            <h3>Eman Ali</h3>
            
          </div>

          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>ربنا يباركلك يا مستر على مجهود حضرتك معانا ، حضرتك أب ومعلم فاضل ومثل أعلى لنا جزاك الله كل خير
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            <img src="assets/img/testimonials/3.png" class="testimonial-img" alt="">
            <h3>Rodaina Mahmoud</h3>
           
          </div>

          <div class="testimonial-item">
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              ربنا يبارك ف حضرتك ي مستر حقيقي حبينا المادة بسبب حضرتك
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
            <img src="assets/img/testimonials/3.png" class="testimonial-img" alt="">
            <h3>Samyha Ayman</h3>
   
          </div>

        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>الأسئلة الشائعة </h2>
          <p>أسئلة هامة عن المنصة</p>
        </div>

        <ul class="faq-list">

          <li data-aos="fade-up" data-aos-delay="100">
            <a data-toggle="collapse" class="" href="#faq1">قمت بأنشاء حساب ولكن لم أدخل الى المنصه لماذا؟<i class="icofont-simple-up"></i></a>
            <div id="faq1" class="collapse show" data-parent=".faq-list">
              <p>
                بعد انشاء الحساب يرجى الانتظار حتى يقوم المدرس بتفعيلك               </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="200">
            <a data-toggle="collapse" href="#faq2" class="collapsed">لقد تم ألغائى من الدخول بعد شهر لماذا؟<i class="icofont-simple-up"></i></a>
            <div id="faq2" class="collapse" data-parent=".faq-list">
              <p>
                ينتهى تفعيلك بعد شهر يمكنك مراسلة المدرس ليقوم بتفعيلك بعد الدفع
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="300">
            <a data-toggle="collapse" class="collapsed" href="#faq3">هل المنصة للطلبة فقط؟<i class="icofont-simple-up"></i></a>
            <div id="faq3" class="collapse" data-parent=".faq-list">
              <p>
                المنصة لتعليم الأنجليزية لجميع الاعمار وتأهيلهم جيدا           </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="400">
            <a data-toggle="collapse" class="collapsed" href="#faq4">ما الذى تحتوى علية المنصة؟<i class="icofont-simple-up"></i></a>
            <div id="faq4" class="collapse" data-parent=".faq-list">
              <p>
                تحتوى المنصة على دروس وفيديوهات وكتب ومنشورات ومقالات ومهام وبث مباشر وامتحانات شاملة وملفات صوت مسجلة        </p>
            </div>
          </li>
          
          <li data-aos="fade-up" data-aos-delay="500">
            <a data-toggle="collapse" class="collapsed" href="#faq5"> ماهى قيمة الاشتراك بالمنصة؟<i class="icofont-simple-up"></i></a>
            <div id="faq5" class="collapse " data-parent=".faq-list">
              <p>
                يمكنك التواصل مع المدرس  لمعرفه اى قسم تريد  ومنها يتم تحديد قيمة الاشتراك           </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="600">
            <a data-toggle="collapse" class="collapsed" href="#faq6">هل بعد تسجيلى شهر ستختفى عنى الدروس؟<i class="icofont-simple-up"></i></a>
            <div id="faq6" class="collapse " data-parent=".faq-list">
              <p>
                بالطبع لا فى حالة تسجيلك لمدة شهر يمكنك مشاهدة كل ما تم عرضة فى هذا الشهر حتى ولو لم تسجل        </p>
            </div>
          </li>
        </ul>

      </div>
    </section><!-- End F.A.Q Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team ">
      <div class="container">

        <div class="section-title" data-aos="zoom-out">
          <h2>فريق العمل</h2>
          <p>الفريق المسئول عن المنصة </p>
        </div>

        <div class="row justify-content-center ">

          <div class="col-lg-4 col-md-4 d-flex align-items-stretch">
            <div class="member"  style="width: 100%;" data-aos="fade-up">
              <div class="member-img">
                <img src="assets/img/team/Screenshot_٢٠١٦-٠٥-١٨-٢١-١٢-٠٦.png" class="img-fluid" alt="">
                <div class="social">
                  <a href="https://www.facebook.com/Englishforyousirsameh/"><i class="icofont-facebook"></i></a>
                  <a href="https://www.youtube.com/channel/UCR9sSU3IIiNgxTmwDHOzObQ"><i class="icofont-youtube"></i></a>
                  <a href="https://iwtsp.com/201001929178"><i class="icofont-whatsapp"></i></a>
                  <a href="https://www.facebook.com/Samehbahnasy78/"><i class="icofont-facebook"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>مستر / سامح بهنسى</h4>
                <span>معلم لغة أنجليزية</span>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-4 d-flex align-items-stretch">
            <div class="member" style="width: 100%;" data-aos="fade-up" data-aos-delay="100">
              <div class="member-img">
                <img src="assets/img/master.png" class="img-fluid" alt="">
                <div class="social">
                  <a href="https://iwtsp.com/201066343874"><i class="icofont-whatsapp"></i></a>
                  <a href="https://www.facebook.com/MasterC0de"><i class="icofont-facebook"></i></a>
                  <a href="#"><i class="icofont-instagram"></i></a>
                  <a href="#"><i class="icofont-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>ماستر كود</h4>
                <span>التصميم والأعمال البرمجية</span>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section>
    <!-- End Team Section -->
  </main><!-- End #main -->
  <?php 
    include $tpl . 'footer.php'; 
    include $tpl . 'scripts.php'; 
    ob_end_flush();
?>