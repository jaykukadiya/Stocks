<?php 
    $stock = $_POST['stock'];
    $buy_price = $_POST['buy_price'];
    $quantity = $_POST['quantity'];
    $buy_date = $_POST['buy_date'];
    $acc_id = $_POST['acc_id'];
    $total = (float)$buy_price * (int)$quantity;
    echo $total;
    $balance;

    $conn = mysqli_connect("localhost","root","","stock") or die("Failed to connect to MySQL: " . mysqli_connect_error());
    $str = "INSERT INTO `stock_buy`(`stock`, `buy_price`, `quantity`, `buy_date`, `acc_id`, `total_buy_price`) VALUES ('$stock','$buy_price','$quantity','$buy_date','$acc_id','$total')";
    echo $str;
    mysqli_query($conn,$str) or die('Dakho mota paye');

    $conn = mysqli_connect("localhost","root","","stock") or die("Failed to connect to MySQL: " . mysqli_connect_error());
    $str = "SELECT `balance` FROM `accounts` WHERE `accounts`.`acc_number` = '$acc_id'";
    echo $str;
    $result = mysqli_query($conn,$str) or die('Dakho mota paye');
    while($row = mysqli_fetch_array($result)) {
      $balance = $row['balance'];
    }

    $balance = $balance - $total;
    $conn = mysqli_connect("localhost","root","","stock") or die("Failed to connect to MySQL: " . mysqli_connect_error());
    $str = "UPDATE `accounts` SET `balance` = '$balance' WHERE `accounts`.`acc_number` = '$acc_id'";
    echo $str;
    mysqli_query($conn,$str) or die('Dakho mota paye');

  header("Location: index.php");
?>
