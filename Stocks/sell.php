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
  <h1 style="background-color:DodgerBlue; font-size:60px;">Add Today's Sell!</h1>
    <div class="mb-3">
    <?php 
    $requestType = $_SERVER['REQUEST_METHOD'];
    $id = 1;
    if($requestType == 'GET'){ 
        $id = $_GET['id'];
    }
          $conn = mysqli_connect("localhost","root","","stock") or die("Failed to connect to MySQL: " . mysqli_connect_error());
          $str = "SELECT * from `stock_buy` where id='$id' ";
          $result = mysqli_query($conn,$str) or die('Dakho mota paye'); 
          $stock;
          $buy_price;
          $quantity;
          $buy_date;
          $acc_id;
          while($row = mysqli_fetch_array($result)) {
            $stock = $row['stock'];
            $buy_price = $row['buy_price'];
            $quantity = $row['quantity'];
            $buy_date = $row['buy_date'];
            $acc_id = $row['acc_id'];
          
    ?>
      <form method='post' action='sell.php'>
        <label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Stock</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="stock" value="<?php echo $stock; ?>" required>
        
        <label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Buy Price</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="buy_price" value="<?php echo $buy_price; ?>" required>
        
        <label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Quantity</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="quantity" value="<?php echo $quantity; ?>" required>

        <label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Buy Date</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="buy_date" value="<?php echo $buy_date; ?>" required>
        
        <label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Account ID</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="acc_id" value="<?php echo $acc_id; ?>" required>
        
        <label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Sell Price</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="sell_price" placeholder="3200" required>
        
        <label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Sell Quantity</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="sell_quan" placeholder="30" required>
        
        <label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Sell Date</label>
          <input type="date" class="form-control" id="exampleFormControlInput1" name="sell_date" placeholder="1/1/2100" required>
        
        <div class="d-grid gap-2 col-6 mx-auto" style="padding:20px;" >
            <input type="submit" class="btn btn-primary" id="exampleFormControlInput1" name="Sold" value="Sold">
        </div>
        <?php }
         $str = "DELETE FROM `stock_buy` WHERE id='$id' ";
         mysqli_query($conn,$str) or die('Dakho mota paye'); 
        ?>
      </form>
    </div>
  </section>

  <?php
    if(isset($_POST['Sold'])){
      $stock = $_POST['stock'];
      $buy_price = $_POST['buy_price'];
      $quantity = $_POST['quantity'];
      $buy_date = $_POST['buy_date'];
      $acc_id = $_POST['acc_id'];
      $totalbuy = (float)$buy_price * (int)$quantity;
      $sell_price = $_POST['sell_price'];
      $sell_date = $_POST['sell_date'];
      $sell_quan = $_POST['sell_quan'];
      $totalsell = (float)$sell_price * (int)$sell_quan;
      $majuri = ((float)$sell_price*(0.5/100) + (float)$buy_price*(0.5/100)) * (int)$sell_quan ;
      $profit = (float)$totalsell - (float)$totalbuy - (float)$majuri;
    
    
    $str = "INSERT INTO `stock_sold`(`stock`, `buy_price`, `quantity`, `buy_date`, `acc_id`, `total_price`, `sell_price`, `total_sell_price`, `sell_date`, `majuri`, `profit`) VALUES ('$stock','$buy_price','$quantity','$buy_date','$acc_id','$totalbuy','$sell_price','$totalsell','$sell_date','$majuri','$profit')";
    mysqli_query($conn,$str) or die('Dakho mota paye');

    $conn = mysqli_connect("localhost","root","","stock") or die("Failed to connect to MySQL: " . mysqli_connect_error());
    $str = "SELECT `balance` FROM `accounts` WHERE `accounts`.`acc_number` = '$acc_id'";
    echo $str;
    $result = mysqli_query($conn,$str) or die('Dakho mota paye');
    while($row = mysqli_fetch_array($result)) {
      $balance = $row['balance'];
    }

    $balance = $balance + $totalsell - $majuri;
    $conn = mysqli_connect("localhost","root","","stock") or die("Failed to connect to MySQL: " . mysqli_connect_error());
    $str = "UPDATE `accounts` SET `balance` = '$balance' WHERE `accounts`.`acc_number` = '$acc_id'";
    echo $str;
    mysqli_query($conn,$str) or die('Dakho mota paye');

    header("Location: index.php");
  }
?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>