<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="css/stylelogin.css" />
    <title>Sign in & Sign up Form</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">

          <form action="login2.php" class="sign-in-form" method="post">
            <h2 class="title">Login</h2>

            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="username" placeholder="Username" required />
            </div>

            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="Password" required />
            </div>
            <input type="submit" value="Login" class="btn solid" />
          </form>

          <form action="signup2.php" class="sign-up-form" method="post">
            <h2 class="title">Sign up</h2>
			      <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Nama Awal" pattern="[A-Za-z ]{1,}" name="firstname" required  />
            </div>
			      <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Nama Akhir" pattern="[A-Za-z ]{1,}" name="lastname" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email" required />
            </div>
			      <div class="input-field">
              <i class="fas fa-phone"></i>
              <input type="text" placeholder="No. Handphone" pattern="[0-9]{1,}" name="phone" required />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username2" required />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password2" required />
            </div>
            <input type="submit" class="btn" value="Sign up" />
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Belum punya akun?</h3>
            <p>
              Daftar sekarang!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="image/Trolley1.png" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Sudah punya akun?</h3>
            <p>
      		    Masuk sekarang!
      		  </p>
            <button class="btn transparent" id="sign-in-btn">
              Login
            </button>
          </div>
          <img src="image/Trolley1.png" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="js/loginjs.js"></script>
    <!-- <script>
      var firstname = document.querySelector("input[name=firstname]");
      firstname.addEventListener("invalid", function(){
        this.setCustomValidity('');
        if (!this.validity.valid) {
            this.setCustomValidity('Hanya boleh menggunakan alfabet');
          }
      });

      var lastname = document.querySelector("input[name=lastname]");
      lastname.addEventListener("invalid", function(){
        this.setCustomValidity('');
        if (!this.validity.valid) {
            this.setCustomValidity('Hanya boleh menggunakan alfabet');
          }
      });

      var handphone = document.querySelector("input[name=phone]");
      handphone.addEventListener("invalid", function(){
        this.setCustomValidity('');
        if (!this.validity.valid) {
            this.setCustomValidity('Hanya boleh menggunakan angka');
          }
      });
    </script> -->
  </body>
</html>
