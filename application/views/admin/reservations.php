<script> $(document).ready( function () {  $('#rez').addClass('active');} ); </script> <!-- sets relevant nav button to active -->

<script>
$(document).ready( function () {
    $('#flightTable').DataTable(); 
    $('#hotelTable').DataTable();
} );

</script>
<!-- Flight information table -->
<h2> Flight Information <button type="button" class="btn btn-primary" onclick = "addBlock('fly')"  > ADD </button>  </h2>

<table id="flightTable"  class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Airline</th>
            <th>Flight Number</th>
            <th>Departure Time</th>
            <th>Departure Location</th>
            <th>Arrival Time</th>
            <th>Arrival Location</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($flight as $fly): ?>
        <tr>
            <td><?php echo $fly->airline ?></td>
            <td><?php echo $fly->flight_number ?></td>
            <td><?php echo date_format(date_create($fly->departure),"Y/m/d h:i A"); ?></td>
            <td><?php echo $fly->departure_location ?></td>
            <td><?php echo date_format(date_create($fly->arrival),"Y/m/d h:i A"); ?></td>
            <td><?php echo $fly->arrival_location ?></td>
            <td> <button type="button" class="btn btn-primary" onclick = "editBlock(<?php echo $fly->flight_id ?>,'fly')"  > EDIT </button> <button type="button" class="btn btn-danger" onclick = "removeBlock(<?php echo $fly->flight_id ?>,'fly')"  > REMOVE </button> </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<!-- Hotel information table  -->
<h2> Hotel Information <button type="button" class="btn btn-primary" onclick = "addBlock('hotel')"  > ADD </button> </h2>

<table id="hotelTable"  class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Assigned Veteran</th>
            <th>Assigned Guardian</th>
            <th>Room Number</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($hotel as $hot): ?>
        <tr>
            <td> <?php
            $this->db->select("*");
                $this->db->from('veteran');
                $this->db->where('veteran_id',$hot->veteran_id);
            
                $vet = $this->db->get()->result();

                if ($vet != null) { echo $vet[0]->first_name." ".$vet[0]->last_name; } else {echo "None";}
            
            ?>  </td>
            <td> <?php
            $this->db->select("*");
                $this->db->from('guardian');
                $this->db->where('guardian_id',$hot->guardian_id);
            
                $guard = $this->db->get()->result();

                if ($guard != null) { echo $guard[0]->first_name." ".$guard[0]->last_name; } else {echo "None";}
            
            ?>  </td>
            <td> <?php echo $hot->room ?>  </td>
            <td> <button type="button" class="btn btn-primary" onclick = "editBlock(<?php echo $hot->hotel_id ?>,'hotel')"  > EDIT </button> <button type="button" class="btn btn-danger" onclick = "removeBlock(<?php echo $hot->hotel_id ?>,'hotel')"  > REMOVE </button> </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<!-- VETDATALIST -->
<datalist id ='veterans'>
<?php foreach ($veteran as $vet): ?>
        <option value='<?php echo $vet->veteran_id ?>'> <?php echo $vet->first_name ?> <?php echo $vet->last_name ?></option>
<?php endforeach ?>
</datalist>


<!-- GUARDDATALIST -->
<datalist id ='guardians'>
<?php foreach ($guardian as $guardy): ?>
        <option value='<?php echo $guardy->guardian_id ?>'> <?php echo $guardy->first_name ?> <?php echo $guardy->last_name ?></option>
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
      <!-- Flight info form -->
        <form method='POST' id ="addFly" style='display:none' >

            <label for="newAirline">Airline:</label>

                <input type="text" id="newAirline" name="newAirline" required > <br>

            <label for="newFlight_number">Flight Number:</label>

                <input type="number" id="newFlight_number" name="newFlight_number" required > <br>

            <label for="newDeparture">Departure Time:</label>

                <input type="datetime-local" id="newDeparture" name="newDeparture"> <br>

            <label for="newDeparture_location">Departure Location:</label>

                <input type="text" id="newDeparture_location" name="newDeparture_location" required > <br>

            <label for="newArrival">Arrival Time:</label>

                <input type="datetime-local" id="newArrival" name="newArrival"> <br>

            <label for="newArrival_location">Arrival Location:</label>

                <input type="text" id="newArrival_location" name="newArrival_location" required > <br>


        </form>
         <!-- Forms will hot swap in these divs depending on what button you pick, this is the hotel form  -->
        <form id ="addHotel" method='POST' style='display:none' >

        <label for="newVeteran_id">Veteran:</label>

            <input type="text" list='veterans' id="newVeteran_id" name="newVeteran_id" required > <br>

        <label for="newGuardian_id">Guardian:</label>

            <input type="text" list='guardians' id="newGuardian_id" name="newGuardian_id" required > <br>

            <script>
            
            $("#newVeteran_id").on('input', function () {
            var val = this.value;
                
            $.post('Admin/getVet', {id: val}, function (result) {
                
                try {
                var $res = JSON.parse(result);
                console.log($res[0]['guardian_id']);
                document.getElementById("newGuardian_id").value = $res[0]['guardian_id'];
                }
                catch(e) {}
                });
                });

            </script>

        <label for="newRoom">Room:</label>
 
            <input type="text" id="newRoom" name="newRoom" required > <br>

        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" style='display:none' id='addFlyBut' form ="addFly">Add New Flight Entry</button>
        <button type="submit" class="btn btn-primary" style='display:none' id='addHotelBut' form ="addHotel">Add New Hotel Entry</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<!-- Same general functionality as the adding section  -->
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
                <!-- Flight edit form -->
        <form id ="editFly" method='POST' style='display:none' >

        <label for="airline">Airline:</label>

            <input type="text" id="airline" name="airline" required size="10">  <br>

        <label for="flight_number">Flight Number:</label>

            <input type="number" id="flight_number" name="flight_number" required size="10">  <br>

        <label for="departure">Departure Time:</label>

            <input type="datetime-local" id="departure" name="departure">  <br>

        <label for="departure_location">Departure Location:</label>

            <input type="text" id="departure_location" name="departure_location" required size="10">  <br>

        <label for="arrival">Arrival Time:</label>

            <input type="datetime-local" id="arrival" name="arrival">  <br>

        <label for="arrival_location">Arrival Location:</label>

            <input type="text" id="arrival_location" name="arrival_location" required size="10">  <br>

        </form>
                <!-- Hotel edit form -->
        <form id ="editHotel" method='POST' style='display:none' >

        <label for="veteran_id">Veteran:</label>

            <input type="text" list='veterans' id="veteran_id" name="veteran_id" size="10"> <br>


        <label for="guardian_id">Guardian:</label>

            <input type="text" list='guardians' id="guardian_id" name="guardian_id" size="10"> <br>

            <script>
            
            $("#veteran_id").on('input', function () {
            var val = this.value;
                
            $.post('Admin/getVet', {id: val}, function (result) {
                
                try {
                var $res = JSON.parse(result);
                console.log($res[0]['guardian_id']);
                document.getElementById("guardian_id").value = $res[0]['guardian_id'];
                }
                catch(e) {}
                });
                });

            </script>


        <label for="room">Room:</label>

            <input type="text" id="room" name="room" required size="10"> <br>
          
        </form>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary" style='display:none' id='editFlyBut' form ="editFly">Edit Flight Entry</button>
        <button type="submit" class="btn btn-primary" style='display:none' id='editHotelBut' form ="editHotel">Edit Hotel Entry</button>
      </div>
    </div>
  </div>
</div>

<script>
//Function displays the adding info block and hides other forms depending on the type you selected
function addBlock($type) {
    
    switch ($type) {
        case 'fly':
            document.getElementById("addFly").action = 'Admin/addEvent/'+$type;

            document.getElementById("addFly").style.display = "block";
            document.getElementById("addFlyBut").style.display = "block";

            document.getElementById("addHotel").style.display = "none";
            document.getElementById("addHotelBut").style.display = "none";


        break;

        case 'hotel':
            document.getElementById("addHotel").action = "Admin/addEvent/"+$type;

            document.getElementById("addFly").style.display = "none";
            document.getElementById("addFlyBut").style.display = "none";

            document.getElementById("addHotel").style.display = "block";
            document.getElementById("addHotelBut").style.display = "block";

        break;

    }

    $('#addModal').modal('show');
}

//function displays the edit modal and all relevant information based on what you selected, also hotswaps
function editBlock($id, $type) {

    switch ($type) {
        case 'fly':

            document.getElementById("editFly").action = 'Admin/editEvent/'+$id+'/'+$type;
            //This post is how it gets the relevant information it points to the Admin controller, and the event getter function
            $.post('Admin/getEvent', {id: $id, type: $type}, function (result) {
    
                var $res = JSON.parse(result);
                console.log($res[0]);

            document.getElementById("editFly").style.display = "block";
            document.getElementById("editFlyBut").style.display = "block";

            document.getElementById("editHotel").style.display = "none";
            document.getElementById("editHotelBut").style.display = "none";


            document.getElementById("arrival").value = $res[0]['arrival'].replace(" ", "T");
            document.getElementById("departure").value = $res[0]['departure'].replace(" ", "T");;
            document.getElementById("flight_number").value = $res[0]['flight_number'];
            document.getElementById("airline").value = $res[0]['airline'];
            document.getElementById("arrival_location").value = $res[0]['arrival_location'];
            document.getElementById("departure_location").value = $res[0]['departure_location'];
            
             });

        break;

        case 'hotel':

            document.getElementById("editHotel").action = "Admin/editEvent/"+$id+'/'+$type;
            //same as the previous post, just focused on events
            $.post('Admin/getEvent', {id: $id, type: $type}, function (result) {
                var $res = JSON.parse(result);
                console.log($res[0]);


            document.getElementById("editFly").style.display = "none";
            document.getElementById("editFlyBut").style.display = "none";

            document.getElementById("editHotel").style.display = "block";
            document.getElementById("editHotelBut").style.display = "block";
            
            document.getElementById("veteran_id").value = $res[0]['veteran_id'];
            document.getElementById("guardian_id").value = $res[0]['guardian_id'];
            document.getElementById("name").value = $res[0]['name'];
            document.getElementById("room").value = $res[0]['room'];
            document.getElementById("check_in").value = $res[0]['check_in'].replace(" ", "T");
            document.getElementById("check_out").value = $res[0]['check_out'].replace(" ", "T");

        });

        break;

    }

    $('#editModal').modal('show');
}
//pops up with a confirmation if you really want to get rid of something specific.
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

    }
}


</script>