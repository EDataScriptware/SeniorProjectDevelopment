<button type="button" onclick = "getName()">Get Veteran Names</button>


<script>
  function getName() {

               $.ajax({
                   type: "POST",
                   url: "<?php echo base_url('get_loginInfo')?>",
                   data: {},
                   dataType: 'jsonp',
                   headers: {
                    'Access-Control-Allow-Origin': '*',
                    'Content-Type': 'application/json',
                   },
                   complete: function (DATA) {
                       console.log(DATA);
                   }
               });
           }
</script>