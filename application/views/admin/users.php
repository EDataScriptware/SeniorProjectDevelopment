<script>
    $(document).ready( function () {
    $('#userTable').DataTable();
} );
    </script>
<div class = "scrunch"> 

<table id="userTable"  class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>User Type</th>
            <th>Permission Level</th>
            <th>Username</th>
            <th>Team ID</th>
            <th>Notes</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($user as $use): ?>
        <tr>
            <td> <?php echo $use->user_type ?> </td>
            <td> <?php echo $use->user_permissions ?>  </td>
            <td> <?php echo $use->username ?>  </td>
            <td> <?php
                        foreach ($team as $tem):
                            if ($use->team_id == $tem->team_id) {
                                echo $tem->color;
                                if ($tem->mission_id != $id) {
                                    echo "(Outdated)";
                                }
                                break;
                            }
                        endforeach; 
            ?>  </td>
            <td> <?php echo $use->notes ?>  </td>
            <td> <button type="button" class="btn btn-primary" onclick = "editBlock(<?php echo $use->iduser ?>)"  > EDIT </button> </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<hr>

<button type="button" class="btn btn-primary" onclick = "addNew()"  > Add New User </button>

    </div>



<div id="whiteEdit" class="whiteEdit">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <form id = "update" method = "POST">

    <p> <label for="username">Username:</label> <input type="text" id="username" name="username"> </p>
    
    <p id = "passAdd"> Password:  <input type="text" id="password" name="password"> </p>
    <p id = "passBlock"> Password:  <button class="btn btn-primary" id ="reset" > Reset</button> </p>

    <p> <label for="user_type">User Type:</label><input type="text" id="user_type" name="user_type"><br> </p>

  <label for="user_permissions">User Permissions:</label>
  <select id="user_permissions" name="user_permissions">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
</select> <br>

    <label for="team_id">Team Id:</label>
    <select id="team_id" name="team_id">
    <?php foreach($team as $tem): ?>
    <?php if ($tem->mission_id === $id) { ?>
    <option value="<?php echo $tem->team_id ?>"><?php echo $tem->color?></option>

    <?php } ?>
    <?php endforeach ?>
    </select> <br>

    <p>Notes: </p>
    <textarea id="notes" name="notes" rows="4" cols="50">
        
    </textarea>

    </form>

    <hr>

    <button type="submit" class="btn btn-primary" form="update">Save changes</button>

</div>


    <script>

        function editBlock($id) {
        $.post('Admin/getUser', {id: $id}, function (data) {
            var $result = JSON.parse(data);
            console.log($result[0]);
            document.getElementById("whiteEdit").style.width = "550px";
            document.getElementById("whiteEdit").style.padding = "60px 0px 0px 60px";
            
            document.getElementById("username").value = $result[0].username;
            document.getElementById("user_type").value = $result[0].user_type;
            document.getElementById("user_permissions").value = $result[0].user_permissions;
            document.getElementById("team_id").value = $result[0].team_id;
            document.getElementById("notes").value = $result[0].notes;
            document.getElementById("update").action = "Admin/updateUser/"+$result[0].iduser;
            document.getElementById("passBlock").style.display = "block";
            document.getElementById("passAdd").style.display = "none";
            document.getElementById("password").removeAttribute('name');
            document.getElementById("reset").addEventListener("click", passwordReset($result[0].iduser));
        });       
        }

        function addNew() {
            document.getElementById("whiteEdit").style.width = "550px";
            document.getElementById("whiteEdit").style.padding = "60px 60px 0px 60px";
            document.getElementById("update").action = "Admin/addUser/";
            document.getElementById("passBlock").style.display = "none";
            document.getElementById("passAdd").style.display = "block";
            document.getElementById("password").name = 'password';
        }

        function passwordReset($id) {

        }

        function closeNav() {
        document.getElementById("whiteEdit").style.width = "0";
        document.getElementById("whiteEdit").style.padding = "0px 0px 0px 0px";

        document.getElementById("username").value = "";
        document.getElementById("user_type").value = "";
        document.getElementById("user_permissions").value = "";
        document.getElementById("team_id").value = "";
        document.getElementById("notes").value = "";

        }

    </script>



