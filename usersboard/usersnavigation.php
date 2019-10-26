<?php
  $baseUrl =basename($_SERVER["PHP_SELF"]);
?>
<nav id="leftside">
            <div class='<?php echo (($baseUrl== "dashboard.php")?"active-page": "") ?> left-content' id="profile">
                    <a href="dashboard/<?php echo $_SESSION['user_id']; ?>">Profiles</a>
            </div>

            <div class='<?php echo (($baseUrl== "ads.php")?"active-page": "") ?> left-content' id="create-ads">
                <a href="ads">Create an ad</a>
            </div>
            <div class='<?php echo (($baseUrl== "showpropertytouser.php")?"active-page": "") ?> left-content' id="all-ads">
                <a href="showpropertytouser/<?php echo $_SESSION['user_id'] ?>"
                >View All Ads</a></div>
            <div class="left-content"><a href="logout.php">Log Out </a></div>
</nav>