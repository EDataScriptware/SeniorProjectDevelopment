<?php
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" content="width=device-width, initial-scale=1" name="viewport" >
	<title>Honor Flight - User</title>

  <?php 
    session_start(); 
    

    if(isset($_SESSION["userPerm"])) {
      // display this page
    }
    else {
      redirect("");
    }
  ?>


<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.css')?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap-grid.css')?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap-reboot.css')?>" />

<script src="<?php echo base_url('assets/internal/js/jquery-3.5.1.js')?>"> </script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.js')?>"> </script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.js')?>"> </script>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets\internal\css\internal.css')?>" />
<script src="<?php echo base_url('assets\internal\js\internal.js')?>"> </script>


</head>
<body>

<div class="nav-side-menu">
        <div class="brand">Rochester Honor Flight <img src="<?php echo base_url('assets/internal/img/logo.png')?>" alt="Rochester Honor Flight"> </div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
    
            <div class="menu-list">
    
                <ul id="menu-content" class="menu-content collapse out">
                    <li> <a href = "<?php echo base_url('user') ?>"> <i class="fa fa-dashboard fa-lg"></i> Home Page </a> </li>

                    <li  data-toggle="collapse" data-target="#products" class="collapsed active">
                    <a href="#"><i class="fa fa-gift fa-lg"></i> Teams <span class="arrow"></span></a>
                    </li>
                    <ul class="sub-menu collapse" id="products">
                    <?php foreach ($allTeams as $team): ?>
                        <li><a href = "<?php echo base_url('vetList'. '/'. $team->team_id) ?>"><?php echo $team->color ?></a></li>

                        <?php endforeach; ?>
                    </ul>

                    <a href = "<?php echo base_url('mission_documents') ?>">  <li> <i class="fa fa-dashboard fa-lg"></i> Documents  </li> </a>
                    <li> <a href = "<?php echo base_url('mission_itinerary') ?>"> <i class="fa fa-dashboard fa-lg"></i> Itinerary  </li> </a>
                </ul>
        </div>
    </div>

    <div class = "content">
