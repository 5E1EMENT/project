<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>3d Model</title>

    <!-- Styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/fonts.css" rel="stylesheet">
    <link href="css/media.css" rel="stylesheet">
    <link href="css/modal.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
   <a href="/">
        <img src="img/home-icon-silhouette.svg" class="mainscreen-logo">
    </a>
   <a href="/pages/field/field.php">
       <img src="img/reply.svg" class="mainscreen-logo-arrow">
   </a>
  <div class="wrapper">
    <h1 class="title">3d Модель</h1>
    </div>
    <div class="container">
        <?php
        require_once '../php/model.php';
        ?>
    </div>



   <div class="div"></div>
   <!-- Preloader -->
   <div class="loading-area">
   <div class="loading-box"><h2 class="loading-area__text">3D модель строится</h2></div>
   <div class="loading-pic">
       <div class="loader">
           <span class="block-1"></span>
           <span class="block-2"></span>
           <span class="block-3"></span>
           <span class="block-4"></span>
           <span class="block-5"></span>
           <span class="block-6"></span>
           <span class="block-7"></span>
           <span class="block-8"></span>
           <span class="block-9"></span>
           <span class="block-10"></span>
           <span class="block-11"></span>
           <span class="block-12"></span>
           <span class="block-13"></span>
           <span class="block-14"></span>
           <span class="block-15"></span>
           <span class="block-16"></span>
       </div>
   </div>
   </div>
   <div id="scene"></div>
    <!--Main  scripts-->
   <script
           src="http://code.jquery.com/jquery-3.3.1.min.js"
           integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
           crossorigin="anonymous"></script>

   <script src="js/mymodal.js"></script>
   <script src="js/three.js"></script>
   <script src="js/Detector.js"></script>
   <script src="js/Stats.js"></script>
   <script src="js/OrbitControls.js"></script>
   <script src="js/OrbitControls-Touch.js"></script>
   <script src="js/THREEx.KeyboardState.js"></script>
   <script src="js/THREEx.FullScreen.js"></script>
   <script src="js/THREEx.WindowResize.js"></script>
   <script src="https://cdn.rawgit.com/mrdoob/three.js/master/examples/js/controls/OrbitControls.js"></script>

   <script src="js/model.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- <script src="js/mymodal.js"></script>-->

  </body>
</html>