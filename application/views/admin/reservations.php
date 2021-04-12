<script> $(document).ready( function () {  $('#rez').addClass('active');} ); </script>

<script>

$(document).ready( function () {
    $('#flightTable').DataTable();
    $('#hotelTable').DataTable();
    $('#eventTable').DataTable();
} );

</script>

<h2> Flight Information <button type="button" class="btn btn-primary" onclick = "addBlock('fly')"  > ADD </button>  </h2>

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
            <td> <button type="button" class="btn btn-primary" onclick = "editBlock(<?php echo $fly->flight_id ?>,'fly')"  > EDIT </button> <button type="button" class="btn btn-primary" onclick = "removeBlock(<?php echo $fly->flight_id ?>,'fly')"  > REMOVE </button> </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<h2> Hotel Information <button type="button" class="btn btn-primary" onclick = "addBlock('hotel')"  > ADD </button> </h2>

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
            <td> <button type="button" class="btn btn-primary" onclick = "editBlock(<?php echo $hot->hotel_id ?>,'hotel')"  > EDIT </button> <button type="button" class="btn btn-primary" onclick = "removeBlock(<?php echo $hot->hotel_id ?>,'hotel')"  > REMOVE </button> </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<h2> Event Information <button type="button" class="btn btn-primary" onclick = "addBlock('event')"  > ADD </button>  </h2>

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
            <td> <button type="button" class="btn btn-primary" onclick = "editBlock(<?php echo $use->iduser ?>,'event')"  > EDIT </button> <button type="button" class="btn btn-primary" onclick = "removeBlock(<?php echo $use->iduser ?>,'event')"  > REMOVE </button> </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Add New Entry</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id ="addFly" style='display:none' >

            <label for="airline">Airline:</label>

            <input type="text" id="airline" name="airline" required size="10">

            <label for="flight_number">Flight Number:</label>

            <input type="number" id="flight_number" name="flight_number" required size="10">

            <label for="arrival">Arrival Time:</label>

            <input type="datetime-local" id="arrival" name="arrival">

            <label for="arrival_location">Arrival Location:</label>

            <input type="arrival_location" id="arrival_location" name="arrival_location" required size="10">

            <label for="departure_time">Departure Time:</label>

            <input type="datetime-local" id="departure_time" name="departure_time">

            <label for="departure_location">Departure Location:</label>

            <input type="departure_location" id="departure_location" name="departure_location" required size="10">

        </form>

        <form id ="addHotel" style='display:none' >

        </form>

        <form id ="addEvent" style='display:none' >

        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" style='display:none' id='addFlyBut' form ="addFly">Add New Flight Entry</button>
        <button type="button" class="btn btn-primary" style='display:none' id='addHotelBut' form ="addHotel">Add New Hotel Entry</button>
        <button type="button" class="btn btn-primary" style='display:none' id='addEventBut' form ="addEvent">Add New Event Entry</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Edit Entry</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id ="editFly" style='display:none' >
        <label for="airline">Airline:</label>

        <input type="text" id="airline" name="airline" required size="10">

        <label for="flight_number">Flight Number:</label>

        <input type="number" id="flight_number" name="flight_number" required size="10">

        <label for="arrival">Arrival Time:</label>

        <input type="datetime-local" id="arrival" name="arrival">

        <label for="arrival_location">Arrival Location:</label>

    <input type="arrival_location" id="arrival_location" name="arrival_location" required size="10">

    <label for="departure_time">Departure Time:</label>

    <input type="datetime-local" id="departure_time" name="departure_time">

    <label for="departure_location">Departure Location:</label>

    <input type="departure_location" id="departure_location" name="departure_location" required size="10">
        </form>

        <form id ="editHotel" style='display:none' >

        </form>

        <form id ="editEvent" style='display:none' >

        </form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" style='display:none' id='editFlyBut' form ="editFly">Save changes</button>
        <button type="button" class="btn btn-primary" style='display:none' id='editFlyHotel' form ="editHotel">Save changes</button>
        <button type="button" class="btn btn-primary" style='display:none' id='editFlyEvent' form ="editEvent">Save changes</button>
      </div>
    </div>
  </div>
</div>



<script>

function addBlock($type) {
    
    switch ($type) {
        case 'fly':
            document.getElementById("addFly").action = 'Admin/addEvent/'+$type;

            document.getElementById("addFly").style.display = "block";
            document.getElementById("addFlyBut").style.display = "block";

            document.getElementById("addHotel").style.display = "none";
            document.getElementById("addHotelBut").style.display = "none";
            
            document.getElementById("addEvent").style.display = "none";
            document.getElementById("addEventBut").style.display = "none";

        break;

        case 'hotel':
            document.getElementById("addHotel").action = "Admin/addEvent/"+$type;

            document.getElementById("addFly").style.display = "none";
            document.getElementById("addFlyBut").style.display = "none";

            document.getElementById("addHotel").style.display = "block";
            document.getElementById("addHotelBut").style.display = "block";

            document.getElementById("addEvent").style.display = "none";
            document.getElementById("addEventBut").style.display = "none";
        break;

        case 'event':
            document.getElementById("addHotel").action = "Admin/addEvent/"+$type;

            document.getElementById("addFly").style.display = "none";
            document.getElementById("addFlyBut").style.display = "none";

            document.getElementById("addHotel").style.display = "none";
            document.getElementById("addHotelBut").style.display = "none";

            document.getElementById("addEvent").style.display = "block";
            document.getElementById("addEventBut").style.display = "block";
        break;

    }

    $('#addModal').modal('show');
}

function editBlock($id, $type) {
    
    switch ($type) {
        case 'fly':
            document.getElementById("editFly").action = 'Admin/addEvent/'+$type;

            document.getElementById("editFly").style.display = "block";
            document.getElementById("editFlyBut").style.display = "block";

            document.getElementById("editHotel").style.display = "none";
            document.getElementById("editHotelBut").style.display = "none";
            
            document.getElementById("editEvent").style.display = "none";
            document.getElementById("editEventBut").style.display = "none";

        break;

        case 'hotel':
            document.getElementById("editHotel").action = "Admin/addEvent/"+$type;

            document.getElementById("editFly").style.display = "none";
            document.getElementById("editFlyBut").style.display = "none";

            document.getElementById("editHotel").style.display = "block";
            document.getElementById("editHotelBut").style.display = "block";

            document.getElementById("editEvent").style.display = "none";
            document.getElementById("editEventBut").style.display = "none";
        break;

        case 'event':
            document.getElementById("editHotel").action = "Admin/addEvent/"+$type;

            document.getElementById("editFly").style.display = "none";
            document.getElementById("editFlyBut").style.display = "none";

            document.getElementById("editHotel").style.display = "none";
            document.getElementById("editHotelBut").style.display = "none";

            document.getElementById("editEvent").style.display = "block";
            document.getElementById("editEventBut").style.display = "block";
        break;

    }

    $('#editModal').modal('show');
}

function removeBlock($id, $type) {
    switch ($type) {
        case 'fly':
            if (confirm("Are you sure you want to remove this flight from the mission?"  )) {
        $.post('Admin/removeEvent', {id: $id, type: $type}, function () {
        location.reload();
        }); } else {}
        break;

        case 'hotel':
            if (confirm("Are you sure you want to remove this hotel entry from the mission?"  )) {
        $.post('Admin/removeEvent', {id: $id, type: $type}, function () {
        location.reload();
         }); } else {}
        break;

        case 'event':
            if (confirm("Are you sure you want to remove this event from the mission?"  )) {
        $.post('Admin/removeEvent', {id: $id, type: $type}, function () {
        location.reload();
        });} else {}
        break;

    }
}


</script>