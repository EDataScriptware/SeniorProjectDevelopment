
  <form method='post' action= '<?php echo base_url('Login/loginCheck/'); ?>'>
    

    <label for="username">Username:</label>
    <input type="text" id="uName" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="pWord" name="password" required><br><br>

    <button input type='submit' name='submit' value='Submit'> Login </button>
  </form>

  <?php
  
    $hash = password_hash("test", PASSWORD_DEFAULT); 

    
    if(password_verify("test", $hash)) {
        echo "Password is valid! | Hash: " . $hash;
    }
    else {
        echo "Password is invalid. | Hash: " . $hash;
    }

  ?>