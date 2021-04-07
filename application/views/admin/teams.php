<?php foreach ($team as $tem): ?>

    <?php
	$this->db->select("*");
	$this->db->from('bus');
	$this->db->where('bus_id',$tem->bus_id);

	$bus = $this->db->get()->result();
    echo json_encode($bus[0]);
    echo json_encode($tem);
	?>

<h2> <?php echo $tem->color ?> Team - <?php $bus[0]->name?>  </h2>

<script>
    $(document).ready( function () {
    $('#<?php echo $tem->color ?>Vet').DataTable();
    $('#<?php echo $tem->color ?>User').DataTable();
} );
    </script>
<h3> Staff </h3>

<div class = "scrunch"> 
<table id="<?php echo $tem->color ?>User"  class="table table-striped table-bordered">
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

<button type="button" class="btn btn-primary" onclick = "addVetBlock()"  > Add New Vet </button>

<h3> Veterans </h3>
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


<button type="button" class="btn btn-primary" onclick = "addUserBlock()"  > Add New User </button>
<hr>

<?php endforeach ?>


<script> 
function addVetBlock() {

}

function addUserBlock() {

}

function moveBlock($id, $type) {
    
}

function removeBlock($id, $type) {
    
}

</script>