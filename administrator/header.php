
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
      integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <link rel="stylesheet" href="admin.css" />
    <title>MySite</title>
  </head>
  <body>
    <div class="navbar">
      <div class="container flex">
        <h1 class="logo"><a href="../index.php"><img src="../images/logo.png" alt="" /></a></h1>
        <nav>
          <ul>
            <li><a href="main.php">Tax</a></li>
            <?php if(isset($_SESSION['uusername'])){ ?>
              <li><a href="logout.php">Logout</a></li>

            <?php } else { ?>
              <!-- <li><a href="signup.php">Signup</a></li> -->
            <li><a href="login.php">Login</a></li>
            
            <?php } ?>
            
          </ul>
        </nav>
      </div>
    </div>
    