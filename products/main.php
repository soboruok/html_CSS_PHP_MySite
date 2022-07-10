<?php
  /**@var $pdo \PDO */
  require_once "../lib/database.php";


  $search = $_GET['search'] ?? '';
  if($search){
    $statement=$pdo->prepare('select * from products WHERE ptitle LIKE :title order by created_date DESC');
    $statement->bindValue(':title', "%$search%");
  } else {
    $statement=$pdo->prepare('select * from products order by created_date DESC');
  }

  $statement->execute();
  $products=$statement->fetchAll(PDO::FETCH_ASSOC);


  
?>

    <?php include_once "./layout/header.php"; ?>

    <!-- main -->
    <div class="main__productList py-3">
      <div class="container flex">
        <div class="productList">
            <!-- Search -->
            <form>
              <div style="display: flex;justify-content:flex-end;margin-bottom:5px;">
                <input type="text" placeholder="Search" name="search" value="<?php echo $search;  ?>" style="margin-right:5px;"/>
                <button class="btn btn-secondary" type="submit">Search</button>
              </div>
            </form>
            <table className="text-center">
              <thead>
              <tr>
                <th>#</th>
                <th>Image</th>
                <th>Price</th>
                <th>Title</th>
                <th>Create Date</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                <?php foreach($products as $product) { ?>
                <tr>
                  <td></td>
                  <td><img src="<?php echo $product['image'] ?>" style="width:80px" /></td>
                  <td><?php echo $product['price'] ?></td>
                  <td><?php echo $product['ptitle'] ?></td>
                  <td><?php echo substr($product['created_date'],0, 10) ?></td>
                  <td>
                    <div style="display:flex;justify-content:flex-end;">
                      <a href="update.php?pid=<?php echo $product['pid'] ?>">Edit</a>
                      <form method="post" action="delete.php">
                        <input type="hidden" name="pid" value="<?php echo $product['pid'] ?>" />
                        <button type="submit" class="btn btn-light">Delete</button>
                      </form>
                    </div>
                  </td>
                </tr>
               <?php } ?>
              </tbody>
            </table>
            <p><a href="create.php" class="btn btn-primary">Create Product</a></p>
        </div>
      </div>
    </div>
    

    

<?php include_once "./layout/footer.php"; ?>