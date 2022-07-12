<?php 
 session_start();
 if(!isset($_SESSION["uusername"])){
     header("location:../index.php");
 }


require_once "../lib/database.php";
require_once "../lib/functions.php";
$errors = [];

//Initialize (새로고침시에 html태그가 다 보이는 현상 방지)
$imagePath='';
$receipt='';
$category = '';
$section = '';
$qty = '';
$unit = '';
$total = '';
$shop = '';
$memo = '';

//get the value from from
if( $_SERVER['REQUEST_METHOD'] === 'POST'){

    //이미지 업로드하면 기본적으로  $image['tmp_name']저장이 되고, 이것을 우리쪽으로 옮겨와야한다. 
    //If image is not presented in the super global files, 
    //then image will be null, if there is no image, then null.
    $receipt = $_FILES['receipt'] ?? null;
    $category = $_POST['category'];
    $section = $_POST['section'];
    $qty = $_POST['qty'];
    $unit = $_POST['unit'];
    $total = $_POST['total'];
    $shop = $_POST['shop'];
    $memo = $_POST['memo'];

    //Validate
    if(!$category || !$section || !$qty || !$unit || !$total || !$shop || !$memo){
        $errors[] = "You have to fill all except for file";
    }
   
    if(empty($errors)) {

         
        //이미지를 추가했고 그것이 $image['tmp_name']에 올라가 있을때, 
        if($receipt && $receipt['tmp_name']){
            //upload image to upload/randome+imageName
            $imagePath ='upload/'.randomString(7).$receipt['name'];
            //move to image somewhere
            //using move_uploaded_file. from tmp_name to 
            move_uploaded_file($receipt['tmp_name'], $imagePath);
        }


        //Insert those into database using prepare method.
        $statement = $pdo->prepare("INSERT INTO tax (receipt,category,section,qty,unit,total,shop,memo,regdate)
                        VALUES(:receipt, :category, :section,:qty,:unit,:total,:shop,:memo,:regdate)");
        $statement->bindValue(':receipt',$imagePath);
        $statement->bindValue(':category',$category);
        $statement->bindValue(':section',$section);
        $statement->bindValue(':qty',$qty);
        $statement->bindValue(':unit',$unit);
        $statement->bindValue(':total',$total);
        $statement->bindValue(':shop',$shop);
        $statement->bindValue(':memo',$memo);
        $statement->bindValue(':regdate',date('Y-m-d'));
        $statement->execute();
        header('Location:main.php');
    }
}
include_once "./header.php"; 
?>

<div class="main__productList py-3">
    <div class="container flex">
        <div class="productForm ">
            <p><a href="main.php" class="btn btn-dark">Go back to main</a></p>
            <?php if(!empty($errors)): ?>
            <div class="btn-error">
            <?php foreach($errors as $error): ?>
                <p> <?php echo $error ?> </p>
                <?php endforeach ?>
            </div>
            <?php endif; ?>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <!-- Display Image -->
              
                <div class="form-control">
                    <label>Receipt</label>
                    <input type="file" name="receipt"  value="<?php echo $receipt?>" />
                </div>
                <div class="form-control">
                    <label>Category</label>
                    <input type="text" name="category" value="<?php echo $category?>" />
                </div>
                <div class="form-control">
                    <label>Section</label>
                    <input type="text" name="section" value="<?php echo $section?>" />
                </div>
                <div class="form-control">
                    <label>Q'ty</label>
                    <input type="number" name="qty" value="<?php echo $qty?>" />
                </div>
                <div class="form-control">
                    <label>Unit</label>
                    <input type="number" name="unit" value="<?php echo $unit?>" />
                </div>
                <div class="form-control">
                    <label>Total</label>
                    <input type="number" name="total" value="<?php echo $total?>" />
                </div>
                <div class="form-control">
                    <label>Shop</label>
                    <input type="text" name="shop" value="<?php echo $shop?>" />
                </div>
                <div class="form-control">
                    <label>Memo</label>
                    <br>
                    <textarea name="memo"  cols="80"  rows="10"><?php echo $memo?></textarea>
                </div>
                
                <input type="submit" value="Send" class="btn btn-primary" />
            </form>
        </div>
    </div>
</div>