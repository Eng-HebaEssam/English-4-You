<header id="header" class="fixed-top d-flex align-items-center  header-transparent ">
    <div class="container d-flex align-items-center">
      <nav class="nav-menu d-none d-lg-block">
      <ul style="direction: rtl;">
              <li><a href="logout.php">تسجيل الخروج</a></li>
              <li class="<?php if($pageTitle == 'account'){ echo 'active';}?>"><a href="account.php">الحساب</a></li>
              <li class="<?php if($pageTitle == 'liveyou'){ echo 'active';}?>"><a href="liveyou.php">مباشر يوتيوب</a></li>
              <li class="<?php if($pageTitle == 'events'){ echo 'active';}?>"><a href="events.php">المهام</a></li>
              <li class="<?php if($pageTitle == 'activities'){ echo 'active';}?>"><a href="activities.php">المنشورات</a></li>
              <li class="<?php if($pageTitle == 'posts2'){ echo 'active';}?>"><a href="posts2.php">المقالات</a></li>
              <li class="<?php if($pageTitle == 'main'){ echo 'active';}?>"><a href="main.php">الرئيسية</a></li>
          </ul>
      </nav>
      <div class="logo mr-auto">
        <!-- <h1 class="text-light"><a href="index.html">Selecao</a></h1> -->
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="main.php"><img src="assets/img/140438-OSVA5L-77.png"  width="100px" alt="" class="img-fluid"></a>
      </div><!-- .nav-menu -->

    </div>
  </header>