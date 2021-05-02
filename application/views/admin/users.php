<script>
    $(document).ready( function () {
    $('#userTable').DataTable();
} );
    </script>

<?php var_dump($_SESSION) ?>
<div class = "scrunch"> 

<script> $(document).ready( function () {  $('#use').addClass('active');} ); </script>

<h2> System Users <button type="button" class="btn btn-primary" onclick = "addNew()"  > ADD </button> </h2>

<!-- User table -->
<table id="userTable"  class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>User Type</th>
            <th>Permissions Level</th>
            <th>User Name</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Room Number</th>
            <th>Team</th>
            <th>Bus</th>
            <th>Notes</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($user as $use): ?>
        <tr>
            <td> <?php echo $use->user_type ?> </td>
            <td> <?php
            //handles how specific user permissions are displayed
            switch ($use->user_permissions) {
                case 0:
                    echo "Administrator";
                    break;
                case 1:
                    echo "Group Leader";
                    break;
                case 2:
                    echo "Group Assistant";
                    break;
                case 3:
                    echo "Generic User";
                    break;
            }?>  </td>
            <td> <?php echo $use->username ?>  </td>
            <td> <?php echo $use->first_name ?> <?php echo $use->last_name ?>  </td>
            <td><?php echo 'Cell Phone: '.$use->cell_phone ?>  </td>
            <td> <?php echo $use->room ?>  </td>
            <td> <?php
                        foreach ($team as $tem):
                            if ($use->team_id == $tem->team_id) {
                                echo $tem->color;
                                if ($tem->mission_id != $id) { echo "(Diff Mission)"; }
                                break;
                            }
                        endforeach; 
            ?>  </td>
                     <td><?php                         
                        foreach ($bus as $bub):
                            if ($use->bus_id == $bub->bus_id) {
                                echo $bub->name;
                                if ($tem->mission_id != $id) { echo "(Diff Mission)"; }
                                break;
                            }
                        endforeach; 
                  ?>
                  </td>
            <td> <?php echo $use->notes ?>  </td>
            <td> <button type="button" class="btn btn-primary" onclick = "editBlock(<?php echo $use->iduser ?>)"  > EDIT </button> <?php if ($use->user_permissions != '0') {  ?> <button type="button" class="btn btn-danger" onclick = "deleteBlock(<?php echo $use->iduser ?>)"  > DELETE </button> <?php } ?>  </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<hr>

</div>
<!-- User editing div -->
<div id="whiteEdit" class="whiteEdit">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <form id = "update" method = "POST">

    <p> <label for="username">Username:</label> <input type="text" id="username" name="username"> </p>
    
    <p id = "passAdd"> Password:  <input type="text" id="password" name="password"> </p>
    <p id = "passBlock"> New Password:  <input type="text" id="pass_reset" name="pass_reset" minlength="4"> </p>

    <p> <label for="first_name">First Name:</label> <input type="text" id="first_name" name="first_name"> </p>

    <p> <label for="last_name">Last Name:</label> <input type="text" id="last_name" name="last_name"> </p>

    <p> <label for="cell_phone">Cell Phone:</label> <input type="text" id="cell_phone" name="cell_phone"> </p>

    <p> <label for="room">Hotel Room No:</label> <input type="text" id="room" name="room"> </p>

    <p> <label for="user_type">User Type:</label><input type="text" id="user_type" name="user_type"><br> </p>

  <label for="user_permissions">User Permissions:</label>
  <select id="user_permissions" name="user_permissions">
  <option value=" " disabled >Select Permission Level</option>
  <option id ="adminButton" style ='display:none' value="0">Admin</option>
  <option value="1">1 (Leader Privileges)</option>
  <option value="2">2 (Assistant Privileges)</option>
  <option value="3">3 (User Privileges)</option>
</select> <br>

    <label for="team_id">Team Id:</label>
    <select id="team_id" name="team_id">
    <?php foreach($team as $tem): ?>
    <?php if ($tem->mission_id == $id) { ?>
    <option value="<?php echo $tem->team_id ?>"><?php echo $tem->color?></option>

    <?php } ?>
    <?php endforeach ?>
    </select> <br>

    <label for="bus_id">Bus Id:</label>
    <select id="bus_id" name="bus_id">
    <?php foreach ($bus as $buss):
      if ($buss->mission_id == $id) {?>
      <option value="<?php echo $buss->bus_id ?>"><?php echo $buss->name?></option>
    <?php } ?>
    <?php endforeach ?>


    </select> <br>

    <p>Notes: </p>
    <textarea id="notes" name="notes" rows="4" cols="50"></textarea>

    </form>

    <hr>

    <button type="submit" class="btn btn-primary" form="update">Save changes</button>

</div>


    <script>
    //Populates the editing block with specific information
        function editBlock($id) {
            //getter post functionality
        $.post('Admin/getUser', {id: $id}, function (data) {
            var $result = JSON.parse(data);
            console.log($result[0]);
            document.getElementById("whiteEdit").style.width = "550px";
            document.getElementById("whiteEdit").style.padding = "60px 0px 0px 60px";
            
            document.getElementById("username").value = $result[0].username;
            document.getElementById("user_type").value = $result[0].user_type;
            document.getElementById("first_name").value = $result[0].first_name;
            document.getElementById("last_name").value = $result[0].last_name;
            if ($result[0].user_permissions != '0') { 
            document.getElementById("user_permissions").value = $result[0].user_permissions;
            document.getElementById("adminButton").style.display = 'none';
            document.getElementById("user_permissions").disabled = false;
            }
            else {
            document.getElementById("user_permissions").value = $result[0].user_permissions;
            document.getElementById("adminButton").style.display = 'block';
            document.getElementById("user_permissions").disabled = true;
             
            }
            document.getElementById("team_id").value = $result[0].team_id;
            document.getElementById("bus_id").value = $result[0].bus_id;

            document.getElementById("cell_phone").value = $result[0].cell_phone;


            document.getElementById("notes").value = $result[0].notes;
            document.getElementById("update").action = "Admin/updateUser/"+$result[0].iduser;
            document.getElementById("passBlock").style.display = "block";
            document.getElementById("passAdd").style.display = "none";
            document.getElementById("password").removeAttribute('name');
        });       
        }
        //pops up the edit box for editing
        function addNew() {
            document.getElementById("whiteEdit").style.width = "550px";
            document.getElementById("whiteEdit").style.padding = "60px 90px 0px 60px";
            document.getElementById("update").action = "Admin/addUser/";
            document.getElementById("passBlock").style.display = "none";
            document.getElementById("passAdd").style.display = "block";
            document.getElementById("password").name = 'password';
        }

        //closes the nav
        function closeNav() {
        document.getElementById("whiteEdit").style.width = "0";
        document.getElementById("whiteEdit").style.padding = "0px 0px 0px 0px";

        document.getElementById("username").value = "";
        document.getElementById("user_type").value = "";
        document.getElementById("user_permissions").value = "";
        document.getElementById("team_id").value = "";
        document.getElementById("notes").value = "";

        }

        //makes sure you want to delete a specific user
        function deleteBlock($id) {

        if (confirm("Are you sure you want to delete this user? "  )) {
            $.post('Admin/deleteUser', {id: $id}, function () {
            location.reload();

        });
        } else {}
        }

        </script>

    </script>



