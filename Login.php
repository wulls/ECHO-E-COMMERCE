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
            <h2 class="title">Sign in</h2>
			
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="username" placeholder="Username" required />
            </div>
			
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="Password" required />
            </div>
			
            <input type="submit" value="Login" class="btn solid" />
            <a href = "#" class="social-text">Lupa Password ?</a>
			
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
			  
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
			  
              <a href="#" class="social-icon">
                <i class="fab fa-instagram"></i>
              </a>
			  
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a> 
            </div>
			
          </form>
		  
          <form action="signup2.php" class="sign-up-form" method="post">
            <h2 class="title">Sign up</h2>
			<div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="First Name" name="firstname" required  />
            </div>
			<div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Last Name" name="lastname" />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" name="username2" required />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email" required />
            </div>
			<div class="input-field">
              <i class="fas fa-phone"></i>
              <input type="text" placeholder="Phone Number" name="phone" required />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password2" required />
            </div>
            <input type="submit" class="btn" value="Sign up" />
			
			
           
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Don't Have Account ?</h3>
            <p>
              Sign Up now here!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="image/Trolley1.png" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Already have account ?</h3>
            <p>
		    Sign In now!
		  </p>	
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="image/Trolley1.png" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="js/loginjs.js"></script>
  </body>
</html>