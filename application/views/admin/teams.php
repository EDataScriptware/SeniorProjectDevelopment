<?php foreach ($bus as $bub): ?>

    <script>
    $(document).ready( function () {
    // $('#<?php // echo $tem->color ?>Vet').DataTable();
    $('#<?php echo $bub->bus_id ?>User').DataTable();
} );
    </script>

<h2><?php echo $bub->name?> <button type="button" class="btn btn-primary" onclick = "editBus(<?php echo $bub->bus_id ?>)"> Edit</button> </h2>

  <br>  
<h3> <?php echo $bub->name?> Staff <button type="button" class="btn btn-primary" onclick = "addUserBlock()"  > Add New Staff Member </button></h3>

<div class = "scrunch"> 
<table id="<?php echo $bub->bus_id ?>User"  class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Role</th>
            <th>Contact Info</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($user as $use): ?>
        <?php if ($use->bus_id == $bus[0]->bus_id) { ?>
    
        <tr>
            <td> <?php echo $use->first_name ?> <?php echo $use->last_name?></td>
            <td> <?php echo $use->user_type?></td>
            <td> <?php echo'Day Phone: '.$use->day_phone.'<br> Cell Phone: '.$use->cell_phone;?> </td>
            <td> <button type="button" class="btn btn-primary" onclick = "moveBlock(<?php echo $use->iduser ?>,'user')"  > MOVE </button> <button type="button" class="btn btn-primary" onclick = "removeBlock(<?php echo $use->iduser ?>,'user')"  > REMOVE </button> </td>
        </tr>
        <?php } ?>
        <?php endforeach ?>
    </tbody>
</table>
</div>

<?php foreach ($team as $tem): ?>
    <?php if ($tem->bus_id == $bub->bus_id) { ?>

        <script>
    $(document).ready( function () {
    $('#<?php // echo $tem->color ?>Vet').DataTable();
    } );
    </script>

<br>  
<h3> Team <?php $tem->color ?> Veterans <button type="button" class="btn btn-primary" onclick = "addVetBlock()"  > Add </button> </h3>
<div class = "scrunch"> 
<table id="<?php echo $tem->color ?>Vet"  class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Veteran</th>
            <th>Veteran Contact Info</th>
            <th>Guardian</th>
            <th>Guardian Contact Info</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($veteran as $vet): ?>
        <?php if ($vet->team_id == $tem->team_id) { ?>

    <?php
	$this->db->select("*");
	$this->db->from('guardian');
	$this->db->where('guardian_id',$vet->guardian_id);

	$guardian = $this->db->get()->result();
	?>
    
        <tr>
            <td> <?php echo $vet->first_name ?> <?php echo$vet->last_name?></td>
            <td> <?php echo 'Day Phone: '.$vet->day_phone ?> <br> <?php echo 'Cell Phone: '.$vet->cell_phone?> </td>
            <td> <?php if ($guardian != null) { echo $guardian[0]->first_name." ".$guardian[0]->last_name; } else {echo "None";}?></td>
            <td> <?php if ($guardian != null) { echo'Day Phone: '.$guardian[0]->day_phone.'<br> Cell Phone: '.$guardian[0]->cell_phone; } else {echo "None";}?> </td>
            <td> <button type="button" class="btn btn-primary" onclick = "moveBlock(<?php echo $vet->veteran_id ?>,'vet')"  > MOVE </button> <button type="button" class="btn btn-primary" onclick = "removeBlock(<?php echo $vet->veteran_id ?>,'vet')"  > REMOVE </button> </td>
        </tr>
        <?php } ?>
        <?php endforeach ?>
    </tbody>
</table>
</div>
<?php } ?>
<?php endforeach ?>

<hr>

<?php endforeach ?>


<script> 
function addVetBlock() {

}

function editBus($busId) {

}

function addUserBlock() {

}

function moveBlock($id, $type) {
    
}

function removeBlock($id, $type) {
    
}

</script>