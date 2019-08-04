<?php 

  $conn = new PDO("mysql:host=localhost;dbname=todoapp","root","root", null); //root nooit online zetten
  $statement = $conn->prepare("select * from collection");
  $statement->execute();
  $collection = $statement->fetchAll();

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>IMDFlix</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  

</body>
</html>