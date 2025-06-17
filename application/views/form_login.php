<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Login</title>
  <link href="<?php echo base_url() . 'assets/' ?>login_style.css" rel="stylesheet" type="text/css" />
  <script type="application/x-javascript">
    addEventListener("load", function() {
      setTimeout(hideURLbar, 0);
    }, false);
    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>
  <style>
    .alert {
      padding: 15px;
      margin-bottom: 20px;
      border: 1px solid transparent;
      border-radius: 4px;
      font-size: 14px;
    }
    .alert-success {
      color: #3c763d;
      background-color: #dff0d8;
      border-color: #d6e9c6;
    }
    .alert-error {
      color: #a94442;
      background-color: #f2dede;
      border-color: #ebccd1;
    }
    .alert-dismissible {
      padding-right: 35px;
    }
    .close {
      position: relative;
      top: -2px;
      right: -21px;
      color: inherit;
      font-size: 18px;
      font-weight: bold;
      line-height: 1;
      cursor: pointer;
      background: none;
      border: none;
    }
  </style>
</head>
<body>
  <div class="main">
    <div class="login">
      <div class="login-image">
        <img src="<?php echo base_url() . 'assets/' ?>user.png" alt="User Image">
      </div>
      <div class="inset">
        
        <!-- Alert Messages -->
        <?php if ($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible">
            <button type="button" class="close" onclick="this.parentElement.style.display='none';">&times;</button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>
        
        <?php if ($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" onclick="this.parentElement.style.display='none';">&times;</button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php endif; ?>
        
        <?php echo form_open('auth/login', array('id' => 'loginForm')); ?>
        <h2>Login Form Customer</h2>
        <div class="input-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" class="textbox" required maxlength="50">
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="password" required maxlength="50">
        </div>
        <div class="actions">
          <input type="submit" name="submit" value="LOGIN" onclick="return validateForm()">
          <div class="links">
            <a href="<?php echo base_url('auth/form_reset'); ?>">Reset Password</a>
            <a href="<?php echo base_url('auth/registrasi'); ?>">Registrasi</a>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
  
  <script>
    function validateForm() {
      var username = document.getElementById("username").value.trim();
      var password = document.getElementById("password").value.trim();
      
      if (username === "") {
        alert("Username tidak boleh kosong!");
        document.getElementById("username").focus();
        return false;
      }
      
      if (password === "") {
        alert("Password tidak boleh kosong!");
        document.getElementById("password").focus();
        return false;
      }
      
      if (username.length < 3) {
        alert("Username minimal 3 karakter!");
        document.getElementById("username").focus();
        return false;
      }
      
      if (password.length < 6) {
        alert("Password minimal 6 karakter!");
        document.getElementById("password").focus();
        return false;
      }
      
      return true;
    }
    
    // Auto hide alerts after 5 seconds
    setTimeout(function() {
      var alerts = document.querySelectorAll('.alert');
      alerts.forEach(function(alert) {
        alert.style.display = 'none';
      });
    }, 5000);
  </script>
</body>
</html>