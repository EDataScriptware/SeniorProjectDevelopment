<script> $(document).ready( function () {  
    $('#book').addClass('active');
} ); 

</script>

<br/>
<br/>
<h1>Create Bus</h1>
<br/>
<h2>Fill in the fields to make a new bus for mission <?php echo $mission_id; ?></h2>
<br/>
<br/>
<form method='post' action='<?php echo base_url('Admin/createBus/'.$mission_id); ?>' >
    <h2>Leader Information</h2><br/>
    <label for="name">Bus Name:</label><br>
    <input type="text" id="name" name="name"><br><br>

    <label for="leader_first">First Name:</label><br>
    <input type="text" id="leader_first" name="leader_first"><br><br>

    <label for="leader_last">Last Name:</label><br>
    <input type="text" id="leader_last" name="leader_last"><br><br>

    <label for="leader_nametag">Nametag:</label><br>
    <input type="text" id="leader_nametag" name="leader_nametag"><br><br>

    <label for="leader_phone">Phone:</label><br>
    <input type="text" id="leader_phone" name="leader_phone"><br><br><br>


    <h2>Saftey Leader Information</h2><br/>
    <label for="hs_first">First Name:</label><br>
    <input type="text" id="hs_first" name="hs_first"><br><br>

    <label for="hs_last">Last Name:</label><br>
    <input type="text" id="hs_last" name="hs_last"><br><br>

    <label for="hs_nametag">Nametag:</label><br>
    <input type="text" id="hs_nametag" name="hs_nametag"><br><br>

    <label for="hs_phone">Phone:</label><br>
    <input type="text" id="hs_phone" name="hs_phone"><br><br><br>


    <h2>Group Leader</h2><br/>
    <label for="gl_first">First Name:</label><br>
    <input type="text" id="gl_first" name="gl_first"><br><br>

    <label for="gl_last">Last Name:</label><br>
    <input type="text" id="gl_last" name="gl_last"><br><br>

    <label for="gl_nametag">Nametag:</label><br>
    <input type="text" id="gl_nametag" name="gl_nametag"><br><br>

    <label for="gl_phone">Phone:</label><br>
    <input type="text" id="gl_phone" name="gl_phone"><br><br>

    <input type="hidden" name="mission_id" value="<?php echo $mission_id ; ?>" />
    <br/>
    <button input type='submit' class="btn btn-primary" name='submit' value='submit'>Create</button>
</form>