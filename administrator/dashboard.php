<?php
session_start(); 
if(isset($_SESSION['uusername'])){
    echo '<h3>Welcome' . $_SESSION['uusername'] . '</h3>';
    echo '<a href="logout.php">LogOut</a>';
} else {
    echo '<h3>welcome Guest</h1>';
}
?>

    <?php include_once "./header.php"; ?>

    <div class="container">
        <div class="row">
            <div class="col-2">
            Column
            </div>
            <div class="col-8">
            Column
            </div>
            <div class="col-2">
            Column
            </div>
        </div>
    </div>
  </body>
</html>