<p> admin </p>

<table>
    <tr>
        <?php
            foreach($fields as $field) {
                echo "<th>".$field."</th>";
            }
        ?>
    </tr>
    <?php
        foreach($vetData as $vet) {
            echo "<tr>" ;
        ?>
            <form id='<?php $vet->veteran_id ?>' class='vet_entry_edit' method='post' action='<?php echo base_url('Admin/updateVet/'); ?>'>
        <?php

            foreach($vet as $key => $value) {
                echo  "<td><input form=".$vet->veteran_id." type='text' name='".$key."' value='".$value."'></td>" ;
            }

            echo  "<td><button input form='".$vet->veteran_id."' type='submit' name='submit' value='Submit'> Submit </button></td>";
            echo "</form>";
            echo "</tr>" ;
        }
    ?>
</table>