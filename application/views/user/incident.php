<br>
<h1>Create Incident Report</h1>
<hr/>
<form method='post' action='<?php echo base_url('User/sendEmail'); ?>' >
    <label for="subject">Subject:</label><br>
    <input type="text" id="subject" name="subject"><br><br>

    <label for="description">Incident Description:</label><br>
    <input type="textarea" id="description" name="description"><br><br>
</form>