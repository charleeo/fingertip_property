<?php
 require_once ("configuration/db_config.php");
 
 include ('includes/head.php');
?>
    <title>Document</title>
</head>
<body>
<div class="wrapper">
<?php
        include ("includes/navbar.php");
?>

<section class="message-for-users" style="--image-url:url(../../assets/images/defaultBcg.jpeg)">
    <div>
        <p  style="font-size:30px">
            Please login or register if you  are yet to register in order to access that page
        </p>
    </div>
</section>
<?php include("includes/footer.php"); ?>
<span id="timer"></span>
    <script src="js/popper.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/mainnavbarjs.js"></script>    
    <script src="js/main.js"></script>