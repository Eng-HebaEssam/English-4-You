<?php
ob_start();
session_start();
$pageTitle = 'events';
$Title = 'events';
include 'inital.php';
include "check_token.php";
$getUser = $con->prepare("SELECT * FROM members WHERE username = ?");
$getUser->execute(array($sessionUser));
$info = $getUser->fetch();
if (isset($_SESSION['user']) && $info['regstatus'] == 1) { 
    include $tpl . 'header2.php'; 
    $groupid   = $info['groupid'];
    $getposts = $con->prepare("SELECT * FROM events where cat_id = ? AND orders <= ? ORDER BY events_id DESC");
    $getposts->execute(array($groupid,$info['orders']));
    $events = $getposts->fetchAll();
?><!-- End Header -->
 
 <section style="background:url('assets/img/ee9.jpg') center center; height:400px"id="hero" class="d-flex align-items-center">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
      <h1>المهام</h1>
     
  </section>
  <main>
        <!-- ======= event Section ======= -->
    <section id="event" class="event" dir="rtl">
        <div class="container">
  
        <div class="row mb-5">
          <?php foreach($events as $event){ ?>
            <div class="col-lg-6 col-md-6">
              <div class="member">
                <div class="pic"><img src="assets/img/event.png" class="img-fluid" alt=""></div>
                <div class="member-info">
                <?php 
                                    $date    = new DateTime($event['events_date']);
                                    $result  = $date->format('m');
                                    $result2 = $date->format('d');
                                    $result3 = $date->format('Y');
                                    if($result == '01'){$result = 'يناير';}
                                    if($result == '02'){$result = 'فبراير';}
                                    if($result == '03'){$result = 'مارس';}
                                    if($result == '04'){$result = 'ابريل';}
                                    if($result == '05'){$result = 'مايو';}
                                    if($result == '06'){$result = 'يونيو';}
                                    if($result == '07'){$result = 'يوليو';}
                                    if($result == '08'){$result = 'اغسطس';}
                                    if($result == '09'){$result = 'سبتمبر';}
                                    if($result == '10'){$result = 'اكتوبر';}
                                    if($result == '11'){$result = 'نوفمبر';}
                                    if($result == '12'){$result = 'ديسمبر';}
                                ?>
                  <h4><?php echo $event['events_name'];?> </h4>
                  <span> <?php echo $result2. '/' . $result . '/' . $result3 . '   - الساعة (' . $event['events_time'] . ')'  ;?></span>
                  <p><?php echo $event['events_description'];?></p>
                  
                </div>
              </div>
            </div>
            <?php } ?>
  
        </div>
        </div>
    </section>
  </main>
  
        <?php
include $tpl . 'footer.php'; 
include $tpl . 'scripts.php'; 
} else {
    header('Location: index.php');
    exit();
}
ob_end_flush();
?>