<?php
    ob_start();
    session_start();
    
    $pageTitle = 'register';
    $Title = 'register';
    if (isset($_SESSION['user'])) {
		header('Location: main.php');
	}
    include 'inital.php';
    include $tpl . 'header.php'; 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (isset($_POST['sign'])) {
        $formErrors = array();
        $token = getToken(10);
        $username 	= filter_var($_POST['username'],FILTER_SANITIZE_STRING);
        $email      = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $password 	= filter_var($_POST['password'],FILTER_SANITIZE_STRING);
        $phone      = filter_var($_POST['phone'],FILTER_SANITIZE_NUMBER_INT);
       $country 	= filter_var($_POST['country'],FILTER_SANITIZE_STRING);
        $city = filter_var($_POST['city'],FILTER_SANITIZE_STRING);
        $phone_2      = filter_var($_POST['phone_2'],FILTER_SANITIZE_NUMBER_INT);
        function get_mac(){
  ob_start(); // Turn on output buffering
  system('ipconfig /all'); //Execute external program to display output
  $mycom=ob_get_contents(); // Capture the output into a variable
  ob_clean(); // Clean the output buffer
   
  $find_word = "Physical";
  $pmac = strpos($mycom, $find_word); // Find the position of Physical text in array
  $mac=substr($mycom,($pmac+36),17); // Get Physical Address
   
  return $mac;
  }
       $MAC =get_mac();

        $class      = $_POST['parent'];
        if (isset($username)) {
            if (strlen($username) < 4) {$formErrors[] = 'اسم المستخدم يجب ان يكون اكبر من 4 احرف';}
        }
        if (isset($password)) {
            if (strlen($password) < 4) {$formErrors[] = 'كلمة المرور يجب ان تكون اكبر من 4 ارقام';}
        }
        if (isset($phone)) {
            if (strlen($phone) < 8) {$formErrors[] = 'رقم الهاتف يجب ان يكون اكبر من 8 ارقام';}
        }
        // Check If There's No Error Proceed The User Add
        if (empty($formErrors)) {
            // Check If User Exist in Database
            $check = checkItem("username", "members", $username);
            if ($check == 1) {
                $formErrors[] = 'هذا المستخدم موجود عليك استخدام اسم مستخدم اخر';
            } else {
                // Insert Userinfo In Database
               $stmt = $con->prepare("INSERT INTO 
								members(username, password, phone, groupid, email, regstatus, date, phone_2, country, city)
										VALUES(:zuser, :zpass, :zphone, :zclass, :zemail, 0, now(), :zphone_2, :zcountry, :city)");
                        $stmt->execute(array(
                        'zuser' => $username,
                        'zpass' => sha1($password),
                        'zphone' => $phone,
                        'zclass' => $class,
                        'zemail' => $email,
                        'zphone_2' => $phone_2,
                        'zcountry' => $country,
                       'city' => $city,
					      ));
                
                // Update user token 
                $ins = $con->prepare("insert into user_token(username,token) VALUES(:zuser, :ztoken)");
                $ins->execute(array(
                    'zuser' 	=> $username,
                    'ztoken'	=> $token
                ));
                // Echo Success Message
                $succesMsg = 'لقد تم تسجيل البيانات قم بتسجيل الدخول';
                header('Location: reg.php');
                exit();
                
            }
        }
      }
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['login'])) {
          $user = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
          $pass = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
          $hashedPass = sha1($pass);
                  $MAC = gethostbyname(trim(`hostname`)); 

          // Check If The User Exist In Database
          $stmt = $con->prepare("SELECT 
                            userid, username, password, only ,regstatus 
                      FROM 
                        members 
                      WHERE 
                        username = ? 
                      AND 
                        password = ?
                    ");
          $stmt->execute(array($user, $hashedPass));
          $get = $stmt->fetch();
          $count = $stmt->rowCount();
                // If Count > 0 This Mean The Database Contain Record About This Username
                if ($count > 0) {
                    if ($get['regstatus'] == 1) {
                        $token = getToken(10);
                        $_SESSION['user'] = $user; // Register Session Name
                        $_SESSION['uid'] = $get['userid']; // Register User ID in Session
                        $_SESSION['token'] = $token;
                        // Update user token 
                        $result_token = $con->prepare("select count(*) as allcount from user_token where username = ? ");
                        $result_token->execute(array($user));
                        $row_token = $result_token->rowCount();
                        if ($row_token > 0) {
                            $mod = $con->prepare("update user_token set token = ? where username = ?");
                            $mod->execute(array($token, $user)); 
                        } else {
                            $ins = $con->prepare("insert into user_token(username,token) VALUES(:zuser, :ztoken)");
                            $ins->execute(array(
                                'zuser' 	=> $user,
                                'ztoken'		=> $token
                            ));
                        }
                        header('Location:main.php'); // Redirect To Dashboard Page
                        exit();
                    } else {
                        $_SESSION['uid'] = $get['userid'];
                        header('Location:free.php'); // Redirect To Dashboard Page
                        exit();
                    }
                } else {
                    $formErrors = array();
                    $formErrors[] = 'خطا بالتسجيل او قمت بتغير الجهاز';
                }
        } 
        }
  }
?>
       
 <section style="background:url('assets/img/55ecc3fc2636d363f0566.jpg') center center; height:400px"id="hero" class="d-flex align-items-center">
    <div class="container text-center position-relative" data-aos="fade-in" data-aos-delay="200">
      <h1 style="font-size:50px;">الدخول للمنصة </h1>
    </div>
</section>
  <div id="main">
    
    <div class="form" >
    <?php 
          if (!empty($formErrors)) {
              foreach ($formErrors as $error) {
                  echo '
                      <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                      ' . $error . '
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
                  ';
              }
          }
          if (isset($succesMsg)) {
              echo '
                  <div class="alert alert-success text-center  alert-dismissible fade show" role="alert">
                      ' . $succesMsg . '
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>';
          }
        ?>
        <ul class="tab-group">
          <li class="tab active"><a href="#signup">أنشاء حساب</a></li>
          <li class="tab"><a href="#login">تسجيل الدخول</a></li>
        </ul>
        
        <div class="tab-content">
          <div id="signup"> 
            <h2 class="text-center mb-3">مرحبا بك</h2> 
            <div class="text-center"><img src="assets/img/register.png" class="p-3" width="100px" height="100px"></div> 
           <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
              <div class="field-wrap">
                <input type="text" required class="username" name="username" placeholder="اسم المستخدم" />
              </div>
              <div class="field-wrap">
                <input type="email"  class="email" name="email" placeholder="البريد الألكترونى " />
              </div>
              <div class="field-wrap">
                <input type="text" class="phone" name="phone" placeholder="رقم هاتف ولى الامر" required/>
              </div>
              <div class="field-wrap">
                <input type="text" class="mt-5" name="phone_2" placeholder="رقم الهاتف الشخصي"/>
              </div>
              <div class="field-wrap">
                <input type="password"required class="password" name="password" placeholder="الرقم السرى"/>
              </div>
              <div class="field-wrap">
                  <select name="country" class="form-control form-control-lg show_btn" style="padding: 4px;" required>
                    <option selected value="كفر الشيخ">كفر الشيخ</option>
                    <option value="الإسكندرية">الإسكندرية</option>
                    <option value="الإسماعيلية">الإسماعيلية</option>
                    <option value="أسوان">أسوان</option>
                    <option value="	أسيوط">	أسيوط</option>
                    <option value="الأقصر">الأقصر</option>
                    <option value="	البحر الأحمر">	البحر الأحمر</option>
                    <option value="	البحيرة">	البحيرة</option>
                    <option value="	بني سويف">	بني سويف</option>
                    <option value="بورسعيد">بورسعيد</option>
                    <option value="جنوب سيناء">جنوب سيناء</option>
                    <option value="الجيزة">الجيزة</option>
                    <option value="الدقهلية">الدقهلية</option>
                    <option value="دمياط">دمياط</option>
                    <option value="سوهاج">سوهاج</option>
                    <option value="	السويس">	السويس</option>
                    <option value="الشرقية">الشرقية</option>
                    <option value="شمال سيناء">شمال سيناء</option>
                    <option value="	الغربية">	الغربية</option>
                    <option value="	الفيوم">	الفيوم</option>
                    <option value="القاهرة">القاهرة</option>
                    <option value="القليوبية">القليوبية</option>
                    <option value="قنا">قنا</option>
                    <option value="	مطروح">	مطروح</option>
                    <option value="المنوفية">المنوفية</option>
                    <option value="المنيا">المنيا</option>
                    <option value="الوادي الجديد">الوادي الجديد</option>
                  </select>
                </div>
               <div class="field-wrap">
                <input type="text"  name="city" placeholder="المركز" />
              </div>
              <div class="field-wrap">
              <select name="parent" class="form-control form-control-lg show_btn" style="padding: 4px;" required>
                  <option selected disabled>الصف الدراسي</option>
                  <?php 
                      $stmt = $con->prepare("SELECT 
                                              category_name, category_id, ordering 
                                              FROM category 
                                              where parent = 0
                                              ");
                      $stmt->execute(array());
                      $rows = $stmt->fetchAll();
                      foreach($rows as $row) {
                  ?>
                  <option value="<?php echo $row['category_id'];?>"><?php echo $row['category_name'];?></option>
                  <?php } ?>
              </select>
              </div>
              <button type="submit"  name="sign" class="button button-block">أنشاء حساب</button>
            </form>
          </div>
          
          <div id="login" style="display:none;">   
            <h2 class="text-center mb-3">مرحبا بك</h2>
            <div class="text-center"><img src="assets/img/login.png" class="p-3" width="100px" height="100px"></div>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
              <div class="field-wrap">
              <input type="text" required name="username" placeholder="اسم المستخدم"/>
            </div>
            
            <div class="field-wrap">
              <input type="password"required name="password" placeholder="كلمة المرور"/>
            </div>
            
            <button class="button button-block mt-4" name="login">تسجيل الدخول</button>
            
            </form>
  
          </div>
          
        </div><!-- tab-content -->
        
  </div> <!-- /form -->

                         
 
<?php 
include $tpl . 'footer.php'; 
include $tpl . 'scripts.php'; 
ob_end_flush();
?>