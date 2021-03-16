
  <label for="username">Username:</label>
  <input type="text" id="uName" name="username"><br><br>
  <label for="password">Password:</label>
  <input type="text" id="pWord" name="password"><br><br>

  <button href = <?php echo base_url('Login/loginCheck/'. document.getElementById("uName").value . '/' . password_hash( document.getElementById("pWord").value ) ) ?>> Login </button>

  <?php 
  
    $hash = password_hash("this is a test", PASSWORD_DEFAULT); 
    
    if(password_verify("this is a test", $hash)) {
        echo "Password is valid!";
    }
    else {
        echo "Password is invalid.";
    }

  ?>