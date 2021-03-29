
<?php $allowed = array(2, 3, 4); ?>
<?php echo json_encode($veteran[0])?>
<h2> <?php echo $veteran[0]->first_name ?> <?php echo $veteran[0]->middle_initial ?>  <?php echo $veteran[0]->last_name ?> </h2>
<?php if ($_SESSION["userPerm"] === '2') { ?>	
<button> EDIT </button>
<?php } ?>
<?php $medAccomidations = array("med_cane","med_walker","med_wheelchair","med_chair_loc","med_scooter",'med_transport_airport','med_transport_trip','med_stairs','med_stand_30min','med_walk_bus_steps','med_use_mobility'); ?>
<?php $medMedication = array('med_emphysema','med_falls','med_heart_disease','med_pacemaker','med_colostomy','med_cancer','med_dnr','med_hbp','med_joint_replacement','med_kidney', 'med_diabetes','med_seizures','med_urostomy','med_dimentia','med_nebulizer','med_oxygen','med_football','med_stroke','med_urinary','med_cpap') ?>

<div id = "buttonScrollView">
	<button id = "aboutButton" class = "userViewButton" onClick ="showAbout()"> About </button>
	<button id = "resButton" class = "userViewButton" onClick ="showRes()"> Reservations </button>
	<?php if (in_array($_SESSION["userPerm"], $allowed)) { ?>	
		<button id = "medButton" class = "userViewButton" onClick ="showMed()"> Medical Info </button>
	<?php } ?>
	
	<?php if (in_array($_SESSION["userPerm"], $allowed)) { ?>	
	<button id = "acomButton" class = "userViewButton" onClick ="showAcc()"> Accommodations </button> 
	<?php } ?>

</div>


<div id = "about">
	<h3> About </h3>

	<p> DOB: <?php echo $veteran[0]->dob ?>  </p>

	<p> Address: <?php echo $veteran[0]->city ?> <?php echo $veteran[0]->state ?> <?php echo $veteran[0]->zip ?>  </p>

	<p> Day Phone: <?php echo $veteran[0]->day_phone ?>  </p>

	<p> Alt Phone: <?php echo $veteran[0]->cell_phone ?>  </p>

	<h3> Guardian </h3>
	<?php
	$this->db->select("*");
	$this->db->from('guardian');
	$this->db->where('guardian_id',$veteran[0]->guardian_id);

	$guardian = $this->db->get()->result();
	?>
	<p> Name: <?php echo $guardian[0]->first_name ?> <?php echo $guardian[0]->middle_initial ?>  <?php echo $guardian[0]->last_name ?> </p>

	<p> DOB: <?php echo $guardian[0]->dob ?>  </p>

	<p> Relationship: <?php echo $guardian[0]->vet_relationship ?> </p>

	<p> Address: <?php echo $guardian[0]->city ?> <?php echo $guardian[0]->state ?> <?php echo $guardian[0]->zip ?> </p>

	<p> Day Phone: <?php echo $guardian[0]->day_phone ?>  </p>

	<p> Alt Phone: <?php echo $guardian[0]->cell_phone ?>  </p>

	<!-- <h2>Veteran Object JSON</h3>
	<?php 
	//	echo json_encode($fields);
	?> -->

</div>

<div id = "reservations">
<h3> reservations</h3>

</div>

<div id = "medicalInfo">
<h3>Medical Information</h3>

	<p> DOB: <?php echo $veteran[0]->dob ?>  </p>

	<h3> Med Code: <div id = 'med<?php echo $veteran[0]->med_code ?>' class = 'medCircle' > </div> <?php echo $veteran[0]->med_code ?>

	<h4> Conditions </h4>

	<?php foreach ($medMedication as $medication): ?>
		<?php if ($veteran[0]->$medication == 1) {
			echo str_replace('_', ' ',ucfirst(substr($medication,4)));
			echo '<br>';
		} ?>

	<?php endforeach ?>

	<?php if ($veteran[0]->med_list != '') {
			echo '<h4> Medication List </h4>';
			echo str_replace(',', '<br />',$veteran[0]->med_list);
		} ?>

		<?php if ($veteran[0]->med_when_use != '') {
			echo '<h4> When to use Medication </h4>';
			echo $veteran[0]->med_when_use;
		} ?>

<?php if ($veteran[0]->med_flow_rate != '') {
			echo '<h4> Flow Rate </h4>';
			echo $veteran[0]->med_flow_rate;
		} ?>

		<?php if ($veteran[0]->med_others != '') {
			echo '<h4> Other Conditions </h4>';
			echo $veteran[0]->med_others;
		} ?>


</div>

<div id = "accommodations">
<h3>Accommodations </h3>
<?php foreach ($medAccomidations as $accomidations): ?>
		<?php if ($veteran[0]->$accomidations == 1) {
			echo str_replace('_', ' ',ucfirst(substr($accomidations,4)));
			echo '<br>';
		}

		?>

	<?php endforeach ?>
</div>

<script>
	function showAbout() {
		document.getElementById("about").style.display = "inline-block";
		document.getElementById("reservations").style.display = "none";
		document.getElementById("medicalInfo").style.display = "none";
		document.getElementById("accommodations").style.display = "none";
	}

	function showRes() {
		document.getElementById("about").style.display = "none";
		document.getElementById("reservations").style.display = "inline-block";
		document.getElementById("medicalInfo").style.display = "none";
		document.getElementById("accommodations").style.display = "none";
	}

	function showMed() {
		document.getElementById("about").style.display = "none";
		document.getElementById("reservations").style.display = "none";
		document.getElementById("medicalInfo").style.display = "inline-block";
		document.getElementById("accommodations").style.display = "none";
	}

	function showAcc() {
		document.getElementById("about").style.display = "none";
		document.getElementById("reservations").style.display = "none";
		document.getElementById("medicalInfo").style.display = "none";
		document.getElementById("accommodations").style.display = "inline-block";
	}

</script>
