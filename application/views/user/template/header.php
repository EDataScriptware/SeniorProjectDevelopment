<?php
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
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

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets\internal\css\internal.css')?>" />
<script src="<?php echo base_url('assets\internal\js\internal.js')?>"> </script>

</head>
<body>

<div class="nav-side-menu">
        <div class="brand">Rochester Honor Flight<img src="img/logo.png" alt="Rochester Honor Flight"> </div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
    
            <div class="menu-list">
    
                <ul id="menu-content" class="menu-content collapse out">
                    <li>
                    <a href="#">
                    <i class="fa fa-dashboard fa-lg"></i> Home Page
                    </a>
                    </li>

                    <li  data-toggle="collapse" data-target="#products" class="collapsed active">
                    <a href="#"><i class="fa fa-gift fa-lg"></i> Teams <span class="arrow"></span></a>
                    </li>
                    <ul class="sub-menu collapse" id="products">
                        <li class="active"><a href="#">Blue</a></li>
                        <li><a href="#">Gold</a></li>
                        <li><a href="#">Green</a></li>
                        <li><a href="#">Purple</a></li>
                        <li><a href="#">Purple</a></li>
                        <li><a href="#">Red</a></li>
                        <li><a href="#">Silver</a></li>
                        <li><a href="#">Teal</a></li>
                        <li><a href="#">Yellow</a></li>
                    </ul>
                </ul>
        </div>
    </div>

    <div class = "content">