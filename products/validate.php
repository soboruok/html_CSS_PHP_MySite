<?php
 $ptitle = $_POST['ptitle'];
 $price = $_POST['price'];
 $pdescription = $_POST['pdescription'];
 $imagePath='';

//Validate
if(!$ptitle){
 $errors[] = "Prdocut title is required";
}
if(!$price){
 $errors[] = "Prdocut price is required";
}
if(!$pdescription){
 $errors[] = "Prdocut description is required";
}



//create image directory if there is no directory for files
if(!is_dir('upload')){
 mkdir('upload');
}


//파일업로드 
//whenever we upload a file, apache saves "tem_name" in the temporary.
//so,we have to take from the temp name and move it somewhere else.
//var_dump($_FILES['image']);
//If there is no errors, we are going to save image.
if(empty($errors)) {
    //Upload Image
    //If image is not presented in the super global files, 
    //then image will be null, if there is no image, then null.
    $image = $_FILES['image'] ?? null; 
    $imagePath = $product['image'];
    if($image && $image['tmp_name']){

        if($product['image']){
            unlink($product['image']);
        }

        //upload image to upload/randome+imageName
        $imagePath ='upload/'.randomString(7).$image['name'];
        //var_dump($imagePath);

        //move to image somewhere
        //using move_uploaded_file. from tmp_name to 
        move_uploaded_file($image['tmp_name'], $imagePath);
    }
}
?>