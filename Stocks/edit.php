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

          while($row = mysqli_fetch_array($result)) {
            $stock = $row['stock'];
            $buy_price = $row['buy_price'];
    ?>
      <form method='post' action='edit.php'>
        <label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Stock</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="stock" value="<?php echo $stock; ?>" required>
        
        <label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Buy Price</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="buy_price" value="<?php echo $buy_price; ?>" required>
        
        <label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Quantity</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="quantity" value="<?php echo $row['quantity']; ?>" required>

        <label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Buy Date</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="buy_date" value="<?php echo $row['buy_date']; ?>" required>
        
        <label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Account ID</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="acc_id" value="<?php echo $row['acc_id']; ?>" required>
        
        <div class="d-grid gap-2 col-6 mx-auto" style="padding:20px;" >
            <input type="submit" class="btn btn-primary" id="exampleFormControlInput1" name="Update" value="Update">
        </div>
        <hr>
        <div class="d-grid gap-2 col-6 mx-auto" style="padding:20px;" >
            <input type="submit" class="btn btn-primary" id="exampleFormControlInput1" name="Delete" value="Delete">
        </div>
        <?php }
        $str = "DELETE FROM `stock_buy` WHERE id='$id' ";
        mysqli_query($conn,$str) or die('Dakho mota paye');
        ?>
      </form>
    </div>
  </section>

  <?php
    if(isset($_POST['Update'])){
        $stock = $_POST['stock'];
        $buy_price = $_POST['buy_price'];
        $quantity = $_POST['quantity'];
        $buy_date = $_POST['buy_date'];
        $acc_id = $_POST['acc_id'];
        $total = (float)$buy_price * (int)$quantity;
        echo $total;
      
      $str = "INSERT INTO `stock_buy`(`stock`, `buy_price`, `quantity`, `buy_date`, `acc_id`, `total_buy_price`) VALUES ('$stock','$buy_price','$quantity','$buy_date','$acc_id','$total')";
      mysqli_query($conn,$str) or die('Dakho mota paye');
      
      header("Location: index.php");
    }

    else if(isset($_POST['Delete'])){
      $str = "DELETE FROM `stock_buy` WHERE id='$id' ";
        mysqli_query($conn,$str) or die('Dakho mota paye');
      header("Location: index.php");  
    }
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>