<script> $(document).ready( function () {  
    $('#book').addClass('active');
} ); 

<?php foreach($bus_book_data as $bus) { ?>
    $('#<?php echo $bus->bus_book_id; ?>book').DataTable();
<?php } ?> 

</script>

<button type="button" class="btn btn-primary" id="createBook">Create Mission / Bus Book</button>

<?php if(isset($bus_book_data)) {
    foreach($bus_book_data as $book) { ?>
        <hr/>
        <h2>Bus Book <?php echo $book->bus_book_id; ?> | Mission ID: <?php echo $book->mission_id; ?></h2>
        <h4>Start: <?php echo $book->start; ?> | End: <?php echo $book->end; ?></h4>
        <?php if(isset($book->notes)) { ?>
                <p><?php echo $book->notes; ?></p>
        <?php } ?>

        <button type="button" class="btn btn-primary" onclick="location.href='<?php echo base_url('Admin/busForm/'.$book->mission_id); ?>'">Create Bus</button>
        <br>
        <br>

        <table id="<?php echo $book->bus_book_id; ?>book" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Bus ID</th>
                    <th>Name</th>
                    <th>Leader Name</th>
                    <th>Leader Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
            <?php
                if(isset($book->bus)) {
                    foreach($book->bus as $bus) { ?>
                    <tr>
                        <td><?php echo $bus->bus_id ;?></td>
                        <td><?php echo $bus->name ;?></td>
                        <td><?php echo $bus->leader_first.' '.$bus->leader_last ;?></td>
                        <td><?php echo $bus->leader_phone ;?></td>
                        <td><button type="button" class="btn btn-primary" onclick="location.href='<?php echo base_url('Admin/editBus/'.$bus->bus_id); ?>'" >Details</button></td>
                    </tr>
                <?php } 
                } ?>
            </tbody>
        </table>
    <?php } 
} ?>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Fill in the fields to make a new Mission and Bus Book.</p>
    <form method='post' action='<?php echo base_url('Admin/createBook/'); ?>' >
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title"><br><br>

        <label for="flight_num">Flight Number</label><br>
        <input type="text" id="flight_num" name="flight_num"><br><br>

        <label for="start_date">Start date:</label>
        <input type="date" id="start_date" name="start_date"><br><br>

        <label for="end_date">End date:</label>
        <input type="date" id="end_date" name="end_date"><br><br>

        <label for="notes">Notes:</label>
        <input type="textarea" id="notes" name="notes"><br><br>
        <br/>
        <input type="hidden" name="show_on_front" value="0" />
        <br/>
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
var btn = document.getElementById("createBook");

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