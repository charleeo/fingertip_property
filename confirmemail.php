<?php
 require_once ("configuration/db_config.php");
 $title = "email confirmation";
 include ('includes/head.php');
?>
</head>
<body>
<div class="wrapper">
<?php
        include ("includes/navbar.php");
?>

<section class="message-for-users" style="--image-url:url(../../assets/images/defaultBcg.jpeg)">
    <div>
        <p>Your account has been succefully created. <br> please check email for  the veerification link for you to access
            your profile details thank.
        </p>
    </div>
</section>
<?php include("includes/footer.php"); ?>
<span id="timer"></span>
    <script src="js/popper.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/mainnavbarjs.js"></script>    
    <script src="js/main.js"></script>

