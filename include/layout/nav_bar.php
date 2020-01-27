  <?php $page=$site->get_back_page_url(); ?>
  <nav class="navbar navbar-default navbar-fixed-top navbar_style" style="">

  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <b class="navbar-brand nav_logo"><strong style="color: #ffffff;">EWU Online Judge</strong></b>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    <div class="nevbar_fontstyle">
      <ul class="nav navbar-nav navbar-left">
        <li class="li_nav"><a class="navbar_btn" style="color: #ced6e0;"  href="index.php">HOME</a></li> 
        <li class="li_nav"><a class="navbar_btn" style="color: #ced6e0;"  href="contest_list.php">CONTEST</a></li> 
        <li class="li_nav"><a class="navbar_btn" style="color: #ced6e0;" href="problems.php">PROBLEMS</a></li>
        <li class="li_nav"><a class="navbar_btn" style="color: #ced6e0;" href="judge_status.php">JUDGE STATUS</a></li>
        <li class="li_nav"><a class="navbar_btn" style="color: #ced6e0;" href="rank_list.php">RANK LIST</a></li>
        <li class="li_nav"><a class="navbar_btn" style="color: #ced6e0;" href="about.php">ABOUT</a></li>
        
      </ul>
       <ul class="nav navbar-nav navbar-right">
        <?php if(!$isLoggedIn){ ?>
          <li><a class="navbar_style2" style="color: #ced6e0;" href="register.php?back=<?php echo $page; ?>"><i class='fas'>&#xf234;</i> REGISTER</a></li>
          <li><a class="navbar_style2" style="color: #ced6e0;" href="login.php?back=<?php echo $page; ?>"><span class="glyphicon glyphicon-log-in"></span> LOGIN</a></li>
        <?php } else{ ?>
            <li><a class="navbar_style2" style="color: #ced6e0;" href="logout.php?back=<?php echo $page; ?>"><span class="glyphicon glyphicon-log-in"></span> LOGOUT</a></li>
        <?php } ?>

      </ul>
      </div>
    </div>
  </div>
</nav>
  <!-- Main navigation bar end -->
<style>
  .navbar-login
{
    width: 280px;
    padding: 10px;
    padding-bottom: 0px;
}


.navbar-nav>li:hover{
    color: #000000;
    background-color: #414b59;
}
.navbar_body{
  background-color: #0A3D62;
  padding: 15px;
  align-content: center;
}
.navbar-login-session
{
    
    padding: 20px;
    padding-bottom: 0px;
    padding-top: 0px;

}

.icon-size
{
    font-size: 87px;
}


   
</style>