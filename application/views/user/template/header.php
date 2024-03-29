<?php
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" content="width=device-width, initial-scale=1" name="viewport" >
	<title>Honor Flight - User</title>

  <?php 
    
    if(isset($_SESSION["userPerm"])) {
      // display this page
      // makes sure you aren't logged in
    }
    else {
      redirect("");
    }
  ?>

<!-- Loads in Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.css')?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap-grid.css')?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap-reboot.css')?>" />
<!-- Loads in Jquery and Bootstrap -->
<script src="<?php echo base_url('assets/internal/js/jquery-3.5.1.js')?>"> </script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.js')?>"> </script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.js')?>"> </script>
<!-- Loads in Font awsome icons -->
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<!-- Loads in internal CSS and JS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets\internal\css\internal.css')?>" />
<script src="<?php echo base_url('assets\internal\js\internal.js')?>"> </script>
<!-- Loads in Datatables library -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/DataTables/datatables.css')?>" />
<script src="<?php echo base_url('assets/DataTables/datatables.js')?>"> </script>

</head>
<body>
<!-- User nav -->
<div class="nav-side-menu">
        <div class="brand"><img style="padding-top:10px;" src="<?php echo base_url('assets/internal/img/logo.png')?>" alt="Rochester Honor Flight"> </div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
    
            <div class="menu-list">
    
                <ul id="menu-content" class="menu-content collapse out">
                    <li id = "home" onclick="location.href='<?php echo base_url('user'); ?>'"> <a><i class="fa fa-home fa-lg"></i> Home Page </a> </li>

                    <li id = "teams" data-toggle="collapse" data-target="#products" class="collapsed">
                    <a href="#"><i class="fa fa-list fa-lg"></i> Teams <span class="arrow"></span></a>
                    </li>
                    <ul class="sub-menu collapse" id="products">
                    <?php foreach ($allTeams as $team): ?>
                        <li onclick="location.href='<?php echo base_url('vetList'. '/'. $team->team_id); ?>'"><a><?php echo $team->color ?></a></li>

                        <?php endforeach; ?>
                    </ul>
                    
                    <?php if($_SESSION['userPerm'] <= 2) { ?>
                      <li id = "documents" onclick="location.href='<?php echo base_url('mission_documents'); ?>'"> <a> <i class="fa fa-file fa-lg"></i> Documents </a> </li>
                    <?php } ?>
                    <li id = "itinerary" onclick="location.href='<?php echo base_url('mission_itinerary'); ?>'"> <a> <i class="fa fa-calendar fa-lg"></i> Itinerary </a> </li>
                    <?php if ($_SESSION["userPerm"] === '0') { ?>
                      <li id = "admin" onclick="location.href='<?php echo base_url('busbook'); ?>'"> <a> <i class="fa fa-cogs fa-lg"></i> Admin Portal </a> </li>
                    <?php } ?>
                    <li id = "logout" onclick="location.href='<?php echo base_url(''); ?>'"> <a> <i class="fa fa-times fa-lg"></i> Logout </a> </li>
                </ul>
        </div>
    </div>

    <div class = "content">

