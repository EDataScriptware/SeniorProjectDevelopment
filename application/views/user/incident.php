<br>
<h1>Create Incident Report</h1>
<hr/>
<form method='post' action='<?php echo base_url('User/sendEmail'); ?>' >
    <label for="subject">Subject:</label><br>
    <input type="text" id="subject" name="subject"><br><br>

    <label for="description">Incident Description:</label><br>
    <textarea id="description" name="description" rows="12" cols="30"></textarea><br>

    <button input type='submit' class="btn btn-primary" name='submit' value='submit'>Send</button>
    <br>
    <br>
    <hr>
</form>