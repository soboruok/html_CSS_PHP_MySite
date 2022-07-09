<?php
  $pdo = new PDO('mysql:host=localhost;port=3306;dbname=mysitephp','root','');
  // 데이타베이스연결에 에러가있는지 확인한다.
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


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
    <link rel="stylesheet" href="css/common.css" />
    <link rel="stylesheet" href="css/index.css" />
    <link rel="stylesheet" href="css/sub.css" />
    <title>MySite</title>
  </head>
  <body>
    <div class="navbar">
      <div class="container flex">
        <h1 class="logo"><img src="images/logo.png" alt="" /></h1>
        <nav>
          <ul>
            <li><a href="index.html">#</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="work.html">Work</a></li>
          </ul>
        </nav>
      </div>
    </div>

     <!-- Head -->
     <div class="work__head py-3">
      <div class="container grid">
        <div class="head__text">
          <h1 class="xl">Work</h1>
          <p class="lead">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
          </p>
        </div>
        <div class="head__img">
          <a href="#"><i class="fa-solid fa-circle-nodes"></i></a>
        </div>
      </div>
    </div>

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
                <th>Title</th>
                <th>Price</th>
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
                  <td><?php echo $product['created_date'] ?></td>
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
    

    

    <!-- footer -->
    <div class="footer ">
      <div class="container grid grid-3">
        <div class="copyright">
            <h1 class="logo"><img src="images/logo.png" alt="" /></h1>
          <p>Copyright &copy; 2022</p>
        </div>
        <nav>
          <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="work.html">Work</a></li>
          </ul>
        </nav>
        <div class="social">
          <a href="#"><i class="fab fa-github fa-2x"></i></a>
          <a href="#"><i class="fab fa-facebook fa-2x"></i></a>
          <a href="#"><i class="fab fa-instagram fa-2x"></i></a>
          <a href="#"><i class="fab fa-twitter fa-2x"></i></a>
        </div>
      </div>
    </div>
  </body>
</html>
