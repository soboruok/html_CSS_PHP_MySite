<?php


// phpStorm understand that variable exists. It can also understand 
// the variable is an instance of the pdo.
/**@var $pdo \PDO */
require_once "../lib/database.php";
require_once "../lib/functions.php";

//get the id
$id = $_GET['pid'] ?? null;
if (!$id) {
    header('Location: main.php');
    exit;
}

//Call registred specific data in database.
$statement = $pdo->prepare('SELECT * FROM products WHERE pid = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$product = $statement->fetch(PDO::FETCH_ASSOC);

$errors = []; 

//   echo '<pre>';
//   var_dump($product);
//   echo '</pre>';
//   exit;

//Initialize (새로고침시에 html태그가 다 보이는 현상 방지)
$ptitle = $product['ptitle'];
$price = $product['price'];
$pdescription = $product['pdescription'];

//get the value from from
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  require_once "validate.php";

  if (empty($errors)) {
      $statement = $pdo->prepare("UPDATE products SET ptitle = :ptitle, 
                                      image = :image, 
                                      pdescription = :pdescription, 
                                      price = :price WHERE pid = :id");
      $statement->bindValue(':ptitle', $ptitle);
      $statement->bindValue(':image', $imagePath);
      $statement->bindValue(':pdescription', $pdescription);
      $statement->bindValue(':price', $price);
      $statement->bindValue(':id', $id);

      $statement->execute();
      header('Location: main.php');
  }

}


?>

<?php include_once "./layout/header.php"; ?>

<!-- main -->
<?php include_once "form.php" ?>
    
<?php include_once "./layout/footer.php"; ?>
