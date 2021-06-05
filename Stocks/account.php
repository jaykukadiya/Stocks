<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>Stock</title>
</head>

<body>
<section class="stockadd" style="padding:20px; margin: 20px 100px 20px 100px;">
  <h1 style="background-color:DodgerBlue; font-size:60px;">Account Details</h1>
    <div class="mb-3">
    <?php 
    $requestType = $_SERVER['REQUEST_METHOD'];
    $id = 35;
    if($requestType == 'GET'){ 
        $id = $_GET['id'];
    }
		  $conn = mysqli_connect("localhost","root","","stock") or die("Failed to connect to MySQL: " . mysqli_connect_error());
          $str = "SELECT * FROM `accounts` where acc_number=".$id." ";
          $result = mysqli_query($conn,$str) or die('Dakho mota paye');

          while($row = mysqli_fetch_array($result)) {
    ?>
	<form method='post' action='account.php'>
		<label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Acc Number</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="acc" value="<?php echo $row['acc_number']; ?>">
        
        <label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Person Name</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="name" value="<?php echo $row['person_name']; ?>">
        
        <label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Current Balance</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name="bal" value="<?php echo $row['balance']; ?>">
		
		<div class="d-grid gap-2 col-6 mx-auto" style="padding:20px;" >
            <input type="submit" class="btn btn-primary" id="exampleFormControlInput1" name="Update" value="Update">
        </div>
	</form>
      <?php } ?>
    </div>
  </section>
<?php
    if(isset($_POST['Update'])){
        $acc = $_POST['acc'];
        $name = $_POST['name'];
        $bal = $_POST['bal'];
        echo $acc."<br>";
		echo $bal;
      $str = "UPDATE `accounts` SET `balance` = ".$bal." WHERE `accounts`.`acc_number` = ".$acc;

      mysqli_query($conn,$str) or die('Dakho mota paye');
      
      header("Location: index.php");
    }
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>