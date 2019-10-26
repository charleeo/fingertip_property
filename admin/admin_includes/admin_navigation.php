<nav id="leftside">
    <div class="left-content" id="profile">
            <a href="home"> Admin Home</a>
    </div>
    <div class="left-content" id="profile">
            <a href="unpublished_ads"> Unpublished Ads</a>
    </div>
    <div class="left-content" id ="create-ads">
        <a href="published_ads">Published Ads</a>
    </div>
    
    <?php if($_SESSION['admin_role']=='super admin'){ ?>
    <div class="left-content" id ="creat">
        <a href="register">Create New Member</a>
    </div>
    <?php }?>

    <?php if(empty($_SESSION['admin_id'])){ ?>
        <div class="left-content">
            <a href="adminlogin">Login <i class="fas fa-exit"></i></a>
        </div>
    <?php } ?>

    <?php if(!empty($_SESSION['admin_id'])){ ?>
        <div class="left-content">
            <a href="admin_logout">Log out <i class="fas fa-exit"></i></a>
        </div>
    <?php } ?>

</nav>