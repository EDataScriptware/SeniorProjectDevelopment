<script> $(document).ready( function () {  
    $('#itinerary').addClass('active');
} ); 
</script>

<h2 style='text-align:center'> <b> Itinerary </b> </h2>

<div class = "buttonScrollView">
<?php foreach ($allTeams as $team): ?>
	<button id = "<?php echo strtolower($team->color) ?>" class = "scrollItem <?php echo strtolower($team->color) ?>" onClick ="show<?php echo $team->color ?>()"> <i class="fa fa-flag fa-3x"></i> <br> <b> <?php echo $team->color ?> </b></button>

    <script>
        function show<?php echo $team->color ?>() {
            <?php foreach ($allTeams as $tem): ?>
                document.getElementById("eventCon<?php echo $tem->color ?>").style.display = "none";
            <?php endforeach; ?>
            
            document.getElementById("eventCon<?php echo $team->color ?>").style.display = "block";

        }

    </script>

    <?php endforeach; ?>
</div>

<?php $first = true; ?>

<?php foreach ($allTeams as $tem): ?>
    <?php if ($first === true) { ?>
    <div id = "eventCon<?php echo $tem->color ?>"> 
    <?php 
    $first = false; 
        } else { ?>
        <div id = "eventCon<?php echo $tem->color ?>" style='display:none'> 
    <?php } ?>
    <script>
  $( function() {
      $("#eventTeam<?php echo $tem->color ?>" ).accordion({heightStyle: "content",collapsible: true,active: false });
  });
    </script>
</script>

<h3> Team <?php echo $tem->color ?> Events <button type="button" class="btn btn-primary" onclick = "addBlock('<?php echo $tem->team_id ?>')"  > ADD </button> </h3>
<div id="eventTeam<?php echo $tem->color ?>"  class="table table-striped table-bordered">

<?php foreach ($event as $eve): ?>
        <?php if ($eve->team_id == $tem->team_id) { ?>
            <h3> <?php echo $eve->title ?>  </h3>
            <div>
            <p> <b>Description: </b> <?php echo $eve->description ?>  </p>
            <p> <b>Date: </b>  <?php echo date_format(date_create($eve->date),"Y/m/d"); ?>  </p>
            <p> <b>Start: </b>  <?php echo date_format(date_create($eve->start),"h:i A"); ?>  </p>
            <p> <b>End: </b>  <?php echo date_format(date_create($eve->end),"h:i A"); ?>  </p>
            <p> <b>Actions: </b>  <button type="button" class="btn btn-primary" onclick = "editBlock(<?php echo $eve->event_id ?>)"  > EDIT </button> <button type="button" class="btn btn-danger" onclick = "removeBlock(<?php echo $eve->event_id ?>)"  > REMOVE </button> </p>
        </tr>
        </div>
        <?php } ?>
        <?php endforeach ?>

</div>

</div>
<?php endforeach ?>

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
        <form id ="addEvent" method='POST'>

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
        <button type="submit" class="btn btn-primary" id='addEventBut' form ="addEvent">Add New Event</button>
      </div>
    </div>
  </div>
</div>


<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Edit Hotel Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form id ="editEvent" method='POST'>

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
        <button type="submit" class="btn btn-primary" id='editEventBut' form ="editEvent">Edit Event Entry</button>
      </div>
    </div>
  </div>
</div>

<script>

function addBlock($team) {
    document.getElementById("addEvent").action = "User/addEvent/"+$team;
    $('#addModal').modal('show');
}

function editBlock($id) {
    document.getElementById("editEvent").action = "User/editEvent/"+$id;

    $.post('User/getEvent', {id: $id}, function (result) {
        var $res = JSON.parse(result);
        console.log($res[0]);

    document.getElementById("description").value = $res[0]['description'];
    document.getElementById("start").value = $res[0]['start'];
    document.getElementById("end").value = $res[0]['end'];
    document.getElementById("date").value = $res[0]['date'];
    document.getElementById("title").value = $res[0]['title'];
});

$('#editModal').modal('show');

}

function removeBlock($id) {

if (confirm("Are you sure you want to remove this event? "  )) {
    $.post('User/removeEvent', {id: $id}, function () {
    location.reload();

});
} else {}}

</script>