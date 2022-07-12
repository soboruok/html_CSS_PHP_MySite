<?php
 session_start();
 if(isset($_SESSION["uusername"])){
     header("location:main.php");
 }
require_once "../lib/database.php";
/* ------------ Sessions ------------ */

/*
  Sessions are a way to store information (in variables) to be used across multiple pages.
  Unlike cookies, sessions are stored on the server.
*/

//화면을 새로고침했을때 아래와같이 안하면, 이상한 태그가 들어간다. 
$errors = [];
$uemail='';
$upassword='';

//폼을통해 POST방식으로 넘어온 데이타
if( $_SERVER['REQUEST_METHOD'] === 'POST'){
  $uemail = $_POST['uemail'];
  $upassword = $_POST['upassword'];

  //Validate
  if(empty($uemail)||empty($upassword)){
    $errors[] = "something went wrong";
  } else {
    if(empty($errors)) {
      $statement = $pdo->prepare('SELECT * FROM member WHERE uemail = :uemail OR upassword = :upassword LIMIT 1');
      $statement->bindValue(':uemail', $uemail);
      $statement->bindValue(':upassword', $upassword);
      $statement->execute();
      $member = $statement->fetch(PDO::FETCH_ASSOC);

      if ($member) {
        if ($member['uemail'] != $uemail) {
          $errors[] = "UserEmail is wrong";
        } 

        //$match = password_verify($origin_pw, $hashedPassword);  var_dump($match);
        $pwdCheck = password_verify($upassword, $member['upassword']);
        if($pwdCheck == false){
          $errors[] = "Password doesn't match";
          
        } else {
          session_start();
          $_SESSION['uemail'] = $member['uemail'];
          $_SESSION['uusername'] = $member['uusername'];
          $_SESSION['ulevel'] = $member['ulevel'];
          header('Location:main.php');
          exit();
        }

      } else {
        $errors[] = "memeber doesn't exist";
      }
    }
  }
}


?>
<?php include_once "./header.php"; ?>
<div class="main__productList py-3 my-5">
    <div class="container flex">
        <div class="productForm card ">
        <?php if(!empty($errors)): ?>
            <div class="btn-error">
            <?php foreach($errors as $error): ?>
                <p> <?php echo $error ?> </p>
                <?php endforeach ?>
            </div>
            <?php endif; ?>
        <form action="" method="POST">
            <div>
                <label>Username: </label>
                <input type="text" name="uemail" />
            </div>
            <br>
            <div>
                <label>Password: </label>
                <input type="password" name="upassword">
            </div>
            <br>
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </form>
        </div>
    </div>
</div>
