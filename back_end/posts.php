<?php
    ob_start();
    if(!isset($_SESSION)){session_start();} 
    $pageTitle = 'posts';
    $Title = 'posts';
    if (isset($_SESSION['user'])) {
		header('Location: main.php');
	}
    include 'inital.php';
    include $tpl . 'header.php';   
?><!-- End Header -->
 
  <section style="background:url('assets/img/55ecc3fc2636d363f0566.jpg') center center; height:400px"id="hero" class="d-flex align-items-center">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
      <h1 style="font-size:50px;">المقالات</h1>
      
    </div>
  </section>
  <main>
    <section id="blog" class="blog">
        <div class="container">
  
          <div class="row">
  
            <div class="col-lg-8 entries">
              <article class="entry" data-aos="fade-up">
  
                <div class="entry-img">
                  <img src="assets/img/panoramic-view-big-ben-london-sunset-uk_268835-1401.jpg" alt="main" class="img-fluid" width="100%">
                </div>
  
                <h2 class="entry-title">
                  <a href="log.php">عشرة أسباب تدفعك إلى تعلّم الأنجليزية</a>
                </h2>
  
                <div class="entry-meta">
                  <ul>
                    <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="log.php"> مستر سامح بهنسى</a></li>
                    <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="log.php"><time datetime="2020-01-01">  15 يونيو 2021 </time></a></li>
                  </ul>
                </div>
                <div class="entry-content">
                  <p>
                    1- اللغة الإنجليزيّة هي إحدى أكثر اللغات المحكيّة انتشارًا
                    <br>2- تفتحُ اللغة الإنجليزيّة أبواب الفرص أمامك
                    <br>3- ستجعلُ اللغةُ الإنجليزيّة منك شخصًا مرغوبًا فيه من قبلِ أربابِ العمل
                </p>
                  <div class="read-more">
                    <a href="log.php">المزيد</a>
                  </div>
                </div>
  
              </article><!-- End blog entry -->
              <article class="entry" data-aos="fade-up">
  
                <div class="entry-img">
                  <img src="assets/img/Penggunaan-at-least-1536x864.jpg" alt="" class="img-fluid">
                </div>
  
                <h2 class="entry-title">
                  <a href="log.php">طرق تعلم الأنجليزية</a>
                </h2>
  
                <div class="entry-meta">
                  <ul>
                    <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="log.php">  مستر سامح بهنسى </a></li>
                    <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="log.php"><time datetime="2020-01-01"> 15 يونيو 2021</time></a></li>
                  </ul>
                </div>
  
                <div class="entry-content">
                  <p>
    هل ترغب في تعلّم اللغة الإنجليزية ؟ هل تواجه صعوبة في العثور على طريقة مناسبة تختصر عليك الجهد والوقت؟ هل مللت من الحصص الدراسية التقليدية التي قد لا تعطيك نتائج مرضية؟ إن كانت إجابتك عن الأسئلة السابقة هي "نعم" فأنت في المكان الصحيح! قد يغفل الكثيرون عن أهميّة تعلّم لغات أخرى غير لغتهم الأم، متجاهلين حقيقة أنّ التعامل مع ثقافة أخرى يسهم في فهم ثقافتهم الخاصة تصفح موقعنا  
                  </p>
                  <div class="read-more">
                    <a href="log.php">المزيد</a>
                  </div>
                </div>
  
              </article><!-- End blog entry -->
              <article class="entry" data-aos="fade-up">
  
                <div class="entry-img">
                  <img src="assets/img/maxresdefault.jpg" alt="" class="img-fluid">
                </div>
  
                <h2 class="entry-title">
                  <a href="log.php">ماهو الفرق بين الإنجليزي الأمريكي والإنجليزي البريطاني؟</a>
                </h2>
  
                <div class="entry-meta">
                  <ul>
                    <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="log.php">  مستر سامح بهنسى  </a></li>
                    <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="log.php"><time datetime="2020-01-01">  15 يونيو 2021 </time></a></li>
                  </ul>
                </div>
  
                <div class="entry-content">
                  <p>
                    هل أنت من أولئك الذين يعتقدون أنّ اللغة الإنجليزية البريطانية والأمريكية متماثلتان ولا تختلفان سوى في طريقة لفظ بعض الكلمات؟ إن كنت تفعل، فنأسفُ للقول بأنّك مخطئ في اعتقادك هذا...لأنّ هنالك اختلافات أكبر من مجرّد طريقة اللفظ. لكن لا تقلق، فهما في النهاية تبقيان لغة واحدة، والاختلافات بينهما ليست جذرية أو عميقة جدًا، ومع نهاية هذا المقال، ستكون أكثر قدرة على التمييز بين اللهجتين، البريطانية والأمريكية.
                  </p>
                  <div class="read-more">
                    <a href="log.php">المزيد</a>
                  </div>
                </div>
  
              </article><!-- End blog entry -->
            </div><!-- End blog entries list -->
  
            <div class="col-lg-4">
              <div class="sidebar text-right" data-aos="fade-left">
                <h3 class="sidebar-title">اخر المقالات</h3>
                <div class="sidebar-item recent-posts">
                  <div class="post-item clearfix">
                    <img src="assets/img/maxresdefault.jpg" alt="">
                    <h4><a href="log.php">ماهو الفرق بين الإنجليزي الأمريكي والإنجليزي البريطاني؟</a></h4>
                    <time datetime="2020-01-01">15 يونيو 2021</time>
                  </div>
                  <div class="post-item clearfix">
                    <img src="assets/img/Penggunaan-at-least-1536x864.jpg" alt="">
                    <h4><a href="log.php">طرق تعلم الأنجليزية</a></h4>
                    <time datetime="2020-01-01">15 يونيو 2021</time>
                  </div>
                  <div class="post-item clearfix">
                    <img src="assets/img/panoramic-view-big-ben-london-sunset-uk_268835-1401.jpg" alt="">
                    <h4><a href="log.php">10 أسباب لتعلم الأنجليزية</a></h4>
                    <time datetime="2020-01-01">15 يونيو 2021</time>
                  </div>
                </div>
                <hr>
                <h3 class="sidebar-title">اخر المنشورات</h3>
                <div class="sidebar-item recent-posts">
                  <div class="post-item clearfix">
                    <img src="assets/img/eqwlb.jpg" alt="">
                    <h4><a href="log.php">موعد البث المباشر</a></h4>
                    <time datetime="2020-01-01">20 يونيو 2021</time>
                  </div>
                  
                  <div class="post-item clearfix">
                    <img src="assets/img/fridge-poetry-csb13-4276731632_cdc550dea8_o.jpg" alt="">
                    <h4><a href="log.php">اختبار تسميع للكلمات</a></h4>
                    <time datetime="2020-01-01">25 يونيو 2021</time>
                  </div>
                </div>
              </div><!-- End sidebar -->
            </div><!-- End blog sidebar -->
          </div>
        </div>
      </section>
  </main>
  <?php 
    include $tpl . 'footer.php'; 
    include $tpl . 'scripts.php'; 
    ob_end_flush();
?>