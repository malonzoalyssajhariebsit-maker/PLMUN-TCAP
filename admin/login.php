<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
 <?php require_once('inc/header.php') ?>
<body class="hold-transition ">
  <script>
    start_loader()
  </script>
  <style>
    html, body{
      height: 100vh !important;
      width: 100% !important;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    body{
      background: #0c0d25ff;
      overflow: hidden;
    }
    .login-container {
      display: flex;
      height: 100vh;
      width: 100%;
    }
    .login-left {
      flex: 0.6;
      background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: white;
      position: relative;
      overflow: hidden;
    }
    .login-left::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(0, 0, 0, 0.5);
    }
    .login-right {
      flex: 0.4;
      background: rgba(72, 103, 144, 0.85);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 3rem;
      margin: 2rem;
      border-radius: 20px;
      backdrop-filter: blur(10px);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }
    .login-form {
      width: 100%;
      max-width: 400px;
    }
    .login-title {
      font-size: 2rem !important;
      font-weight: 300 !important;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
      color: #d6ffd7ff !important;
      margin-bottom: 2rem;
      text-align: center;
      text-transform: uppercase !important;
    }
    .form-group {
      margin-bottom: 1.5rem;
      position: relative;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }
    .form-icon {
      color: #92b3e4ff;
      font-size: 1.2rem;
      width: 20px;
      text-align: center;
    }
    .form-control {
      background: #708ea1ff !important;
      border: 2px solid #3a5174ff;
      border-radius: 50px;
      padding: 1rem 1.5rem;
      font-size: 1rem;
      transition: all 0.3s ease;
      width: 100%;
      color: #e7e9d7ff;
    }
    .form-control:focus {
      background: #3a83b0ff !important;
      border-color: #24577dff !important;
      box-shadow: 0 0 0 3px rgba(66, 179, 166, 0.3) !important;
      outline: none !important;
      color: #ffffff !important;
    }
    .form-control::placeholder {
      color: #e3ead1ff;
    }
    .login-btn {
      background: linear-gradient(135deg, #4fcab7ff 0%, #102a66ff 100%);
      border: none;
      border-radius: 50px;
      padding: 1rem 2rem;
      font-size: 1rem;
      font-weight: 600;
      color: white;
      text-transform: uppercase;
      letter-spacing: 1px;
      width: 100%;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    .login-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(52, 166, 201, 0.73);
    }
    .right-content {
      text-align: center;
      z-index: 1;
    }
    .right-title {
      font-size: 3rem;
      font-weight: 300;
      margin-bottom: 1rem;
    }
    .website-link {
      text-align: center;
      margin-top: 2rem;
    }
    .website-link a {
      color: #01d5dcff;
      text-decoration: none;
      font-size: 0.9rem;
      transition: color 0.3s ease;
    }
    .website-link a:hover {
      color: #cdffd6ff;
      text-decoration: none;
    }
    #logo-img{
        height:150px;
        width:150px;
        object-fit:scale-down;
        object-position:center center;
        border-radius:100%;
        margin-bottom:2rem;
    }
  </style>
  <div class="login-container">
    <div class="login-left">
      <div class="right-content">
        <center><img src="<?= validate_image($_settings->info('logo')) ?>" alt="" id="logo-img"></center>
        <h2 class="right-title"><?php echo $_settings->info('name') ?></h2>
      </div>
    </div>
    
    <div class="login-right">
      <div class="login-form">
        <h1 class="login-title">Admin Login</h1>
        
        <form id="login-frm" action="" method="post">
          <div class="form-group">
            <i class="fas fa-user form-icon"></i>
            <input type="text" name="username" placeholder="Username" class="form-control" autofocus required>
          </div>
          <div class="form-group">
            <i class="fas fa-lock form-icon"></i>
            <input type="password" name="password" placeholder="Password" class="form-control" required>
          </div>
          <div class="form-group">
            <button class="login-btn" type="submit">LOGIN</button>
          </div>
        </form>
        
        <div class="website-link">
          <a href="<?php echo base_url ?>">Go to Website</a>
        </div>
      </div>
    </div>
  </div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
  $(document).ready(function(){
    end_loader();
  })
</script>
</body>
</html>