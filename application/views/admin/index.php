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
            echo "<td><form id='".$vet->veteran_id."' class='vet_entry_edit' method='post' action='". base_url('Admin/updateVet/'); . "'/>";

            foreach($vet as $key => $value) {
                echo  "<input form=".$vet->veteran_id." type='text' name='".$key."' value='".$value."'>" ;
            }

            echo  "<button input form='".$vet->veteran_id."' type='submit' name='submit' value='Submit'> Submit </button>";
            echo "</form></td>";
            echo "</tr>" ;
        }
    ?>
</table>