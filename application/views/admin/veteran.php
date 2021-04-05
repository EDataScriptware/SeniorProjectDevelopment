<script>
    $(document).ready( function () {
    $('#vetTable').DataTable();
} );
    </script>



<div class = "scrunch"> 
<table id="vetTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>War(s)</th>
            <th>Date Of Birth</th>
            <th>On Current Mission?</th>
            <th>Current Team</th>

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
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
        </div>