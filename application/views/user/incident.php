<br>
<h1>Create Incident Report</h1>
<hr/>
<form method='post' action='<?php echo base_url('User/sendEmail'); ?>' >
    <label for="subject">Subject:</label><br>
    <input type="text" id="subject" name="subject"><br><br>

    <label for="description">Incident Description:</label><br>
    <textarea id="description" name="description" rows="10" cols="100"></textarea><br><br>

    <button input type='submit' class="btn btn-primary" name='submit' value='submit'>Create</button>
</form>