
  <form class ="form-signin" method='post' action= '<?php echo base_url('Login/loginCheck/'); ?>'>

  <img  width="224" height="72" class="mb-4" src="<?php echo base_url('assets/internal/img/logo.png')?>">
  
  <h1 class="h3 mb-3 font-weight-normal">Login</h1>
    

  <label for="inputUsername" class="sr-only">Username</label>
    <input type="username"id="uName" name="username" class="form-control" placeholder="Username" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="pWord" name="password" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" name='submit'  value='Submit' type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
  </form>
  

  <?php

    // session_start();
    session_unset();
  
    // $hash = password_hash("test", PASSWORD_DEFAULT); 

    
    // if(password_verify("test", $hash)) {
    //     echo "Password is valid! | Hash: " . $hash;
    // }
    // else {
    //     echo "Password is invalid. | Hash: " . $hash;
    // }

  ?>