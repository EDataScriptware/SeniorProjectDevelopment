

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

	<h2> <b> <?php echo $team->color ?> Team </b> </h2>

<?php foreach ($veteran as $vet): ?>
	<a href="<?php echo base_url('vetView'. '/'. $vet->veteran_id) ?>" class="detailedTeamListElement"><h3> <?php echo $vet->first_name ?> <?php echo$vet->last_name?> <span class = 'medCircle shiftRight <?php echo strtolower($team->color) ?>' > </span> </h3>

		<?php
		$this->db->select("*");
		$this->db->from('guardian');
		$this->db->where('guardian_id',$vet->guardian_id);
		$guardian = $this->db->get()->result();
		?>

		<?php
		$this->db->select("*");
		$this->db->from('hotel_info');
		$this->db->where('veteran_id',$vet->veteran_id);
		$vHotel = $this->db->get()->result();
		?>

		<?php
		$this->db->select("*");
		$this->db->from('hotel_info');
		$this->db->where('guardian_id',$vet->guardian_id);
		$gHotel = $this->db->get()->result();
		?>

		<?php if ($guardian != null) { ?> <p> <b> Gaurdian Name: </b> <?php echo $guardian[0]->first_name ?> <?php echo $guardian[0]->last_name ?> </p> <?php } ?>

		<?php if ($vHotel != null) { ?>	<p> <b> Veteran Hotel: </b> <?php echo $vHotel[0]->name ?>, <b> Room: </b> <?php echo $vHotel[0]->room ?> </p> <?php } ?>
		<?php if ($gHotel != null) { ?>	<p> <b> Guardian Hotel: </b> <?php echo $gHotel[0]->name ?>, <b> Room: </b> <?php echo $gHotel[0]->room ?> </p> <?php } ?>

		<p> <b> Team: </b> <?php echo $team->color ?>  </p> 

		<?php foreach ($bus as $b): ?>
		<?php if ($team->bus_id === $b->bus_id) { ?>
		<p> <b> <?php echo $b->name ?> </b>  </p> 
		<?php break; } ?>
		<?php endforeach ?>

		<?php if ($vet->med_code != "") { ?>
		<p> <b> Med Code: </b> <span class = 'medCircle med<?php echo $vet->med_code ?>' > </span> <?php echo $vet->med_code ?>  <b><?php if ($vet->med_oxygen != 0) { ?> <span class ='greenSpan'>  O2 </span> <?php } ?></b>  <b><?php if ($vet->med_cpap != 0) { ?> <span class ='blueSpan'> <i class="fa fa-tint fa-lg"></i> </span>  <?php } ?> </b> </p>
		<?php  } else { ?><p> <b> Med Code: </b> None  <b><?php if ($vet->med_oxygen != 0) { ?><span class ='greenSpan'>  O2 </span> <?php } ?></b>  <b><?php if ($vet->med_cpap != 0) { ?> <span class ='blueSpan'> <i class="fa fa-tint fa-lg"></i> </span> <?php } ?> </b> </p><?php } ?>

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
		<a href="<?php echo base_url('vetView'. '/'. $vet->veteran_id) ?>" class="detailedTeamListElement"><h3> <?php echo $vet->first_name ?> <?php echo$vet->last_name?> <span class = 'medCircle shiftRight <?php echo strtolower($tem->color) ?>' > </span> </h3>

		<?php
		$this->db->select("*");
		$this->db->from('guardian');
		$this->db->where('guardian_id',$vet->guardian_id);
		$guardian = $this->db->get()->result();
		?>

		<?php
		$this->db->select("*");
		$this->db->from('hotel_info');
		$this->db->where('veteran_id',$vet->veteran_id);
		$vHotel = $this->db->get()->result();
		?>

		<?php
		$this->db->select("*");
		$this->db->from('hotel_info');
		$this->db->where('guardian_id',$vet->guardian_id);
		$gHotel = $this->db->get()->result();
		?>

	<?php if ($guardian != null) { ?>	<p> <b> Gaurdian Name: </b> <?php echo $guardian[0]->first_name ?> <?php echo $guardian[0]->last_name ?> </p> <?php } ?>

	<?php if ($vHotel != null) { ?>	<p> <b> Veteran Room Number: </b> <?php echo $vHotel[0]->room ?> </p> <?php } ?>
	<?php if ($gHotel != null) { ?>	<p> <b> Guardian Room Number: </b> <?php echo $gHotel[0]->room ?> </p> <?php } ?>
	
	<p> <b> Team: </b> <?php echo $tem->color ?>  </p> 

	<?php foreach ($bus as $b): ?>
	<?php if ($tem->bus_id === $b->bus_id) { ?>
		<p> <b> <?php echo $b->name ?> </b>  </p> 
	<?php break; } ?>
	<?php endforeach ?>

	<?php if ($vet->med_code != "") { ?>
		<p> <b> Med Code: </b> <span class = 'medCircle med<?php echo $vet->med_code ?>' > </span> <?php echo $vet->med_code ?>  <b><?php if ($vet->med_oxygen != 0) { ?> <span class ='greenSpan'>  O2 </span> <?php } ?></b>  <b><?php if ($vet->med_cpap != 0) { ?> <span class ='blueSpan'> <i class="fa fa-tint fa-lg"></i> </span>  <?php } ?> </b> </p>
		<?php  } else { ?><p> <b> Med Code: </b> None  <b><?php if ($vet->med_oxygen != 0) { ?> <span class ='greenSpan'>  O2 </span> <?php } ?></b>  <b><?php if ($vet->med_cpap != 0) { ?> <span class ='blueSpan'> <i class="fa fa-tint fa-lg"></i> </span> <?php } ?> </b> </p><?php } ?>

	</a>
	<?php  }?>
<?php endforeach ?>
</div>
<?php endforeach ?>
	<?php } ?>

</div>

<?php if ($id === null) { ?>
<!-- BUS VIEW -->
<div id = "busView">
<?php $first = true; ?>
<div class = "buttonScrollView">
<?php foreach ($bus as $b): ?>
	<button id = "<?php echo $b->bus_id ?>"  class = "scrollItem <?php if ($first === true) { ?> scrollActive <?php $first = false;  } ?>" onClick ="show<?php echo $b->bus_id ?>()"> <i class="fa fa-bus fa-3x"></i> <br> <b> <?php echo $b->name ?> </b></button>

    <script>
        function show<?php echo $b->bus_id ?>() {
            <?php foreach ($bus as $buss): ?>
                document.getElementById("busCon<?php echo $buss->bus_id ?>").style.display = "none";
            <?php endforeach; ?>
            
            document.getElementById("busCon<?php echo $b->bus_id ?>").style.display = "block";
        }

    </script>

    <?php endforeach; ?>
</div>

<?php $first = true; ?>
	<?php foreach ($bus as $b): ?>

	<?php if ($first === true) { ?>
    <div id = "busCon<?php echo $b->bus_id ?>"> 
    <?php $first = false; } else { ?>
        <div id = "busCon<?php echo $b->bus_id ?>" style='display:none'> 
    <?php } ?>

<h2> <b> <?php echo $b->name ?></b> </h2>
<?php foreach ($allTeams as $aTem): ?>
<?php foreach ($veteran as $vet): ?>
<?php if ($aTem->bus_id === $b->bus_id && $aTem->team_id === $vet->team_id ) { ?>
	<a href="<?php echo base_url('vetView'. '/'. $vet->veteran_id) ?>" class="detailedTeamListElement"><h3> <?php echo $vet->first_name ?> <?php echo$vet->last_name?> <span class = 'medCircle shiftRight 
	<?php foreach ($allTeams as $temo): ?>
	<?php if ($temo->team_id === $vet->team_id) { ?>
		<?php echo strtolower($temo->color) ?>' > 
	<?php break; } ?>
	<?php endforeach ?>
	</span> </h3>
	

		<?php
		$this->db->select("*");
		$this->db->from('guardian');
		$this->db->where('guardian_id',$vet->guardian_id);
		$guardian = $this->db->get()->result();
		?>

		<?php
		$this->db->select("*");
		$this->db->from('hotel_info');
		$this->db->where('veteran_id',$vet->veteran_id);
		$vHotel = $this->db->get()->result();
		?>

		<?php
		$this->db->select("*");
		$this->db->from('hotel_info');
		$this->db->where('guardian_id',$vet->guardian_id);
		$gHotel = $this->db->get()->result();
		?>

		<?php if ($guardian != null) { ?>	<p> <b> Gaurdian Name: </b> <?php echo $guardian[0]->first_name ?> <?php echo $guardian[0]->last_name ?> </p> <?php } ?>

		<?php if ($vHotel != null) { ?>	<p> <b> Veteran Room Number: </b> <?php echo $vHotel[0]->room ?> </p> <?php } ?>
		<?php if ($gHotel != null) { ?>	<p> <b> Guardian Room Number: </b> <?php echo $gHotel[0]->room ?> </p> <?php } ?>


		<?php foreach ($allTeams as $temo): ?>
					<?php if ($temo->team_id === $vet->team_id) { ?>
					<p>	<?php echo "<b> Team: </b>".$temo->color ?> </p>
					<?php break; } ?>
		<?php endforeach ?>

		<p> <b> <?php echo $b->name ?> </b>  </p> 


		<?php if ($vet->med_code != "") { ?>
		<p> <b> Med Code: </b> <span class = 'medCircle med<?php echo $vet->med_code ?>' > </span> <?php echo $vet->med_code ?>  <b><?php if ($vet->med_oxygen != 0) { ?> <span class ='greenSpan'>  O2 </span> <?php } ?></b>  <b><?php if ($vet->med_cpap != 0) { ?> <span class ='blueSpan'> <i class="fa fa-tint fa-lg"></i> </span>  <?php } ?> </b> </p>
		<?php  } else { ?><p> <b> Med Code: </b> None  <b><?php if ($vet->med_oxygen != 0) { ?> <span class ='greenSpan'>  O2 </span> <?php } ?></b>  <b><?php if ($vet->med_cpap != 0) { ?> <span class ='blueSpan'> <i class="fa fa-tint fa-lg"></i> </span> <?php } ?> </b> </p><?php } ?>

</a>
	<?php  }?>
	<?php endforeach ?>
	<?php endforeach ?>

	</div>
	<?php endforeach ?>

	</div>
<?php } ?>
<!-- STAFF VIEW -->
	<div style="display:none" id = "staffView">

		<?php foreach ($bus as $b): ?>

		<h2> <b>  <?php echo $b->name ?> Staff </b> </h2>
		
			<?php foreach ($user as $use): ?>
			<?php if ($use->bus_id === $b->bus_id) { ?>

			<a class="detailedTeamListElement"><h3> <?php echo $use->first_name ?> <?php echo$use->last_name?> <?php if ($use->team_id != null) { ?> <span class = 'medCircle shiftRight 
			<?php foreach ($allTeams as $temo): ?>
			<?php if ($temo->team_id === $vet->team_id) { ?>
				<?php echo strtolower($temo->color) ?>' > 
			<?php break; } ?>
			<?php endforeach ?>
			</span>
			<?php } ?> 
			 </h3>

				<p> <b> User Type: </b> <?php echo $use->user_type ?> </p> 

				<p> <b> Cell Phone: </b> <?php echo $use->cell_phone ?> </p> 

				<p> <b> Hotel Room No: </b> <?php echo $use->room ?>  </p> 

				<?php if ($use->team_id != null) { ?>
				
					<?php foreach ($allTeams as $temo): ?>
					<?php if ($temo->team_id === $vet->team_id) { ?>
						<p>	<?php echo "<b> Team: </b>".$temo->color ?> </p>
					<?php break; } ?>
					<?php endforeach ?>
	
				
					<?php } ?> 
				<p> <b> <?php echo $b->name ?> </b>  </p> 

				</a>


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