<?php
include("functions.php");
connect();

include_once("analyticstracking.php");

if(isset($_SESSION['uidtrw'])){
        include("safe.php"); }

?>
<html>




    
    














    <head>
        <title>Realpolitik - a multiplayer political simulation game</title>
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <link rel="shortcut icon" href="/favicon.ico" type="image/ico">
        <link rel="shortcut icon" type="image/ico" href="http://www.bloc.name/favicon.ico" />
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <script src="policyjsdomestic.js"></script>
         <script src="policyjseconomic.js"></script>
          <script src="policyjsmarket.js"></script>
           <script src="policyjsmilitary.js"></script>
        
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script src="http://code.jquery.com/jquery.js"></script>
        
        
        <script src="bootstrap/js/bootstrap.min.js"></script>

        <!-- U1q8lndk0GRVaRVCQ029_iwoEO0 -->

        <script>
            jQuery(function ($) {
                $("a").tooltip()
            });
            
            $('#myTab a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
})
        </script>
        
        
        
    </head>
    
     <?php
    if(isset($_SESSION['uidtrw'])){
        include("safe.php");



    $messagelist= mysql_query("SELECT `id` FROM `message` WHERE `recieve`='".$_SESSION['uidtrw']."' ORDER BY `id` DESC");
 $nummessage=mysql_num_rows($messagelist);
 
 $messagelist= mysql_query("SELECT `id` FROM `pressrelease` WHERE `region`='".$nation['subregion']."' ORDER BY `id` DESC");
 $nummessageregional=mysql_num_rows($messagelist);
 
  $messagelist= mysql_query("SELECT `id` FROM `pressrelease` WHERE `region`='' AND `alliance`='0' AND `superpower`='' AND `freemarket`='0' ORDER BY `id` DESC");
 $nummessageglobal=mysql_num_rows($messagelist);
 
 $messagelist= mysql_query("SELECT `id` FROM `pressrelease` WHERE `freemarket`='1' ORDER BY `id` DESC");
 $nummessagefreemarket=mysql_num_rows($messagelist);
 
  $messagelist= mysql_query("SELECT `id` FROM `pressrelease` WHERE `align`='".$nation['align']."' ORDER BY `id` DESC");
 $nummessagealign=mysql_num_rows($messagelist);
 
 $messagelist= mysql_query("SELECT `id` FROM `pressrelease` WHERE `alliance`='".$nation['alliance']."' ORDER BY `id` DESC");
 $nummessagealliance=mysql_num_rows($messagelist);
 
 if($user['corporation']!='0'){
   $messagelist= mysql_query("SELECT `id` FROM `pressrelease` WHERE `conglomerate`='".$corporation['conglomerate']."' ORDER BY `id` DESC");
 $nummessageconglomerate=mysql_num_rows($messagelist);  
 }

 
    $newslist= mysql_query("SELECT `id` FROM `news` WHERE `recieve`='".$_SESSION['uidtrw']."'");
$numnews=mysql_num_rows($newslist);



?>


    
    <div id="header">
    
    <?php
    
    if($user['superpower']=='' && $user['faction']=='0'){
    
     ?>
    
    <a type="button" class="btn btn-default" style="background-color: transparent; border-color: transparent; margin-top: 1px;" href="main.php">
    <table style="background-color: transparent;"><tr><td><?php
    
    
    
        $customflag=$cosmetic['cflag'];

                    if($cosmetic['cflag']!=""){echo "<img width=\"50\" src=\"http://i.imgur.com/$customflag\">" ;}else{ ?> <img width="50" src="flags/<?php echo $cosmetic['flag']; ?>"> <?php } ?>
        </td><td style="padding: 1px; padding-right: 5px;"><b><div style="color:white;"><?php echo $nation['nationname']; ?></div></b></td></tr></table>
    </a>
    
    <?php }elseif($user['faction']=='1'){
        
    ?>
    
    <a type="button" class="btn btn-default" style="background-color: transparent; border-color: transparent; margin-top: 1px;" href="main.php">
    <table style="background-color: transparent;"><tr><td><?php
    
    
    
        $customflag=$cosmetic['cflag'];

                    if($cosmetic['cflag']!=""){echo "<img width=\"50\" src=\"http://i.imgur.com/$customflag\">" ;}else{ ?> <img width="50" src="flags/<?php echo $cosmetic['flag']; ?>"> <?php } ?>
        </td><td style="padding: 1px; padding-right: 5px;"><b><div style="color:white;"> <?php echo $faction['name']; ?></div></b></td></tr></table>
    </a>
    
    <?php    
        
        
        
        
        
        
        
        
    }else{
        
        ?>
        
        <a type="button" class="btn btn-default" style="background-color: transparent; border-color: transparent; margin-top: 1px;" href="main.php">
    <table style="background-color: transparent;"><tr><td><?php
    
    
    
        $customflag=$cosmetic['cportrait'];

                    if($cosmetic['cportrait']!=""){echo "<img height=\"35\" src=\"http://i.imgur.com/$customflag\">" ;} ?>
        </td><td style="padding: 1px; padding-right: 5px;"><b><div style="color:white;"><?php echo $user['username']; ?></div></b></td></tr></table>
    </a>
        
       <a type="button" class="btn btn-default" style="background-color: transparent; border-color: transparent; margin-top: 1px;" href="superpower.php?superpower=<?php echo $user['superpower'] ?>">
    <table style="background-color: transparent;"><tr><td><?php
    
    
    
        $flag=$user['superpower'];

        echo "<img width=\"50\" src=\"flags/$flag.png\">" ?>
        </td><td style="padding: 1px; padding-right: 5px;"><b><div style="color:white;"><?php echo $user['superpower']; ?></div></b></td></tr></table>
    </a> 
        
        <?php
        }
        
        ?>
    
    
    <div class="btn-group" style="margin-top: 1px; background-color:black">
    <div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
      Communiques  <?php if($nummessage>0 ){ echo "<span class=\"badge\">".$nummessage."</span>";} ?>
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <li><a href="messages.php">Received</a></li>
      <li><a href="messages.php?to=yes">Sent</a></li>
    </ul>
  </div>
    
    
  <a href="nnews.php" class="btn btn-default">News <?php if($numnews>0){echo "<span class=\"badge\">".$numnews."</span>";} ?></a>
  <?php if($user['superpower']=='' && $user['faction']=='0' AND $user['corporation']=='0'){ ?>
  <div class="btn-group">
    <div class="dropdown">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Policies <b class="caret"></b></button>
        <ul class="dropdown-menu">
          <li><a href="economics.php">Economic</a></li>
          <li><a href="domestic.php">Domestic</a></li>
          <li><a href="foreign.php">Foreign</a></li>
          <li><a href="military.php">Military</a></li>
          <li><a href="market.php">Market</a></li>
        </ul>
      </div>
  </div>
  <?php }elseif($user['corporation']=='1'){
    ?> 
    <a href="market.php" class="btn btn-default">Market</a>
    <?php
  } ?>
  <div class="btn-group">
    <div class="dropdown">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><img  src="globe.png" width="16">  The World <b class="caret"></b></button>
        <ul class="dropdown-menu">
        <li><a href="map.php">World Map</button></a></li>
        <?php 
        
          if($nation['subregion']=="Caribbean"){$regionpage="car";}
    elseif($nation['subregion']=="Gran Colombia"){$regionpage="gra";}
    elseif($nation['subregion']=="Southern Cone"){$regionpage="con";}
    elseif($nation['subregion']=="Amazonia"){$regionpage="ama";}
    elseif($nation['subregion']=="Mesoamerica"){$regionpage="mex";}
    elseif($nation['subregion']=="West Africa"){$regionpage="waf";}
    elseif($nation['subregion']=="Atlas"){$regionpage="atl";}
    elseif($nation['subregion']=="China"){$regionpage="chi";}
    elseif($nation['subregion']=="Pacific Rim"){$regionpage="pac";}
    elseif($nation['subregion']=="The Subcontinent"){$regionpage="sub";}
    elseif($nation['subregion']=="East Indies"){$regionpage="ind";}
    elseif($nation['subregion']=="Indochina"){$regionpage="sea";}
    elseif($nation['subregion']=="Persia"){$regionpage="per";}
    elseif($nation['subregion']=="Arabia"){$regionpage="ara";}
    elseif($nation['subregion']=="Egypt"){$regionpage="egy";}
    elseif($nation['subregion']=="Guinea"){$regionpage="gui";}
    elseif($nation['subregion']=="East Africa"){$regionpage="eaf";}
    elseif($nation['subregion']=="Congo"){$regionpage="congo";}
    elseif($nation['subregion']=="Southern Africa"){$regionpage="saf";}
    elseif($nation['subregion']=="Mesopotamia"){$regionpage="mes";}
        
        ?>
        <?php if($user['superpower']=='' && $user['faction']=='0'&& $user['corporation']=='0'){ ?>  <li><?php echo"<a href=\"regionaldiscussion.php?subregion=".$regionpage."\">Regional Discussion"; if($nummessageregional>0 ){ echo " <span class=\"badge\">".$nummessageregional."</span>";} ?></a></button></li> <?php } ?>
         <li><a href="globaldeclarations.php">Global Declarations <?php if($nummessageglobal>0 ){ echo " <span class=\"badge\">".$nummessageglobal."</span>";} ?></button></a></li>
         <li><a href="freemarket.php">Free Market <?php if($nummessagefreemarket>0 ){ echo " <span class=\"badge\">".$nummessagefreemarket."</span>";} ?></button></a></li>
      
      <?php if($nation['align']=='1'){
        ?>
        <li><a href="alignchat.php">Eastern Bloc <?php if($nummessagealign>0 ){ echo " <span class=\"badge\">".$nummessagealign."</span>";} ?></button></a></li>
        <?php
      }elseif($nation['align']=='2'){
        ?>
        <li><a href="alignchat.php">Non-Aligned <?php if($nummessagealign>0 ){ echo " <span class=\"badge\">".$nummessagealign."</span>";} ?></button></a></li>
        <?php
      }elseif($nation['align']=='3'){
        ?>
        <li><a href="alignchat.php">The West <?php if($nummessagealign>0 ){ echo " <span class=\"badge\">".$nummessagealign."</span>";} ?></button></a></li>
        <?php
      } ?>
      
      <li><a href="rankings.php">Nations</button></a></li>
      <li><a href="factionrankings.php">Factions</button></a></li>
      <li><a href="corporaterankings.php">Corporations</button></a></li>
      
       <li><a href="superpower.php?superpower=UN">The United Nations</button></a></li>
     <!-- <li><a href="superpower.php?superpower=USSR">The Soviet Union</button></a></li>
      <li><a href="superpower.php?superpower=US">The United States</button></a></li> -->
     <li><a href="news.php">News And Statistics</button></a></li>
        </ul>
      </div>
  </div>
  
  <div class="btn-group">
    <div class="dropdown">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> Organizations <b class="caret"></b></button>
        <ul class="dropdown-menu">
        
        <?php 
        
        $alliance=$nation['alliance'];
        
        if($alliance!='0' && $user['faction']!='1' && $user['corporation']!='1'){
        
        ?>
         <li><?php echo"<a href=\"alliancestats.php?allianceid=".$alliance."\">Your Alliance</a>"; ?></button></li>
         <li><?php echo"<a href=\"alliancediscussion.php?allianceid=".$alliance."\">Alliance Chat"; if($nummessagealliance>0){ echo " <span class=\"badge\">".$nummessagealliance."</span>";} ?></a></button></li>
       <?php  }   ?>
          <li><a href="alliancerankings.php">Alliance Rankings</button></a></li>
          
          <?php 
        
        $conglomerate=$corporation['conglomerate'];
        
        if($conglomerate!='0' && $user['faction']!='1' && $user['corporation']!='0'){
        
        ?>
         <li><?php echo"<a href=\"conglomeratestats.php?conglomerateid=".$conglomerate."\">Your Conglomerate</a>"; ?></button></li>
         <li><?php echo"<a href=\"conglomeratediscussion.php?conglomerateid=".$conglomerate."\">Conglomerate Chat"; if($nummessageconglomerate>0){ echo " <span class=\"badge\">".$nummessageconglomerate."</span>";} ?></a></button></li>
       <?php  }   ?>
          <li><a href="conglomeraterankings.php">Conglomerate Rankings</button></a></li>
          
        </ul>
      </div>
  </div>
  
  
  <div class="btn-group">
    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
      Community
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      
          <li><a href="http://blocgame.com/forums/index.php">Forums</a></li>
    </ul>
  </div>
</div></div>
    
    
      
      <!-- IMPORTANT CENTER FOR EVERYTHING FUCKFACKFACE-->
      <!-- IMPORTANT CENTER FOR EVERYTHING FUCKFACKFACE-->
      <center>
    <!-- IMPORTANT CENTER FOR EVERYTHING FUCKFACKFACE--><!-- IMPORTANT CENTER FOR EVERYTHING FUCKFACKFACE-->
    
    
    



    <?php
    


        }
        
        ?>
    
    
    
    
    

    <body>
    
            <?php

 if(isset($_SESSION['uidtrw'])){  }else{
            ?>
            
            
            
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span><div style="color: white;">LOGIN</div>
    </button>
    <a class="navbar-brand" href="#"></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <form class="navbar-form navbar-left"  action="login.php" method="post">
        <div class="form-group">
          <li><input type="text" class="form-control" name="username" placeholder="Username"></li></div>
          <div class="form-group"><li><input type="password" name="password" class="form-control" placeholder="Password"></li>
        </div>
        <button type="submit" name="login" class="btn btn-default">Login</button>
      </form>
    
    </ul>
     
    <ul class="nav navbar-nav navbar-right">
    <li><a href="recover.php"><button class="btn btn-default btn-sm">Recover Password</button></a></li>
     <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><button class="btn btn-default btn-sm">Community <b class="caret"></b></button></a>
        <ul class="dropdown-menu">
          <li><a href="http://blocgame.com/eregime/index.php">Forums</a></li>
          
        </ul>
      </li>
      <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><button class="btn btn-default btn-sm"><img  src="globe.png" width="18">  The World <b class="caret"></b></button></a>
      <ul class="dropdown-menu">
      <li><a href="map.php">World Map</a></li>
      <li><a href="rankings.php">World Rankings</a></li>
      <li><a href="news.php">World News</a></li>
      </ul>
      </li>
    </ul>
    
  </div><!-- /.navbar-collapse -->
</nav>
</div></div>
<!-- IMPORTANT CENTER FOR EVERYTHING FUCKFACKFACE-->
      <!-- IMPORTANT CENTER FOR EVERYTHING FUCKFACKFACE-->
      <center>
    <!-- IMPORTANT CENTER FOR EVERYTHING FUCKFACKFACE--><!-- IMPORTANT CENTER FOR EVERYTHING FUCKFACKFACE-->

        <?php
        
        

            } ?>
            
            
            
            
            
            
          <style>
          
          #con_div {
    margin-top: 63px;
    margin-bottom: 60px;
   background-color: rgba(20, 20, 20, 0.90);
   color:white;
   width:100%;
   bottom: 100%;
   border-radius: 15px;
   font-size: 13pt;
   z-index:3;
    }

#content {
    overflow-y:auto
   
   
}
          
          </style>  
            
            
            
    <div style="margin-top: 63px;
    margin-bottom: 60px;
   background-color: rgba(20, 20, 20, 0.90);
   color:white;
   width:100%;
   bottom: 100%;
   border-radius: 15px;
   font-size: 13pt;
   z-index:3;"> <div id="overflow-y:auto">
   
            
            
            
            
            
            
            
     <!--<center><div class="alert alert-error">
  BLOC is transferring to a new and significantly better server! However, there is a significant chance any action taken while this alert is up will not be saved.
</div></center>-->
    