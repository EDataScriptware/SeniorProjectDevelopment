

<?php // echo json_encode($veteran)?>
<?php if ($id === null) { ?>
<div class='wrapper text-center'>
<div class="btn-group btn-group-lg">
<button  type="button" id = "teamButton" class="btn btn-primary" onClick ="showTeam()">Team</button>
 <button  type="button" id = "busButton" class="btn btn-primary" onClick ="showBus()"> Bus </button> 
<button  type="button" id = "staffButton" class="btn btn-primary" onClick ="showStaff()"> Staff </button>
</div>
</div>

<?php } ?>
<div id = "teamView"> 

<?php if ($id != null) { ?>
	<script> $(document).ready( function () {  
    $('#teams').addClass('active');
} ); 
</script>
<div class = "teamListView">

	<h2> <b> <?php echo $team->color ?> Team </b> </h2>

<?php foreach ($veteran as $vet): ?>
	<a href="<?php echo base_url('vetView'. '/'. $vet->veteran_id) ?>" class="detailedTeamListElement">

	<h3> <?php echo $vet->first_name ?> <?php echo$vet->last_name?> </h3>

	</a>
<?php endforeach ?>

<!-- IF ID IS NULL -->
<?php } else { ?>
	<?php $first = true; ?>

	<script> $(document).ready( function () {  
    $('#home').addClass('active');
} ); 
</script>

<div class = "buttonScrollView">
<?php foreach ($allTeams as $team): ?>
	<button id = "<?php echo strtolower($team->color) ?>" class = "scrollItem <?php echo strtolower($team->color) ?>" onClick ="show<?php echo $team->color ?>()"> <i class="fa fa-flag fa-3x"></i> <br> <b> <?php echo $team->color ?> </b></button>

    <script>
        function show<?php echo $team->color ?>() {
            <?php foreach ($allTeams as $tem): ?>
                document.getElementById("teamCon<?php echo $tem->color ?>").style.display = "none";
            <?php endforeach; ?>
            
            document.getElementById("teamCon<?php echo $team->color ?>").style.display = "block";

        }

    </script>

    <?php endforeach; ?>
</div>

<?php $first = true; ?>

<?php foreach ($allTeams as $tem): ?>
	
	<?php if ($first === true) { ?>
    <div id = "teamCon<?php echo $tem->color ?>"> 
    <?php $first = false; } else { ?>
        <div id = "teamCon<?php echo $tem->color ?>" style='display:none'> 
    <?php } ?>

	<h2> <b> <?php echo $tem->color ?> Team </b> </h2>

<?php foreach ($veteran as $vet): ?>
	<?php if ($vet->team_id === $tem->team_id) { ?>
		<a href="<?php echo base_url('vetView'. '/'. $vet->veteran_id) ?>" class="detailedTeamListElement">

	<h3> <?php echo $vet->first_name ?> <?php echo$vet->last_name?> </h3>

	</a>
	<?php  }?>
<?php endforeach ?>
</div>
<?php endforeach ?>
	<?php } ?>

</div>

<?php if ($id === null) { ?>
<div id = "busView">
	<?php foreach ($bus as $b): ?>

<h2> <b>  <?php echo $b->name ?></b> </h2>

<?php foreach ($veteran as $vet): ?>
<?php if ($vet->bus_id === $b->bus_id) { ?>
<a href="<?php echo base_url('vetView'. '/'. $vet->veteran_id) ?>" class="teamListElement"><?php echo $vet->first_name ?> <?php echo$vet->last_name?></a>
	<?php  }?>
	<?php endforeach ?>

	<?php endforeach ?>

	</div>
<?php } ?>

	<div style="display:none" id = "staffView">

		<?php foreach ($bus as $b): ?>

		<h2> <b>  <?php echo $b->name ?> Staff </b> </h2>
		
			<?php foreach ($user as $use): ?>
			<?php if ($use->bus_id === $b->bus_id) { ?>
			<a href="" class="teamListElement"><?php echo $use->first_name ?> <?php echo$use->last_name?></a>
				<?php  }?>
				<?php endforeach ?>
		<?php endforeach ?>


	</div>


	<script>
			function showTeam() {
		document.getElementById("teamView").style.display = "block";
		document.getElementById("busView").style.display = "none";
		document.getElementById("staffView").style.display = "none";

	}

	function showBus() {
		document.getElementById("teamView").style.display = "none";
		document.getElementById("busView").style.display = "block";
		document.getElementById("staffView").style.display = "none";

	}

	function showStaff() {
		document.getElementById("teamView").style.display = "none";
		document.getElementById("busView").style.display = "none";
		document.getElementById("staffView").style.display = "block";

	}

	</script>