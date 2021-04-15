<?php if(isset($bus_data) && isset($team_data)) {
    echo json_encode($bus_data) ;
    echo "<br/>";
    echo json_encode($team_data) ;
} ?>