
<?php $allowed = array(2, 3, 4); ?>
<?php echo json_encode($veteran[0])?>
<h2> <?php echo $veteran[0]->first_name ?> <?php echo $veteran[0]->middle_initial ?>  <?php echo $veteran[0]->last_name ?> </h2>
<?php if ($_SESSION["userPerm"] === '2') { ?>	
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong"> EDIT </button>
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

	
	<?php if ($veteran[0]->add_comments != "") { ?>
	<h3> Additional Information: </h3>
	<p> <?php echo $veteran[0]->add_comments?> </p>
	<?php } ?>

</div>

<div id = "reservations">
<h3> reservations</h3>

</div>

<div id = "medicalInfo">
<h3>Medical Information</h3>

	<p> DOB: <?php echo $veteran[0]->dob ?>  </p>

	<?php if ($veteran[0]->med_code != "") { ?>
	<h3> Med Code: <div id = 'med<?php echo $veteran[0]->med_code ?>' class = 'medCircle' > </div> <?php echo $veteran[0]->med_code ?>
		<?php  }?>
	<h4> Conditions </h4>	

	<?php foreach ($medMedication as $medication): ?>
		<?php if ($veteran[0]->$medication == 1) {
			echo str_replace('_', ' ',ucfirst(substr($medication,4)));
			echo '<br>';
		} ?>

	<?php endforeach ?>

	<?php if ($veteran[0]->med_list != '') {
			echo '<h4> Medication List </h4>';
			echo $veteran[0]->med_list;
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
			if ($accomidations === "med_walk_bus_steps") {
				echo "Needs help with walking up/down bus steps";
			}
			else {
				echo str_replace('_', ' ',ucfirst(substr($accomidations,4)));
			}
			echo '<br>';
		}

		?>

	<?php endforeach ?>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modify Veteran Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form method ="post" action='<?php echo base_url('User/updateInfo/'); ?>'>

	  <h3> About </h3>

		<p> <b> Address: </b></p>
		<p>  <label for="city"> City: </label> <input type="text" id="city" name="city" class = "infoInput" value = "<?php echo $veteran[0]->city ?>" > </p>
		<p>  <label for="state">  State: </label> <input type="text" id="state" name="state" class = "infoInput" value ='<?php echo $veteran[0]->state ?>'> </p>
		<p>  <label for="zip"> Zip: </label> <input type="text" id="zip" name="zip" class = "infoInput" value = '<?php echo $veteran[0]->zip ?>'> </p>
		
		<p> <b> Contact: </b></p>
		<p> <label for="dPhone"> Day Phone: </label> <input type="text" id="dPhone" name="dPhone" class = "infoInput" value = "<?php echo $veteran[0]->day_phone ?>" >   </p>

		<p> <label for="aPhone"> Alt Phone: </label> <input type="text" id="aPhone" name="aPhone" class = "infoInput" value = "<?php echo $veteran[0]->cell_phone ?>" >   </p>

		<p> <b> Additional Information: </b></p>
		<textarea id="flowRate" name="flowRate" rows="4" cols="50"><?php echo $veteran[0]->add_comments; ?></textarea>

		<h3>Medical Information</h3>

	<?php if ($veteran[0]->med_code != "") { ?>
	<h3> Med Code: <div id = 'med<?php echo $veteran[0]->med_code ?>' class = 'medCircle' > </div> <?php echo $veteran[0]->med_code ?>
		<?php  }?>
	<h4> Conditions </h4>	

	<?php foreach ($medMedication as $medication): ?>
		<?php if ($veteran[0]->$medication == 1) {
			echo str_replace('_', ' ',ucfirst(substr($medication,4))).": <input type='checkbox' id='$medication' name='$medication' checked value='1'>";
			echo '<br>';
		} else {
			echo str_replace('_', ' ',ucfirst(substr($medication,4))).": <input type='checkbox' id='$medication' name='$medication'  value='1'>";
			echo '<br>';

		} ?>

	<?php endforeach ?>

	<h4> Medication List: </h4>
	<textarea id="Medlist" name="medList" rows="4" cols="50">
		<?php 	echo $veteran[0]->med_list; ?>

	</textarea> 

	<h4> When to use Medication: </h4>
	<textarea id="Medlist" name="medList" rows="4" cols="50"> <?php echo $veteran[0]->med_when_use; ?></textarea>

	<h4> Flow Rate: </h4>
	<textarea id="flowRate" name="flowRate" rows="4" cols="50"><?php echo $veteran[0]->med_flow_rate; ?></textarea>

	<h4> Other Conditions: </h4>
	<textarea id="otherMed" name="otherMed" rows="4" cols="50"><?php echo $veteran[0]->med_others; ?></textarea>

	<h3>Accommodations </h3>
	<?php foreach ($medAccomidations as $accomidations): ?>
		<?php if ($veteran[0]->$accomidations == 1) {
				echo str_replace('_', ' ',ucfirst(substr($accomidations,4))).": <input type='checkbox' id='$accomidations' name='$accomidations' checked value='1'>"   ;
				echo '<br>';
		}
		else {
			echo str_replace('_', ' ',ucfirst(substr($accomidations,4))).": <input type='checkbox' id='$accomidations' name='$accomidations'  value='1'>"   ;
			echo '<br>';
		}?>
	<?php endforeach ?>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
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
