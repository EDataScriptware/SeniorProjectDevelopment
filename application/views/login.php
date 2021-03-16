
  <form method='post' action= '<?php base_url('Login/loginCheck/'); ?>'>
  
    <label for="username">Username:</label>
    <input type="text" id="uName" name="username"><br><br>
    <label for="password">Password:</label>
    <input type="text" id="pWord" name="password"><br><br>

    <button input type='submit' name='submit' value='Submit'> Login </button>
  </form>

  <?php 


    // if($confirm != NULL) {
    //   if($confirm == false) {
    //     echo "Login Incorrect";
    //   }
    // }

  
    $hash = password_hash("test", PASSWORD_DEFAULT); 

    
    if(password_verify("test", $hash)) {
        echo "Password is valid! | Hash: " . $hash;
    }
    else {
        echo "Password is invalid. | Hash: " . $hash;
    }

  ?>