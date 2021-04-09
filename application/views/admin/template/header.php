<?php
	session_start(); 

    if(isset($_SESSION["userPerm"]) && $_SESSION["userPerm"] == 0) {
      // display this page
    }
    else {
      redirect("");
    }

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Honor Flight - Administration</title>



    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap.css')?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap-grid.css')?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/bootstrap/css/bootstrap-reboot.css')?>" />


<script src="<?php echo base_url('assets/internal/js/jquery-3.5.1.js')?>"> </script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.js')?>"> </script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.js')?>"> </script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/internal/css/internal.css')?>" />
<script src="<?php echo base_url('assets/internal/js/internal.js')?>"> </script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/DataTables/datatables.css')?>" />
<script src="<?php echo base_url('assets/DataTables/datatables.js')?>"> </script>

<style>

        .container
        {
            background-color: lightblue;
            width:100% !important;
            max-width: 100% !important;
        }

        body
        {
            background-color: whitesmoke;
        }

        table {
          background-color: white !important;
        }
        .odd {
        background-color:  rgba(0, 0, 0, 0.05) !important;
        }

    </style>


</head>
<body>

<!-- <div id="adminHeader" class="sidenav">
  <a href="">Home</a>
  <a href="">Teams</a>
  <a href="">Documents</a>
  <a href="">Reservations</a>
  <a href="">Users</a>
  <a href="">Veterans</a>
  <a href="">Guardians</a>
  <a href="">Personel View</a>
  <a id = "logout" href="">< Logout</a>
</div>

<div id = 'main'>  -->


<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4"><img src="<?php echo base_url('assets/internal/img/logo.png')?>"></span>
      </a>
  
      <ul class="nav nav-pills">
        <li class="nav-item"><a href="<?php echo base_url('admin')?>" id = "home" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="<?php echo base_url('teams')?>" id = "team" class="nav-link">Teams</a></li>
        <li class="nav-item"><a href="<?php echo base_url('documents')?>" id = "doc" class="nav-link">Documents</a></li>
        <li class="nav-item"><a href="<?php echo base_url('reservations')?>" id = "rez" class="nav-link">Reservations</a></li>
        <li class="nav-item"><a href="<?php echo base_url('users')?>" id = "use" class="nav-link">Users</a></li>
        <li class="nav-item"><a href="<?php echo base_url('veterans')?>" id = "vet" class="nav-link">Veterans</a></li>
        <li class="nav-item"><a href="<?php echo base_url('guardians')?>" id = "gau" class="nav-link">Guardians</a></li>
        <li class="nav-item"><a href="<?php echo base_url('user')?>" class="nav-link">Personnel View</a></li>
        <li class="nav-item"><a href="<?php echo base_url('')?>" class="nav-link">Logout</a></li>
      </ul>
    </header>
  </div>


  <div id = "main"> 