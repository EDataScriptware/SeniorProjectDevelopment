<script>
    $(document).ready( function () {
    $('#vetTable').DataTable();
} );
    </script>


<?php ?>

<table id="vetTable" class="display">
    <thead>
        <tr>
            <th>Name</th>
            <th>War</th>
            <th>Date Of Birth</th>
            <th>On Current Mission?</th>
            <th>Current Team</th>

        </tr>
    </thead>
    <tbody>
    <?php foreach ($veteran as $vet): ?>
        <tr>
            <td><?php echo $vet->first_name ?> <?php echo$vet->last_name?></td>
            <td><?php if($vet->service_ww2 == 1) { echo 'World War 2'; } ?> <?php if($vet->service_korea == 1) { echo 'Korean War'; } ?> <?php if($vet->service_cold_war == 1) { echo 'Cold War'; } ?> <?php if($vet->service_Vietnam == 1) { echo 'Vietnam'; } ?> </td>
            <td><?php echo $vet->dob ?></td>
            <td><?php if($vet->mission_id == $id) { echo 'yes' } else { echo 'no'} ?></td>
            <td><?php if($vet->mission_id == $id) {
            
            foreach ($team as $tem):
                if ($vet->team_id == $tem->team_id) {
                    echo $tem->color;
                    break;
                }

            endforeach    
            
            
            } else { echo ''} ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>