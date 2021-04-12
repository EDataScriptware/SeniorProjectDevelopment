<script> $(document).ready( function () {  $('#rez').addClass('active');} ); </script>

<script>

$(document).ready( function () {
    $('#flightTable').DataTable();
    $('#hotelTable').DataTable();
    $('#eventTable').DataTable();
} );

</script>

<h2> Flight Information <button type="button" class="btn btn-primary" onclick = "addBlock()"  > ADD </button>  </h2>

<table id="flightTable"  class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Airline</th>
            <th>Flight Number</th>
            <th>Arrival Time</th>
            <th>Arrival Location</th>
            <th>Departure Time</th>
            <th>Departure Location</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($flight as $fly): ?>
        <tr>
            <td><?php echo $fly->airline ?></td>
            <td><?php echo $fly->flight_number ?></td>
            <td><?php echo $fly->arrival ?></td>
            <td><?php echo $fly->arrival_location ?></td>
            <td><?php echo $fly->departure ?></td>
            <td><?php echo $fly->departure_location ?></td>
            <td> <button type="button" class="btn btn-primary" onclick = "editBlock(<?php echo $fly->flight_id ?>)"  > EDIT </button> <button type="button" class="btn btn-primary" onclick = "removeBlock(<?php echo $fly->flight_id ?>)"  > REMOVE </button> </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<h2> Hotel Information <button type="button" class="btn btn-primary" onclick = "addBlock()"  > ADD </button> </h2>

<table id="hotelTable"  class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Hotel Name</th>
            <th>Assigned Veteran</th>
            <th>Room Number</th>
            <th>Check-In Time</th>
            <th>Check-Out Time</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($hotel as $hot): ?>
        <tr>
            <td> <?php echo $hot->name ?>  </td>
            <td> <?php
            
            $this->db->select("*");
                $this->db->from('veteran');
                $this->db->where('veteran_id',$hot->veteran_id);
            
                $vet= $this->db->get()->result();

                if ($vet != null) { echo $vet[0]->first_name." ".$vet[0]->last_name; } else {echo "None";}
            
            ?>  </td>
            <td> <?php echo $hot->room ?>  </td>
            <td> <?php echo $hot->check_in ?>  </td>
            <td> <?php echo $hot->check_out ?>  </td>
            <td> <button type="button" class="btn btn-primary" onclick = "editBlock(<?php echo $hot->hotel_id ?>)"  > EDIT </button> <button type="button" class="btn btn-primary" onclick = "removeBlock(<?php echo $hot->hotel_id ?>)"  > REMOVE </button> </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<h2> Event Information <button type="button" class="btn btn-primary" onclick = "addBlock()"  > ADD </button>  </h2>

<table id="eventTable"  class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Team</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End time</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($event as $eve): ?>
        <tr>
            <td> <?php echo $eve->title ?>  </td>
            <td> <?php echo $eve->description ?>  </td>
            <td> <?php 
             foreach ($team as $tem):
                if ($eve->team_id == $tem->team_id) {
                    echo $tem->color;
                    break;
                }
            endforeach;
            
            ?>  </td>
            <td> <?php echo $eve->date ?>  </td>
            <td> <?php echo $eve->start ?>  </td>
            <td> <?php echo $eve->end ?>  </td>
            <td> <button type="button" class="btn btn-primary" onclick = "editBlock(<?php echo $use->iduser ?>)"  > EDIT </button> <button type="button" class="btn btn-primary" onclick = "removeBlock(<?php echo $use->iduser ?>)"  > REMOVE </button> </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

