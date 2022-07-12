<?php 
 session_start();
 if(!isset($_SESSION["uusername"])){
     header("location:login.php");
 }

require_once "../lib/database.php";


$search = $_GET['search'] ?? '';
$year = $_GET['year'] ?? '';

if(((!empty($search)) && (!empty($year)))){
  $statement=$pdo->prepare('select * from tax WHERE section LIKE :section or category LIKE :category or regdate LIKE :regdate order by regdate DESC');
  $statement->bindValue(':section', "%$search%");
  $statement->bindValue(':category', "%$search%");
  $statement->bindValue(':regdate', "%$year%");
} else if((!empty($search))){
    $statement=$pdo->prepare('select * from tax WHERE section LIKE :section or category LIKE :category order by regdate DESC');
    $statement->bindValue(':section', "%$search%");
    $statement->bindValue(':category', "%$search%");
} else if((!empty($year))){
    $statement=$pdo->prepare('select * from tax WHERE regdate LIKE :regdate order by regdate DESC');
    $statement->bindValue(':regdate', "%$year%");
} else if((!empty($category))){
    $statement=$pdo->prepare('select * from tax order by category DESC');

}  else {
    $statement=$pdo->prepare('select * from tax order by regdate DESC');
    
}

$statement->execute();
$taxes=$statement->fetchAll(PDO::FETCH_ASSOC);

include_once "./header.php"; 
?>

    <div class="admin__list my-4">
        <div class="container grid">
            <div class="card p-3">
                <nav>
                    <ul>
                        <li>
                        <?php 
                        if(isset($_SESSION['uusername'])){
                            echo '<p>Welcome'.' ' . $_SESSION['uusername'] . '</p>';
                            echo '<a href="logout.php">Logout</a>';
                        } else {
                            echo '<p>welcome Guest</p>';
                            echo '<a href="signup.php">Signup</a>';
                        }
                        ?>
                        </li>
                        <li><a href="<?php echo $_SERVER['PHP_SELF']?>?year=<?php echo date("Y"); ?>"><?php echo date("Y"); ?></a></li>
                        <li><a href="<?php echo $_SERVER['PHP_SELF']?>?year=2021">2021</a></li>
                        <li><a href="<?php echo $_SERVER['PHP_SELF']?>?year=2020">2020</a></li>
                        <li><a href="<?php echo $_SERVER['PHP_SELF']?>?year=2019">2019</a></li>
                        <li><a href="<?php echo $_SERVER['PHP_SELF']?>?year=2018">2018</a></li>
                        <li><a href="<?php echo $_SERVER['PHP_SELF']?>?year=2017">2017</a></li>
                    </ul>
                </nav>
                <a href="create.php" class="btn btn-primary">Add</a>
            </div>

            <div class="card p-3">
                <!-- Search -->
                <h3>* Search by <u>Category</u> or <u>Section</u> </h3>
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
                            <th>Category</th>
                            <th>Section</th>
                            <th>Qty</th>
                            <th>Unit</th>
                            <th>Total</th>
                            <th>Shop</th>
                            <th>Regdate</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($taxes as $tax) { ?>
                        <tr>
                            <td></td>
                            <td><?php echo $tax['category'] ?></td>
                            <td><?php echo $tax['section'] ?></td>
                            <td><?php echo $tax['qty'] ?></td>
                            <td><?php echo $tax['unit'] ?></td>
                            <td><?php echo $tax['total'] ?></td>
                            <td><?php echo $tax['shop'] ?></td>
                            <td><?php echo substr($tax['regdate'],0, 10) ?></td>
                            <td>
                                <!-- <a href="update.php?idtax=<?php echo $tax['idtax '] ?>">Edit</a> -->
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </body>
</html>