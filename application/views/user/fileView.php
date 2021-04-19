<script> $(document).ready( function () {  
    $('#documents').addClass('active');
    $('#fileTable').DataTable();
} ); 
</script>
<br/>
<br/>
<h1>Documents</h1>
        <?php if(isset($files)) { ?>
            <hr/>
            <br/>
            <table id="fileTable"  class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>File Name</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($files as $file): ?>
                    <tr>
                        <td><a href='<?php echo base_url('user/download/'.$file); ?>'><?php echo $file ?> </a></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php } ?>