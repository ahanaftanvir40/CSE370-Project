
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="veiwpoint"content="widht=device-width,initial-scale=1.0">
   <title>LOG IN</title>
   <link rel="stylesheet" href="index.css">
   <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>

   <body>
      <section>
         <div class="form-box">
            <div class="form-value">
               <form class= "" action="signin.php" method="post">
                  <h2>Login</h2>
                  <div class="inputbox">
                     <ion-icon name="mail-outline"></ion-icon>
                     <input type="email" name="email" required><label>Email</label>
                  </div>
                  <div class="inputbox">
                     <ion-icon name="lock-closed-outline"></ion-icon>
                     <input type="password" name="password" required><label>Password</label>
                  </div>
                  <div class="forget">
                     <label><input type="checkbox">Remeber This Device</label>
                     <a href="#">Forgot Password</a>
                  </div>
                  <button>Login</button>
                  <div class="register">
                     <p>Don't have an account?<a href="signup.php"> Sign Up</a></p>
                  </div>
               </form>
            </div>
         </div>
      </section>
   </body>
</body>
</html>





