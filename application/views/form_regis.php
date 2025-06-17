<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Registrasi</title>
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
    .input-group {
      margin-bottom: 15px;
    }
    .input-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      color: #333;
    }
    .textbox, .password {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 14px;
      box-sizing: border-box;
    }
    .textbox:focus, .password:focus {
      border-color: #007bff;
      outline: none;
      box-shadow: 0 0 5px rgba(0,123,255,0.3);
    }
    .password-requirements {
      font-size: 12px;
      color: #666;
      margin-top: 5px;
    }
    .requirement {
      display: block;
      margin: 2px 0;
    }
    .requirement.valid {
      color: #28a745;
    }
    .requirement.invalid {
      color: #dc3545;
    }
    .btn-register {
      background-color: #28a745;
      color: white;
      padding: 12px 30px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      width: 100%;
      margin-bottom: 15px;
    }
    .btn-register:hover {
      background-color: #218838;
    }
    .btn-register:disabled {
      background-color: #6c757d;
      cursor: not-allowed;
    }
    .back-to-login {
      text-align: center;
      margin-top: 15px;
    }
    .back-to-login a {
      color: #007bff;
      text-decoration: none;
      font-size: 14px;
    }
    .back-to-login a:hover {
      text-decoration: underline;
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
        
        <?php echo form_open('auth/regis', array('id' => 'registrationForm')); ?>
        <h2>Form Registrasi</h2>
        
        <div class="input-group">
          <label for="nama">Nama Lengkap</label>
          <input type="text" name="nama" id="nama" class="textbox" required maxlength="100" 
                 placeholder="Masukkan nama lengkap Anda" value="<?php echo set_value('nama'); ?>">
        </div>
        
        <div class="input-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" class="textbox" required maxlength="50" 
                 placeholder="Masukkan username (min. 3 karakter)" value="<?php echo set_value('username'); ?>"
                 onkeyup="checkUsername()">
          <div id="username-feedback" style="font-size: 12px; margin-top: 5px;"></div>
        </div>
        
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="password" required maxlength="50" 
                 placeholder="Masukkan password (min. 6 karakter)" onkeyup="checkPassword()">
          <div class="password-requirements">
            <span class="requirement" id="length-req">✗ Minimal 6 karakter</span>
            <span class="requirement" id="uppercase-req">✗ Minimal 1 huruf besar</span>
            <span class="requirement" id="lowercase-req">✗ Minimal 1 huruf kecil</span>
            <span class="requirement" id="number-req">✗ Minimal 1 angka</span>
          </div>
        </div>
        
        <div class="input-group">
          <label for="confirm_password">Konfirmasi Password</label>
          <input type="password" name="confirm_password" id="confirm_password" class="password" required maxlength="50" 
                 placeholder="Masukkan ulang password" onkeyup="checkPasswordMatch()">
          <div id="password-match-feedback" style="font-size: 12px; margin-top: 5px;"></div>
        </div>
        
        <div class="actions">
          <button type="submit" name="submit" class="btn-register" id="registerBtn" onclick="return validateRegistrationForm()">
            DAFTAR
          </button>
          
          <div class="back-to-login">
            <a href="<?php echo base_url('auth/login'); ?>">← Kembali ke Login</a>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
  
  <script>
    function checkUsername() {
      var username = document.getElementById("username").value.trim();
      var feedback = document.getElementById("username-feedback");
      
      if (username.length === 0) {
        feedback.innerHTML = "";
        return;
      }
      
      if (username.length < 3) {
        feedback.innerHTML = '<span style="color: #dc3545;">Username minimal 3 karakter</span>';
      } else if (username.length > 50) {
        feedback.innerHTML = '<span style="color: #dc3545;">Username maksimal 50 karakter</span>';
      } else if (!/^[a-zA-Z0-9_]+$/.test(username)) {
        feedback.innerHTML = '<span style="color: #dc3545;">Username hanya boleh huruf, angka, dan underscore</span>';
      } else {
        feedback.innerHTML = '<span style="color: #28a745;">Username valid</span>';
      }
    }
    
    function checkPassword() {
      var password = document.getElementById("password").value;
      
      var lengthReq = document.getElementById("length-req");
      if (password.length >= 6) {
        lengthReq.innerHTML = "✓ Minimal 6 karakter";
        lengthReq.className = "requirement valid";
      } else {
        lengthReq.innerHTML = "✗ Minimal 6 karakter";
        lengthReq.className = "requirement invalid";
      }
      
      
      var uppercaseReq = document.getElementById("uppercase-req");
      if (/[A-Z]/.test(password)) {
        uppercaseReq.innerHTML = "✓ Minimal 1 huruf besar";
        uppercaseReq.className = "requirement valid";
      } else {
        uppercaseReq.innerHTML = "✗ Minimal 1 huruf besar";
        uppercaseReq.className = "requirement invalid";
      }
      
      
      var lowercaseReq = document.getElementById("lowercase-req");
      if (/[a-z]/.test(password)) {
        lowercaseReq.innerHTML = "✓ Minimal 1 huruf kecil";
        lowercaseReq.className = "requirement valid";
      } else {
        lowercaseReq.innerHTML = "✗ Minimal 1 huruf kecil";
        lowercaseReq.className = "requirement invalid";
      }
      
      
      var numberReq = document.getElementById("number-req");
      if (/[0-9]/.test(password)) {
        numberReq.innerHTML = "✓ Minimal 1 angka";
        numberReq.className = "requirement valid";
      } else {
        numberReq.innerHTML = "✗ Minimal 1 angka";
        numberReq.className = "requirement invalid";
      }
      
      
      if (document.getElementById("confirm_password").value) {
        checkPasswordMatch();
      }
    }
    
    function checkPasswordMatch() {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirm_password").value;
      var feedback = document.getElementById("password-match-feedback");
      
      if (confirmPassword.length === 0) {
        feedback.innerHTML = "";
        return;
      }
      
      if (password === confirmPassword) {
        feedback.innerHTML = '<span style="color: #28a745;">✓ Password cocok</span>';
      } else {
        feedback.innerHTML = '<span style="color: #dc3545;">✗ Password tidak cocok</span>';
      }
    }
    
    function validateRegistrationForm() {
      var nama = document.getElementById("nama").value.trim();
      var username = document.getElementById("username").value.trim();
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirm_password").value;
      
      
      if (nama === "") {
        alert("Nama lengkap tidak boleh kosong!");
        document.getElementById("nama").focus();
        return false;
      }
      
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
      
      if (confirmPassword === "") {
        alert("Konfirmasi password tidak boleh kosong!");
        document.getElementById("confirm_password").focus();
        return false;
      }
      
      
      if (nama.length < 2) {
        alert("Nama lengkap minimal 2 karakter!");
        document.getElementById("nama").focus();
        return false;
      }
      
      
      if (username.length < 3) {
        alert("Username minimal 3 karakter!");
        document.getElementById("username").focus();
        return false;
      }
      
      if (!/^[a-zA-Z0-9_]+$/.test(username)) {
        alert("Username hanya boleh mengandung huruf, angka, dan underscore!");
        document.getElementById("username").focus();
        return false;
      }
      
      if (!/[a-z]/.test(password)) {
        alert("Password harus mengandung minimal 1 huruf kecil!");
        document.getElementById("password").focus();
        return false;
      }
      
      if (!/[0-9]/.test(password)) {
        alert("Password harus mengandung minimal 1 angka!");
        document.getElementById("password").focus();
        return false;
      }
      
      
      if (password !== confirmPassword) {
        alert("Password dan konfirmasi password tidak sama!");
        document.getElementById("confirm_password").focus();
        return false;
      }
      
      return true;
    }
    
    
    setTimeout(function() {
      var alerts = document.querySelectorAll('.alert');
      alerts.forEach(function(alert) {
        alert.style.display = 'none';
      });
    }, 5000);
  </script>
</body>
</html>