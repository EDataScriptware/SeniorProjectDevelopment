<script> $(document).ready( function () {  
    $('#book').addClass('active');
} ); 

<?php foreach($bus_book_data as $bus) { ?>
    $('#bus').DataTable();
<?php } ?> 

</script>

<?php if(isset($bus_data) && isset($team_data)) {
    echo json_encode($bus_data) ;
    echo "<br/>";
    echo json_encode($team_data) ;
} ?>


<?php if(isset($bus_data) && isset($team_data)) { ?>
    <h2>Bus Name: <?php echo $bus_data->name; ?> | Bus ID: <?php echo $bus_data->bus_id; ?></h2>
    <h5>Bus Leader: <?php echo $bus_data->leader_first.' '.$bus_data->leader_last; ?> | Phone: <?php echo $bus_data->leader_phone; ?></h5>
    <h5>Saftey Leader: <?php echo $bus_data->hs_first.' '.$bus_data->hs_last; ?> | Phone: <?php echo $bus_data->hs_phone; ?></h5>
    <h5>Group Leader: <?php echo $bus_data->gl_first.' '.$bus_data->gl_last; ?> | Phone: <?php echo $bus_data->gl_phone; ?></h5>

    <button type="button" class="btn btn-primary" id="createTeam">Create Team</button>
    <br/>
    <br/>

    <table id="bus" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Color</th>
                <th>Team ID</th>
                <th>Misson ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($team_data as $team) { ?>
                <tr>
                    <td><?php echo $team->color;?></td>
                    <td><?php echo $team->team_id ;?></td>
                    <td><?php echo $team->mission_id ;?></td>
                    <td><button type="button" class="btn btn-primary" >Edit</button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Fill in the fields to make a new team.</p>
    <form method='post' action='<?php echo base_url('Admin/createTeam/'.$bus_data->bus_id); ?>' >
        Color: <input type='text' name='color' placeholder='Enter team color'><br>
        Team Leader: <input list="leader_id" name='leader_id'>
                        <datalist id="leader_id">
                            <?php foreach($leader_data as $leader) { ?>
                                <option value="<?php echo $leader->iduser; ?>"><?php echo $leader->first_name . ' ' . $leader->last_name ; ?></option>
                            <?php } ?>
                        </datalist>
        <br/>
        Saftey Leader: <input list="hs_id" name='hs_id'>
                        <datalist id="hs_id">
                            <?php foreach($leader_data as $leader) { ?>
                                <option value="<?php echo $leader->iduser; ?>"><?php echo $leader->first_name . ' ' . $leader->last_name ; ?></option>
                            <?php } ?>
                        </datalist>
        <br>
        <button input type='submit' class="btn btn-primary" name='submit' value='submit'>Create</button>
    </form>

  </div>

</div>

<style>
    /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>

<script>
    // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("createTeam");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>