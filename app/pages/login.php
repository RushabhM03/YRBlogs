<?php
 
  if(!empty($_POST)){
    $errors = [];

    
    $query = "select * from users where email = :email limit 1";
    $row = db_query($query, ['email' => $_POST['email']]);

    if($row){

      if(!empty($_POST['remember'])){
        $remember = $_POST['remember'];
        setcookie('email', $_POST['email'], time()+600);
        setcookie('password', $_POST['password'], time()+600);
      }else{
        setcookie('email', $_POST['email'], 30);
        setcookie('password', $_POST['password'], 30);
        
      }
      
      if(password_verify($_POST['password'],$row[0]['password'])){
        // grant access
        authenticate($row[0]);
        redirect('admin');
      }else{
        $errors['email'] = "Wrong email or password";
      }
      

      
    }else{
      $errors['email'] = "Wrong email or password";
    }


  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Login -My Blog</title>

    <link href="<?=ROOT?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="<?=ROOT?>/assets/css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin w-100 m-auto">
  <form method="post">
    <a href="home">
      <img class="mb-4 rounded-circle shadow" src="<?=ROOT?>/assets/images/sample.jpg" alt="" width="92" height="92" style="object-fit: cover">
    </a>
      <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <?php if(!empty($errors['email'])): ?>
      <div class="alert alert-danger">
        <?=$errors['email']?>
      </div>
    <?php endif; ?>

    <div class="form-floating">
      <input name="email" type="email" class="form-control" id="floatingInput" placeholder="something@address" value="<?php if(isset($_COOKIE['email'])){ echo $_COOKIE['email']; } else{echo old_value('email');}; ?>">
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
      <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password']; }; ?>">
      <label for="floatingPassword">Password</label>
    </div>
    
    <div class="my-2">
        <a href="<?=ROOT?>/signup">Dont have an account? Signup here</a>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input name="remember" type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; <?php echo date('Y'); ?></p>
  </form>
</main>


    
  </body>
</html>
