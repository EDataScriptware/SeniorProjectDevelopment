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
            <td> <?php echo $use->team_id ?>  </td>
            <td> <?php echo $use->notes ?>  </td>
            <td> <button type="button" class="btn btn-primary" onclick = "editBlock(<?php echo $use->iduser ?>)"  > EDIT </button> </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
    </div>



<div id="whiteEdit" class="whiteEdit">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <form id = "update" method = "POST">

    <label for="username">User Type:</label>
    <input type="text" id="username" name="username"><br>

    <label for="user_type">User Type:</label>
    <input type="text" id="user_type" name="user_type"><br>

  <label for="user_permissions">User Permissions:</label>
  <select id="user_permissions" name="user_permissions">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
</select>

    <label for="team_id">Team Id:</label>
    <select id="team_id" name="team_id">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    </select>

    <label for="notes">Notes:</label>
    <textarea id="notes" name="notes" rows="4" cols="50">
   
    </textarea>

    </form>

    <p> Password:  <button class="btn btn-primary" id ="reset" > Reset</button> </p>

    <button type="submit" class="btn btn-primary" form="update">Save changes</button>

</div>


    <script>

        function editBlock($id) {
        $.post('Admin/getUser', {id: $id}, function (data) {
            var $result = data;
            alert($result);
            document.getElementById("whiteEdit").style.width = "550px";
        });       
        }

        function closeNav() {
        document.getElementById("whiteEdit").style.width = "0";
        }

    </script>



