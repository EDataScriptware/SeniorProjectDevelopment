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


<!-- VETDATALIST -->
<datalist id ='veterans'>
<?php foreach ($veteran as $vet): ?>
    <?php $skip = false; ?>
    <?php foreach ($hotel as $hot): ?>
     <?php if ($hot->$veteran_id === $vet->veteran_id) { $skip = true; break;} ?> 
    <?php endforeach ?>

    <?php if ($skip === false) { ?>
        <option value='<?php echo $vet->veteran_id ?>'> <?php echo $vet->first_name ?> <?php echo $vet->last_name ?></option>
        <?php }else {} ?>
<?php endforeach ?>
</datalist>

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

            <label for="newAirline">Airline:</label>

                <input type="text" id="newAirline" name="newAirline" required size="10"> <br>

            <label for="newFlight_number">Flight Number:</label>

                <input type="number" id="newFlight_number" name="newFlight_number" required size="10"> <br>

            <label for="newArrival">Arrival Time:</label>

                <input type="datetime-local" id="newArrival" name="newArrival"> <br>

            <label for="newArrival_location">Arrival Location:</label>

                <input type="text" id="newArrival_location" name="newArrival_location" required size="10"> <br>

            <label for="newDeparture">Departure Time:</label>

                <input type="datetime-local" id="newDeparture" name="newDeparture"> <br>

            <label for="newDeparture_location">Departure Location:</label>

                <input type="text" id="newDeparture_location" name="newDeparture_location" required size="10"> <br>

        </form>

        <form id ="addHotel" style='display:none' >

        <label for="newName">Hotel Name:</label>
 
            <input type="text" id="newName" name="newName" required size="10"> <br>

        <label for="newVeteran_id">Veteran:</label>

            <input type="text" list='veterans' id="newVeteran_id" name="newVeteran_id" required size="10"> <br>

        <label for="newRoom">Room:</label>
 
            <input type="text" id="newRoom" name="newRoom" required size="10"> <br>

        <label for="newCheck_in">Check-In Time:</label>
 
            <input type="datetime-local" id="newCheck_in" name="newCheck_in">  <br>

        <label for="newCheck_out">Check-Out Time:</label>
 
            <input type="datetime-local" id="newCheck_out" name="newCheck_out">  <br>

        </form>

        <form id ="addEvent" style='display:none' >
            <label for="newTitle">Title:</label>
 
                <input type="text" id="newTitle" name="newTitle" required size="10"> <br>

            <label for="newDescription">Description:</label>

                <textarea id="newDescription" name="newDescription" > </textarea>  <br>

            <label for="newDate">Date:</label>
            
                <input type="date" id="newDate" name="newDate">  <br>

            <label for="newStart">Start Time:</label>
            
                <input type="time" id="newStart" name="newStart">  <br>

            <label for="newEnd">End Time:</label>
            
                <input type="time" id="newEnd" name="newEnd">  <br>

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

            <input type="text" id="airline" name="airline" required size="10">  <br>

        <label for="flight_number">Flight Number:</label>

            <input type="number" id="flight_number" name="flight_number" required size="10">  <br>

        <label for="arrival">Arrival Time:</label>

            <input type="datetime-local" id="arrival" name="arrival">  <br>

        <label for="arrival_location">Arrival Location:</label>

            <input type="text" id="arrival_location" name="arrival_location" required size="10">  <br>

        <label for="departure_time">Departure Time:</label>

            <input type="datetime-local" id="departure_time" name="departure_time">  <br>

        <label for="departure_location">Departure Location:</label>

            <input type="text" id="departure_location" name="departure_location" required size="10">  <br>

        </form>

        <form id ="editHotel" style='display:none' >

        <label for="name">Hotel Name:</label>
 
            <input type="text" id="name" name="name" required size="10"> <br>

        <label for="veteran_id">Veteran:</label>

            <input type="text" list='veterans' id="veteran_id" name="veteran_id" required size="10"> <br>

        <label for="room">Room:</label>

            <input type="text" id="room" name="room" required size="10"> <br>

        <label for="check_in">Check-In Time:</label>

            <input type="datetime-local" id="check_in" name="check_in">  <br>

        <label for="check_out">Check-Out Time:</label>

            <input type="datetime-local" id="check_out" name="check_out">  <br>
          
        </form>

        <form id ="editEvent" style='display:none' >

        <label for="title">Title:</label>

            <input type="text" id="title" name="title" required size="10"> <br>

        <label for="description">Description:</label>

            <textarea id="description" name="description" > </textarea>  <br>

        <label for="date">Date:</label>

            <input type="date" id="date" name="date">  <br>

        <label for="start">Start Time:</label>

            <input type="time" id="start" name="start">  <br>

        <label for="end">End Time:</label>

            <input type="time" id="end" name="end">  <br>
        </form>


      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-primary" style='display:none' id='editFlyBut' form ="editFly">Add New Flight Entry</button>
        <button type="button" class="btn btn-primary" style='display:none' id='editHotelBut' form ="editHotel">Add New Hotel Entry</button>
        <button type="button" class="btn btn-primary" style='display:none' id='editEventBut' form ="editEvent">Add New Event Entry</button>
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

            $.post('Admin/getEvent', {id: $id, type: $type}, function (result) {
    
            document.getElementById("editFly").action = 'Admin/editEvent/'+$id+'/'+type;

            document.getElementById("editFly").style.display = "block";
            document.getElementById("editFlyBut").style.display = "block";

            document.getElementById("editHotel").style.display = "none";
            document.getElementById("editHotelBut").style.display = "none";
            
            document.getElementById("editEvent").style.display = "none";
            document.getElementById("editEventBut").style.display = "none";

            document.getElementById("arrival").value = result[0]['arrival'];
            document.getElementById("departure").value = result[0]['departure'];
            document.getElementById("flight_number").value = result[0]['flight_number'];
            document.getElementById("airline").value = result[0]['airline'];
            document.getElementById("arrival_location").value = result[0]['arrival_location'];
            document.getElementById("departure_location").value = result[0]['departure_location'];
            
             });

        break;

        case 'hotel':

            $.post('Admin/getEvent', {id: $id, type: $type}, function (result) {

            document.getElementById("editHotel").action = "Admin/editEvent/"+$id+'/'+type;

            document.getElementById("editFly").style.display = "none";
            document.getElementById("editFlyBut").style.display = "none";

            document.getElementById("editHotel").style.display = "block";
            document.getElementById("editHotelBut").style.display = "block";

            document.getElementById("editEvent").style.display = "none";
            document.getElementById("editEventBut").style.display = "none";
            
            document.getElementById("veteran_id").value = result[0]['veteran_id'];
            document.getElementById("name").value = result[0]['name'];
            document.getElementById("room").value = result[0]['room'];
            document.getElementById("check_in").value = result[0]['check_in'];
            document.getElementById("check_out").value = result[0]['check_out'];

        });

        break;

        case 'event':

            $.post('Admin/getEvent', {id: $id, type: $type}, function (result) {

            document.getElementById("editHotel").action = "Admin/editEvent/"+$id+'/'+type;

            document.getElementById("editFly").style.display = "none";
            document.getElementById("editFlyBut").style.display = "none";

            document.getElementById("editHotel").style.display = "none";
            document.getElementById("editHotelBut").style.display = "none";

            document.getElementById("editEvent").style.display = "block";
            document.getElementById("editEventBut").style.display = "block";


            document.getElementById("description").value = result[0]['description'];
            document.getElementById("start").value = result[0]['start'];
            document.getElementById("end").value = result[0]['end'];
            document.getElementById("date").value = result[0]['date'];
            document.getElementById("title").value = result[0]['title'];

        });

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