<p> admin </p>

<table>
    <tr>
        <?php
            echo json_encode($vetData);
            echo "<br/>";
            echo json_encode($fields);
            echo "<br/>";

            foreach($fields as $field) {
                echo "<th>".$field."</th>";
            }
        ?>
    </tr>
    <?php
        foreach($vetData as $vet) {
            echo "<tr>" ;

            foreach($vet as $data) {
                echo "<td>". $data . "</td>";
            }

            echo "</tr>" ;
        }
    ?>
</table>