<?php
 $pdo = new PDO('mysql:host=localhost;port=3306;dbname=mysitephp','root','');
 // 데이타베이스연결에 에러가있는지 확인한다.
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


 ?>
 