<script> $(document).ready( function () {  document.getElementById("home").parent().addClass('active');} ); </script>

<p> admin </p>

<!-- Trigger/Open The Modal -->
<button id="vetQuery">Veteran Query</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>What veteran fields would you like to query? </p>
    <form method='post' action='<?php echo base_url('Admin/vetQueryView/'); ?>' >
        Mission ID: <input type='text' name='mission_query' placeholder='optional: enter mission id'><br>
        Team ID: <input type='text' name='team_query' placeholder='optional: enter team id'><br>
        <?php
            foreach($vetFields as $field) {
                echo "<input type='checkbox' name='".$field."' value='".$field."'> ".$field." </input><br>";
            }
        ?>
        <button input type='submit' name='submit' value='submit'> Query </button>
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
var btn = document.getElementById("vetQuery");

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