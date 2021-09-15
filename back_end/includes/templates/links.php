<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>English 4 You</title>
  <meta content="" name="description" content="موقع الاستاذ سامح بهنسى لتعليم الأنجليزية">
    <meta content="" name="keywords" content="سامح بهنسى, لغة أنجليزية, english 4 you, master code">

  <!-- Favicons -->
  <link href="assets/img/favicon.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/line-awesome/css/line-awesome.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <?php 
        if($pageTitle == 'main'){
            echo '<link rel="stylesheet" href="assets/css/main_content.css">';
        }
        if($pageTitle == 'exam'){
            echo '
                <link rel="stylesheet" href="assets/css/main_content.css">
                <link rel="stylesheet" href="assets/css/countdown-lights.css">
            ';
        }
        if($pageTitle == 'posts2'){
            echo '
                <link rel="stylesheet" href="assets/css/forms.css">
            ';
        }
        if($pageTitle == 'postcontent'){
            echo '
                <link rel="stylesheet" href="assets/css/posts.css">
            ';
        }
        if($pageTitle == 'activities'){
            echo '
                <link rel="stylesheet" href="assets/css/posts.css">
                <link rel="stylesheet" href="assets/css/forms.css">
            ';
        }
        if($pageTitle == 'account'){
            echo '
            <link rel="stylesheet" href="assets/css/main_content.css">
            <link rel="stylesheet" href="assets/css/forms.css">
            ';
        }
        if($pageTitle == 'coursecontent' ||  $pageTitle == 'lesson'){
            echo '
            <link rel="stylesheet" href="assets/css/main_content.css">
            ';
        }
        
    ?>


</head>
<body dir="rtl">