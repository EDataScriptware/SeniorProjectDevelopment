<script>
    $(document).ready( function () {
    $('#vetTable').DataTable(); // This is how you activate a the datatable library for a specific table.
    } );
</script>

<script> $(document).ready( function () {  $('#gau').addClass('active');} ); </script>  <!-- Sets the relevant nav button to Active -->

<!-- These arrays are correlated to specific database fields, if you add a new field, place it in whichever element you thing is relevant -->
<!-- If you see one that isn't listed in here, that's probably because it's unable to be easily generalized with the rest, and needs it's own unique editing interface -->
<?php $about = array('dob','gender','occupation','shirt_size','city','state','zip','day_phone','cell_phone','email','shirt_size', 'branch'); ?>
<?php $extra = array ('how_heard','why_volunteering','prior_experience','med_training','med_conditions','diet_restrictions', 'administrative_comments'); ?>
<?php $references = array('ref_name','ref_day_phone','ref_evening_phone','ref_address','ref_relationship','ref_email'); ?>
<?php $emergency = array('emergency_name', 'emergency_relationship','emergency_address', 'emergency_day_phone', 'emergency_evening_phone', 'emergency_cell_phone'); ?>
<?php $particularVet = array ('vet_name','vet_relationship'); ?>


<div class = "scrunch"> <!-- These scrunch divs don't actually do anything specific, I'm just terrified of removing them at this point  -->
<!-- This table iterates through every relevant guardian -->
<table id="vetTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Assigned Veteran</th>
            <th>Date Of Birth</th>
            <th>Contact Information</th>
            <th>Medical Training</th>
            <th> Action </th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($guardian as $guard): ?>

        <tr>
            <td><?php echo $guard->first_name ?> <?php echo $guard->last_name?></td>
            <td>  <?php 
            	$this->db->select("*");
                $this->db->from('veteran');
                $this->db->where('guardian_id',$guard->guardian_id);
            
                $vet= $this->db->get()->result();
                if ($vet != null) { echo $vet[0]->first_name." ".$vet[0]->last_name; } else {echo "None";}
            ?> </td>
            <td><?php echo $guard->dob ?></td>
            <td> Day Phone: <?php echo $guard->day_phone ?> <br> Cell Phone <?php echo $guard->cell_phone ?>  </td>
            <td><?php echo $guard->med_training ?> </td>
            <td> <button type="button" class="btn btn-primary" onclick = "editBlock(<?php echo $guard->guardian_id ?>)" > EDIT </button> 
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<hr>
        </div>
        <!-- This is the div that allows you to edit or view specific information, it's also what each PHP array is for. -->
        <div id="whiteEdit" class="whiteEdit">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <h2 id = "bigName"> </h2>
        <p id = "tinyId"> </p>
    <form id = "update" method = "POST">

        <h3>About</h3>
        <!-- if you have a new set of inputs, create a new array with the specified fields and then just copy one of these for each loops -->
	<?php foreach ($about as $aboot): ?>
		<?php 
			echo str_replace('_', ' ',ucfirst($aboot)).": <input type='text' id='$aboot' name='$aboot' class = 'infoInput'>";
			echo '<br>';
	        ?>
        <?php endforeach ?>

        <h3>Reference</h3>

        <?php foreach ($references as $ref): ?>
		<?php 
			echo str_replace('_', ' ',ucfirst($ref)).": <input type='text' id='$ref' name='$ref' class = 'infoInput'>";
			echo '<br>';
	        ?>
        <?php endforeach ?>

        <h3>Emergency Info</h3>

        <?php foreach ($emergency as $emo): ?>
		<?php 
			echo str_replace('_', ' ',ucfirst($emo)).": <input type='text' id='$emo' name='$emo' class = 'infoInput'>";
			echo '<br>';
	        ?>
        <?php endforeach ?>

        <div id = 'parVet' style = 'display:none'> 

        <h3> Specific Vet: </h3>
            
        <?php foreach ($particularVet as $pet): ?>
		<?php 
			echo str_replace('_', ' ',ucfirst($pet)).": <input type='text' id='$pet' name='$pet' class = 'infoInput'>";
			echo '<br>';
	        ?>
        <?php endforeach ?>

        </div>

        <h3> Additional Information </h3>

        <?php foreach ($extra as $ex): ?>
		<?php 
			echo str_replace('_', ' ',ucfirst($ex)).": <textarea type='text' id='$ex' name='$ex' class = 'infoInput'></textarea>";
			echo '<br>';
	        ?>
        <?php endforeach ?>

        <hr>

            <button type="submit" class="btn btn-primary" form="update">Save changes</button>
        
    </form>

</div>


        <script>

        $(document).ready(function() {
    
    //IF YOU WONDER WHY EVERY UN CHECKED CHECKBOX TURNS ON WHEN YOU SUBMIT THE FORM THIS IS WHY, to make sure all the values properly pass, un checked values are defaulted to zero and then checked.
	  // on form submit
        $("#update").on('submit', function() {
            // to each unchecked checkbox
            $(this).find('input[type=checkbox]:not(:checked)').prop('checked', true).val(0);
        })	
 
    });
        //loads up the whiteedit box for editing
        function editBlock($id) {
        $.post('Admin/getGuard', {id: $id}, function (data) {
            var $result = JSON.parse(data);
            console.log($result[0]);
            document.getElementById("whiteEdit").style.width = "550px";
            document.getElementById("whiteEdit").style.padding = "60px 0px 0px 60px";
            //performs the update guardian function in the admin controler, you can add additional fields into the URL to pass them to the function.
            document.getElementById("update").action = "Admin/updateGuard/"+$result[0].guardian_id;

            document.getElementById("bigName").innerHTML = $result[0]['first_name'] + " " + $result[0]['last_name'];
            document.getElementById("tinyId").innerHTML = "{" + $result[0]['guardian_id'] + '}';
        
            //utilizes a similar looping system to display required information
            <?php foreach ($about as $aboot): ?>
                document.getElementById('<?php echo $aboot ?>').value = $result[0]['<?php echo $aboot ?>'];
            <?php endforeach ?>

            <?php foreach ($emergency as $emo): ?>
                document.getElementById('<?php echo $emo ?>').value = $result[0]['<?php echo $emo?>'];
            <?php endforeach ?>

             <?php foreach ($references as $ref): ?>
                document.getElementById('<?php echo $ref ?>').value = $result[0]['<?php echo $ref ?>'];
             <?php endforeach ?>

             if ($result[0]['particular_veteran'] == 1) {
                document.getElementById("parVet").style.display = "block";

                <?php foreach ($particularVet as $par): ?>
                document.getElementById('<?php echo $par ?>').value = $result[0]['<?php echo $par ?>'];
                <?php endforeach ?>

             } 
             else {document.getElementById("parVet").style.display = "none";}

            <?php foreach ($extra as $ex): ?>
                document.getElementById('<?php echo $ex ?>').value = $result[0]['<?php echo $ex ?>'];
            <?php endforeach ?>

        });       
        }
        //Just closes the nav for you.
        function closeNav() {
        document.getElementById("whiteEdit").style.width = "0";
        document.getElementById("whiteEdit").style.padding = "0px 0px 0px 0px";

        }

    </script>