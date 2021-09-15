<?php
    ob_start();
    if(!isset($_SESSION)){session_start();} 
    $pageTitle = 'contactus';
    $Title = 'contactus';
    if (isset($_SESSION['user'])) {
		header('Location: main.php');
	}
    include 'inital.php';
    include $tpl . 'header.php';   
?>
 <section style="background:url('assets/img/55ecc3fc2636d363f0566.jpg') center center; height:400px"id="hero" class="d-flex align-items-center">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
      <h1 style="font-size:50px;">تواصل معنا </h1>
    </div>
  </section>
  <main>
<!-- ======= Contact Section ======= -->
<div class="map-section mt-2">
        <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d638578.8656879187!2d30.85574933025395!3d30.795411189402884!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2seg!4v1603370690272!5m2!1sar!2seg" frameborder="0" allowfullscreen></iframe>
    </div>
<section id="contactus" class="contactus" >
    <div class="container" data-aos="fade-up">
        <div class="section-title" data-aos="zoom-out">
            <h2>تواصل معنا </h2>
            <p>يشرفنا تواصلكم ويسعدنا خدمتكم</p>
        </div>
        <div class="row">
        <?php
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              
              $username 	= filter_var($_POST['username'], FILTER_SANITIZE_STRING);
              $email 	    = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
              $comment 	  = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
              if (! empty($comment)) {
                  $stmt = $con->prepare("INSERT INTO 
                      message(message, username, email, date)
                      VALUES(:message, :username, :email, NOW())");
                  $stmt->execute(array(
                      'message'   => $comment,
                      'username'  => $username,
                      'email'     => $email
                  ));
                  if ($stmt) {
                      echo '<div style="width:100%" class="alert alert-success text-center alert-dismissible fade show" role="alert" id="alert-message">
                              تم ارسال الرسالة بنجاح
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>';
                  }
              } else {
                  echo '<div style="width:100%" class="alert alert-warning alert-dismissible text-center fade show" role="alert" id="alert-message">
                          يجب عليك اضافة الرساله
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>';
              }
          }
        ?>  
        </div>
        <div class="row" dir="rtl">  
          <div class="col-lg-6">

            <div class="row">
              <div class="col-md-12">
                <div class="info-box">
                  <i class="bx bx-map"></i>
                  <h3>العنوان</h3>
                  <p>كفر الشيخ</p>
                </div>
              </div>
              <div class="col-md-12">
                <div class="info-box mt-4">
                  <i class="bx bx-envelope"></i>
                  <h3>راسلنا </h3>
                  <p>01001929178</p>
                </div>
              </div>
              <div class="col-md-12">
                <div class="info-box mt-4">
                  <i class="bx bx-phone-call"></i>
                  <h3>اتصل بنا </h3>
                  <p>01001929178</p>
                </div>
              </div>
            </div>

          </div>
          <div class="col-lg-6 mt-5 mt-lg-0">
            <form action="#contactus" method="POST" class="php-email-form">
                <div class=" form-group">
                  <input type="text" name="username" class="form-control" id="name" required placeholder="الأسم"/>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" id="email" required placeholder="البريد الألكترونى"  />
                </div>
              <div class="form-group">
                <textarea class="form-control" name="message"  rows="5" required placeholder="الرسالة"></textarea>
              </div>
              <div class="text-center"><button type="submit">أرسال</button></div>
            </form>
          </div>
        </div>
    </div>
  </section>
</main>
<?php 
    include $tpl . 'footer.php'; 
    include $tpl . 'scripts.php'; 
    ob_end_flush();
?>