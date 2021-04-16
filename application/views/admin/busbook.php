<script> $(document).ready( function () {  
    $('#book').addClass('active');
} ); 

<?php foreach($bus_book_data as $bus) { ?>
    $('#<?php echo $bus->bus_book_id; ?>book').DataTable();
<?php } ?> 

</script>

<button type="button" class="btn btn-primary" onclick="">Create Mission / Bus Book</button>

<?php if(isset($bus_book_data)) {
    foreach($bus_book_data as $book) { ?>
        <hr/>
        <h2>Bus Book <?php echo $book->bus_book_id; ?> | Mission ID: <?php echo $book->mission_id; ?></h2>
        <h4>Start: <?php echo $book->start; ?> | End: <?php echo $book->end; ?></h4>
        <?php if(isset($book->notes)) { ?>
                <p><?php echo $book->notes; ?></p>
        <?php } ?>
        
        <button type="button" class="btn btn-primary" onclick="location.href='<?php echo base_url('Admin/busForm/'.$book->mission_id); ?>'">Create Bus</button>

        <table id="<?php echo $book->bus_book_id; ?>book" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Bus ID</th>
                    <th>Name</th>
                    <th>Leader Name</th>
                    <th>Leader Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($book->bus as $bus) { ?>
                    <tr>
                        <td><?php echo $bus->bus_id ;?></td>
                        <td><?php echo $bus->name ;?></td>
                        <td><?php echo $bus->leader_first.' '.$bus->leader_last ;?></td>
                        <td><?php echo $bus->leader_phone ;?></td>
                        <td><button type="button" class="btn btn-primary" onclick="location.href='<?php echo base_url('Admin/editBus/'.$bus->bus_id); ?>'" >Edit</button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } 
} ?>


