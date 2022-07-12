<?php
 session_start();
 if(isset($_SESSION["uusername"])){
     header("location:main.php");
 }
require_once "../lib/database.php";

//화면을 새로고침했을때 아래와같이 안하면, 이상한 태그가 들어간다. 
$uusername='';
$uemail='';
$upassword='';
$upassword_repeat='';
$errors = [];

//폼을통해 POST방식으로 넘어온 데이타
if( $_SERVER['REQUEST_METHOD'] === 'POST'){

    //넘어온값을 받아서 정리
    $uusername = $_POST['uusername'];
    $uemail = $_POST['uemail'];
    $upassword = $_POST['upassword'];
    $upassword_repeat = $_POST['upassword_repeat'];

    //Validate
    if(empty($uusername)||empty($uemail)||empty($upassword)||empty($upassword_repeat)){
        $errors[] = "something went wrong";
    }


    //사용자가 등록한 username 또는 이메일을 추출한다.
    $statement = $pdo->prepare('SELECT * FROM member WHERE uusername = :uusername OR uemail = :uemail LIMIT 1');
    $statement->bindValue(':uusername', $uusername);
    $statement->bindValue(':uemail', $uemail);
    $statement->execute();
    $member = $statement->fetch(PDO::FETCH_ASSOC);

    //데이타베이스에 username과 이메일이 사용자가 등록한것과 있는지 중복확인한다. 
	if ($member) {
		if ($member['uusername'] === $uusername) {
			echo "<span style='display: block; color: red;'>UserName has already used.</span>";
		}
		if ($member['uemail'] === $uemail) {
			echo "<span style='display: block; color: red;'>Email has already used.</span>";
		}
    //비밀번호를 확인한다. 
	} else if ($upassword != $upassword_repeat) {
        echo "<span style='display: block; color: red;'>Password missmatch</span>";
    //어떠한 에러가 발생하지 않으면, password를 암호화시켜서 저장한다. 
    //Authorize를 위해서 $ulever = 1 준다. 
    } else {
        if(empty($errors)) {
            $ulevel = 1; 
            // $hashedPassword = password_hash($origin_pw, PASSWORD_BCRYPT);
            $hashedPassword = password_hash($_POST['upassword'], PASSWORD_BCRYPT);
            //Insert those into database using prepare method.
            $statement = $pdo->prepare("INSERT INTO member (uusername,uemail,ulevel,upassword,ucreated)
                            VALUES(:uusername, :uemail, :ulevel,:upassword,:ucreated)");
            $statement->bindValue(':uusername',$uusername);
            $statement->bindValue(':uemail',$uemail);
            $statement->bindValue(':ulevel',$ulevel);
            $statement->bindValue(':upassword',$hashedPassword);
            $statement->bindValue(':ucreated',date('Y-m-d H:i:s'));
            $statement->execute();
            header('Location:main.php');
        }
    }
}
?>
<?php include_once "./header.php"; ?>
<div class="main__productList py-3">
    <div class="container flex">
        <div class="productForm ">
            <?php if(!empty($errors)): ?>
            <div class="btn-error">
                <?php foreach($errors as $error): ?>
                    <p> <?php echo $error ?> </p>
                <?php endforeach ?>
            </div>
            <?php endif; ?>
            <form method="POST">
                <table class="signup__table">
                    <tr>
                        <th>User Name </th>
                        <td><input type="text" name="uusername" placeholder="UserName"></td>
                    </tr>
                    <tr>
                        <th>User Email </th>
                        <td><input type="text" name="uemail" placeholder="Email"></td>
                    </tr>
                    <tr>
                        <th>Password </th>
                        <td><input type="password" name="upassword" placeholder="Password"></td>
                    </tr>
                    <tr>
                        <th>Password Confirmation </th>
                        <td><input type="password" name="upassword_repeat" placeholder="Repeat password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" name="signup-submit" class="btn btn-primary">Signup</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>