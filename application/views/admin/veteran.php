<script>
    $(document).ready( function () {
    $('#vetTable').DataTable();
} );
    </script>

<script> $(document).ready( function () {  $('#vet').addClass('active');} ); </script>

<?php $about = array('dob','gender','weight','city','state','zip','day_phone','cell_phone','email','shirt_size'); ?>
<?php $emergency = array ('emergency_name','emergency_relationship','emergency_address', 'emergency_day_phone', 'emergency_cell_phone') ?>
<?php $comments = array ('add_comments','admin_comments') ?>
<?php $alternative = array ('alt_name','alt_email','alt_phone','alt_relationship') ?>
<?php $mobility = array ("med_cane","med_walker","med_wheelchair","med_scooter",'med_transport_airport','med_transport_trip','med_stairs','med_stand_30min','med_walk_bus_steps','med_use_mobility') ?>
<?php $conditions = array ('med_emphysema','med_falls','med_heart_disease','med_pacemaker','med_colostomy','med_cancer','med_dnr','med_hbp','med_joint_replacement','med_kidney', 'med_diabetes','med_seizures','med_urostomy','med_dementia','med_nebulizer','med_oxygen','med_football','med_stroke','med_urinary','med_cpap') ?>

<div class = "scrunch"> 
<table id="vetTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>War(s)</th>
            <th>Date Of Birth</th>
            <th>On Current Mission?</th>
            <th>Current Team</th>
            <th> Action </th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($veteran as $vet): ?>

        <?php $getter = ""; ?>

        <tr>
            <td><?php echo $vet->first_name ?> <?php echo$vet->last_name?></td>
            <td>  <?php if($vet->service_ww2 == 1) { $getter .='World War 2,'; } ?> <?php if($vet->service_korea == 1) { $getter .='Korean War,'; } ?> <?php if($vet->service_cold_war == 1) { $getter .='Cold War,'; } ?> <?php if($vet->service_vietnam == 1) { $getter .='Vietnam,'; } ?>
                <p> <?php echo substr($getter, 0, -1); ?></p> </td>
            <td><?php echo $vet->dob ?></td>
            <td><?php if($vet->mission_id == $id) { echo 'Yes'; } else { echo 'No';} ?></td>
            <td><?php if($vet->mission_id == $id) {
                  
            foreach ($team as $tem):
                if ($vet->team_id == $tem->team_id) {
                    echo $tem->color;
                    break;
                }
            endforeach; } else { echo 'None';} 
            
            $getter = "";  
            ?>
            </td>
            <td> <button type="button" class="btn btn-primary" onclick = "editBlock(<?php echo $vet->veteran_id ?>)" > EDIT </button> 
                 <!-- <button type="button" class="btn btn-primary" onclick = "editGuardBlock(<?php // echo $vet->guardian_id ?>)" > GUARDIAN EDIT </button> </td> -->
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<hr>
        </div>

        <div id="whiteEdit" class="whiteEdit">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <h2 id = "bigName"> </h2>
        <p id = "tinyId"> </p>
    <form id = "update" method = "POST">


    <label for="team_id">Team Id:</label>
    <select id="team_id" name="team_id">
    <?php foreach($team as $tem): ?>
    <?php if ($tem->mission_id === $id) { ?>
    <option value="<?php echo $tem->team_id ?>"><?php echo $tem->color?></option>

    <?php } ?>
    <?php endforeach ?>
    </select> <br>

        <h3>About</h3>

	<?php foreach ($about as $aboot): ?>
		<?php 
			echo str_replace('_', ' ',ucfirst($aboot)).": <input type='text' id='$aboot' name='$aboot' class = 'infoInput'>";
			echo '<br>';
	        ?>
        <?php endforeach ?>

        <h3>Emergency Contact</h3>

        <?php foreach ($emergency as $emo): ?>
		<?php 
			echo str_replace('_', ' ',ucfirst($emo)).": <input type='text' id='$emo' name='$emo' class = 'infoInput'>";
			echo '<br>';
	        ?>
        <?php endforeach ?>

        <h3>Comments</h3>

        <?php foreach ($comments as $com): ?>
		<?php 
			echo str_replace('_', ' ',ucfirst($com)).": <textarea type='text' id='$com' name='$com' class = 'infoInput'></textarea>";
			echo '<br>';
	        ?>
        <?php endforeach ?>


        <h3>Alternate Info</h3>

        <?php foreach ($alternative as $alt): ?>
		<?php 
			echo str_replace('_', ' ',ucfirst($alt)).": <input type='text' id='$alt' name='$alt' class = 'infoInput'>";
			echo '<br>';
	        ?>
        <?php endforeach ?>

        <h3> Medication </h3>

	    <textarea id="med_list" name="med_list" rows="4" cols="50"></textarea> 

        <h3>Mobility</h3>

        <?php foreach ($mobility as $mob): ?>
        <?php 
           echo str_replace('_', ' ',ucfirst(substr($mob,4))).": <input type='checkbox' id='$mob' class='checker' name='$mob'  value='1'>";
            echo '<br>';
        ?>
        <?php endforeach ?>

        <h3>Conditions</h3>

        <?php foreach ($conditions as $con): ?>
        <?php 
          echo str_replace('_', ' ',ucfirst(substr($con,4))).": <input type='checkbox' id='$con' class='checker' name='$con'  value='1'>";
            echo '<br>';
        ?>
        <?php endforeach ?>

        <h3> Other Information </h3>

        <h4> Medical Code:  </h4>
        <select id="med_code" name="med_code">
        <option value="">None</option>
        <option value="Red">Red</option>
        <option value="Yellow">Yellow</option>
        <option value="Green">Green</option>
        </select>

	    <h4> When to use Medication: </h4>
	    <textarea id="med_when_use" name="med_when_use" rows="4" cols="50"></textarea>

	    <h4> Flow Rate: </h4>
	    <textarea id="med_flow_rate" name="med_flow_rate" rows="4" cols="50"></textarea>

	    <h4> Other Conditions: </h4>
	    <textarea id="med_others" name="med_others" rows="4" cols="50"></textarea>

        <h4> Medical Chair Location: </h4>
	    <textarea id="med_chair_loc" name="med_chair_loc" rows="4" cols="50"></textarea>
        

        <hr>

            <button type="submit" class="btn btn-primary" form="update">Save changes</button>
        
    </form>


</div>


        <script>

        $(document).ready(function() {

	  // on form submit
        $("#update").on('submit', function() {
            // to each unchecked checkbox
            $(this).find('input[type=checkbox]:not(:checked)').prop('checked', true).val(0);
        })	
 
    });

        function editBlock($id) {
        $.post('Admin/getVet', {id: $id}, function (data) {
            var $result = JSON.parse(data);
            console.log($result[0]);
            document.getElementById("whiteEdit").style.width = "550px";
            document.getElementById("whiteEdit").style.padding = "60px 0px 0px 60px";
            
            document.getElementById("update").action = "Admin/updateVeteran/"+$result[0].veteran_id;

            document.getElementById("bigName").innerHTML = $result[0]['first_name'] + " " + $result[0]['last_name'];
            document.getElementById("tinyId").innerHTML = "{" + $result[0]['veteran_id'] + '}';

            <?php foreach ($about as $aboot): ?>
                document.getElementById('<?php echo $aboot ?>').value = $result[0]['<?php echo $aboot ?>'];
            <?php endforeach ?>

            <?php foreach ($emergency as $emo): ?>
                document.getElementById('<?php echo $emo ?>').value = $result[0]['<?php echo $emo?>'];
            <?php endforeach ?>

             <?php foreach ($comments as $com): ?>
                document.getElementById('<?php echo $com ?>').value = $result[0]['<?php echo $com ?>'];
             <?php endforeach ?>

            <?php foreach ($alternative as $alt): ?>
                document.getElementById('<?php echo $alt ?>').value = $result[0]['<?php echo $alt ?>'];
            <?php endforeach ?>

            <?php foreach ($mobility as $mob): ?>
                if ($result[0]['<?php echo $mob ?>'] == 1) {$('#<?php echo $mob ?>').prop('checked', true);} 
                else {$('#<?php echo $mob ?>').prop('checked', false); }
            <?php endforeach ?>

            <?php foreach ($conditions as $con): ?>
                if ($result[0]['<?php echo $con ?>'] == 1) { $('#<?php echo $con ?>').prop('checked', true);}
                else { $('#<?php echo $con ?>').prop('checked', false);}
            <?php endforeach ?>

        document.getElementById("med_list").value = $result[0]['med_list'];
        document.getElementById("med_flow_rate").value = $result[0]['med_flow_rate'];
        document.getElementById("med_when_use").value = $result[0]['med_when_use'];
        document.getElementById("med_others").value = $result[0]['med_others'];
        document.getElementById("med_chair_loc").value = $result[0]['med_chair_loc'];

        });       
        }


        function closeNav() {
        document.getElementById("whiteEdit").style.width = "0";
        document.getElementById("whiteEdit").style.padding = "0px 0px 0px 0px";

        }

    </script>