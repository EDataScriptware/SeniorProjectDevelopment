<?php foreach ($team as $tem): ?>

<h3> <?php echo $tem->color ?> Team  </h3>

<script>
    $(document).ready( function () {
    $('#<?php echo $tem->color ?>Vet').DataTable();
} );
    </script>
<h2> Veterans </h2>

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

    <?php
	$this->db->select("*");
	$this->db->from('guardian');
	$this->db->where('guardian_id',$vet->guardian_id);

	$guardian = $this->db->get()->result();
	?>
    
        <tr>
            <td> <?php echo $vet->first_name ?> <?php echo$vet->last_name?></td>
            <td> <?php echo 'Day_Phone: '.$vet->day_phone ?> 
            <?php echo 'Cell_Phone: '.$vet->cell_phone?> 
        </td>
            <td> <?php echo $guardian[0]->first_name ?> <?php echo $guardian[0]->last_name ?></td>
            <td> <?php echo 'Day_Phone: '.$guardian[0]->day_phone ?>
            <?php echo 'Cell_Phone: '.$guardian[0]->cell_phone?>
         </td>
            <td> <button type="button" class="btn btn-primary" onclick = "moveBlock(<?php echo $vet->veteran_id ?>)"  > MOVE </button> <button type="button" class="btn btn-primary" onclick = "moveBlock(<?php echo $vet->veteran_id ?>)"  > REMOVE </button> </td>

        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<button type="button" class="btn btn-primary" onclick = "addVetBlock()"  > Add New Vet </button>
<button type="button" class="btn btn-primary" onclick = "addUserBlock()"  > Add New User </button>
<hr>

<?php endforeach ?>


<script> 
function addVetBlock() {

}

function addUserBlock() {

}

function moveBlock() {
    
}

function removeBlock() {
    
}

</script>