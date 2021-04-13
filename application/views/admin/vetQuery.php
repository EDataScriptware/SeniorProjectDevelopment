<script> $(document).ready( function () {  
    $('#home').addClass('active');
    $('#vetTable').DataTable();
} ); 
</script>

<p> Vet Query </p>

<table id="vetTable"  class="table table-striped table-bordered">
    <thead>
        <tr>
            <?php
                foreach($fields as $field) { ?>
                    <th><?php echo $field ?></th>
            <?php } ?>
        </tr>
        <tr>
            Action
        </tr>
    </thead>
    <tbody>
        <?php foreach($vetData as $vet) {?>
            <tr>
                <form id='<?php echo $vet->veteran_id ?>' class='vet_entry_edit' method='post' action='<?php echo base_url('Admin/updateVet/'); ?>'>
                    <?php foreach($vet as $key => $value) { ?>
                        <td><?php echo "<input form=".$vet->veteran_id." type='text' name='".$key."' value='".$value."'>" ;?></td>
                    <?php } ?>

                    <td><?php echo "<button input form='".$vet->veteran_id."' type='submit' name='submit' value='Submit'> Submit </button>"; ?> </td>
                </form>
            </tr>
        <?php } ?>
    </tbody>
</table>