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
                <?php if($product['image']): ?>
                    <img src="<?php echo $product['image'] ?>" alt="" style="width:80px" />
                <?php endif; ?>
                <div class="form-control">
                    <label>Product Image</label>
                    <input type="file" name="image"  value="<?php echo $image?>" />
                </div>
                <div class="form-control">
                    <label>Product Title</label>
                    <input type="text" name="ptitle" value="<?php echo $ptitle?>" />
                </div>
                
                <div class="form-control">
                    <label>Product Price</label>
                    <input type="number" step=".01" name="price"  value="<?php echo $price?>"/>
                </div>
                <div class="form-control">
                    <label>Product Description</label>
                    <br>
                    <textarea name="pdescription"  cols="80"  rows="10"><?php echo $pdescription?></textarea>
                </div>
                
                <input type="submit" value="Send" class="btn btn-primary" />
            </form>
        </div>
    </div>
</div>