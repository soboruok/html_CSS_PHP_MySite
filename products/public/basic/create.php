<?php
/**@var $pdo \PDO */
require_once "../../database.php";
require_once "../../functions.php";

$errors = [];

//파일업로드 
//whenever we upload a file, apache saves "tem_name" in the temporary.
//so,we have to take from the temp name and move it somewhere else.
//var_dump($_FILES['image']);

//Initialize (새로고침시에 html태그가 다 보이는 현상 방지)
$imagePath='';
$ptitle = '';
$price = '';
$pdescription = '';
$date = '';
$product = [
'image' => ''
]; 

//get the value from from
if( $_SERVER['REQUEST_METHOD'] === 'POST'){

  require_once "validate.php";

  if(empty($errors)) {
    //Insert those into database using prepare method.
    $statement = $pdo->prepare("INSERT INTO products (image,ptitle,price,pdescription,created_date)
                    VALUES(:image, :ptitle, :price,:pdescription,:created_date)");
    $statement->bindValue(':image',$imagePath);
    $statement->bindValue(':ptitle',$ptitle);
    $statement->bindValue(':price',$price);
    $statement->bindValue(':pdescription',$pdescription);
    $statement->bindValue(':created_date',date('Y-m-d H:i:s'));
    $statement->execute();
    header('Location:main.php');
  }

}


?>

<?php include_once "../../layout/header.php"; ?>

<!-- main -->
<?php include_once "form.php" ?>
    
<?php include_once "../../layout/footer.php"; ?>