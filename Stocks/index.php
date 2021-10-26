<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  <title>Stocks of JK</title>
</head>

<body>
<?php 
session_start();
if(isset($_SESSION["accept"])){
?>
  <!-- Bootstrap -->
  <section class="stockadd" style="padding:20px; margin: 20px 100px 20px 100px;">
  <h1 style="background-color:DodgerBlue; font-size:60px;">Add Today's Buy!</h1>
    <div class="mb-3">
      <form method='post' action='adddata.php'>
        <label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Stock</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="stock" placeholder="Dixon" required>
        
        <label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Buy Price</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="buy_price" placeholder="1600" required>    
        
        <label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Quantity</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="quantity" placeholder="100" required>
        
        <label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Buy Date</label>
          <input type="date" class="form-control" id="exampleFormControlInput1" name="buy_date" placeholder="1/1/2100" required>
        
        <label for="exampleFormControlInput1S" class="form-label" style="padding-top:4px;">Account</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="acc_id" placeholder="35" required>

        <div class="d-grid gap-2 col-6 mx-auto" style="padding:20px;" >
          <input type="submit" class="btn btn-primary" id="exampleFormControlInput1" name="add" value="Add Stock">
        </div>
      </form>
    </div>
  </section>

  <!-- for current holdings -->
  <!-- This example requires Tailwind CSS v2.0+ -->
  <form action="#" method="post" align="center">
              <Input type ='Radio' Name ='sort' value='id'>Id &nbsp;&nbsp;&nbsp;&nbsp;
              <Input type ='Radio' Name ='sort' value='stock'>Stock &nbsp;&nbsp;&nbsp;&nbsp;
              <Input type ='Radio' Name ='sort' value='buy_date'>Buy Date &nbsp;&nbsp;&nbsp;&nbsp;
              <Input type ='Radio' Name ='sort' value='acc_id'>Account &nbsp;&nbsp;&nbsp;&nbsp;<br><br>
              <div class="d-grid gap-2 col-6 mx-auto" style="padding:20px;" >
                <input type="submit" class="btn btn-primary" name="sortbtn" value="Sort"><br>
              </div>
            </form>
<h1 style="background-color:DodgerBlue; font-size:40px; text-align:center;"><b>Current Holdings</b></h1>
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" style="font-size:20px;"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Stock
                </th>
                <th scope="col" style="font-size:20px;"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Buy Price
                </th> <th scope="col" style="font-size:20px;"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Quantity
                </th>
                <th scope="col" style="font-size:20px;"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Buy Date
                </th>
                <th scope="col" style="font-size:20px;"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Account
                </th><th scope="col" style="font-size:20px;"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Total Buy Price
                </th>
              </tr>
            </thead>

            <?php 
              $sort = "id";
              if(isset($_POST['sortbtn']))
              {
                $sort = $_POST["sort"];
              }
              $conn = mysqli_connect("sql303.epizy.com","epiz_28680654","48LuWlt7BmaFgz","epiz_28680654_stocks") or die("Failed to connect to MySQL: " . mysqli_connect_error());
              $str = "SELECT * from `stock_buy` ORDER BY `$sort` ";              
              $result = mysqli_query($conn,$str) or die('Dakho mota paye'); 
              $total = 0;
              while($row = mysqli_fetch_array($result)) {
            ?>
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  <?php echo $row['stock']; ?>
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <?php echo $row['buy_price']; ?>
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <?php echo $row['quantity']; ?>
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <?php echo $row['buy_date']; ?>
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <?php 
                $acc = $row['acc_id']; 
                echo '<a href="account.php?id='.$acc.'">'.$acc.'</a>';
                ?>
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <?php echo $row['total_buy_price']; 
                $total += $row['total_buy_price']; ?>
                </th>
                <th scope="col" style="font-size:20px;"class="relative px-6 py-3">
                <?php 
                $id=$row['id'];
                echo '<a href="edit.php?id='.$id.'">Edit</a>';
                ?>
                </th>
                <th scope="col" style="font-size:20px;"class="relative px-6 py-3">
                <?php 
                $id=$row['id'];
                echo '<a href="sell.php?id='.$id.'">Sell</a>';
                ?>
                </th>
              </tr>
            </thead>
            <?php } ?>
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <?php echo $total; ?>
                </th>
                <th scope="col" style="font-size:20px;"class="relative px-6 py-3">
                </th>
              </tr>
            </thead>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

<br><br><hr><br><br>
  <!-- for solded stocks -->
    <!-- This example requires Tailwind CSS v2.0+ -->
<h1 style="background-color:DodgerBlue; font-size:40px; text-align:center;"><b>Your Stock History</b></h1>
  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" style="font-size:20px;"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" style="font-size:20px;">
                  Stock
                </th>
                <th scope="col" style="font-size:20px;" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Buy Price
                </th>
                <th scope="col" style="font-size:20px;" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Quan
                  tity
                </th>
                <th scope="col" style="font-size:20px;" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Buy Date
                </th>
                <th scope="col" style="font-size:20px;"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Acc
                </th>
                <th scope="col" style="font-size:20px;"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Total Price
                </th>
                <th scope="col" style="font-size:20px;"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Sell Price
                </th>
                <th scope="col" style="font-size:20px;"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Total Sell Price
                </th>
                <th scope="col" style="font-size:20px;"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Sell Date
                </th>
                <th scope="col" style="font-size:20px;"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Majuri
                </th>
                <th scope="col" style="font-size:20px;"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Profit
                </th>
                <th scope="col" style="font-size:20px;"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Percen
				  tage
                </th>                <!-- <th scope="col" style="font-size:20px;"class="relative px-6 py-3">
                  Edit  
                </th> -->
              </tr>
            </thead>
            <?php 
              $conn = mysqli_connect("sql303.epizy.com","epiz_28680654","48LuWlt7BmaFgz","epiz_28680654_stocks") or die("Failed to connect to MySQL: " . mysqli_connect_error());
              $str = "SELECT * from `stock_sold`";
              $result = mysqli_query($conn,$str) or die('Dakho mota paye');
              $total_profit = 0;
              $total_majuri = 0;
             
              while($row = mysqli_fetch_array($result)) {
                $percent = $row['profit'] / $row['total_price'];
                $percent = round($percent * 100,2);
            ?>
            <tbody class="bg-white divide-y divide-gray-200">
            
              <tr>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <?php echo $row['stock']; ?>
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <?php echo $row['buy_price']; ?>
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <?php echo $row['quantity']; ?>
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <?php echo $row['buy_date']; ?>
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <?php echo $row['acc_id']; ?>
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <?php echo $row['total_price']; ?>
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <?php echo $row['sell_price']; ?>
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <?php echo $row['total_sell_price']; ?>
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <?php echo $row['sell_date']; ?>
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <?php echo $row['majuri']; $total_majuri += $row['majuri']; ?>
                </th>
                <th scope="col" style="font-size:15px; color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <?php echo $row['profit']; $total_profit += $row['profit']; ?>
                </th>
                <th scope="col" style="font-size:15px; color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <?php echo $percent; ?>
                </th>
                </th>
              </tr>
            
              <?php } ?>
            </tbody>

            <tbody class="bg-white divide-y divide-gray-200">
            
              <tr>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                </th>
                <th scope="col" style="font-size:15px;color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <?php echo $total_majuri; ?>
                </th>
                <th scope="col" style="font-size:15px; color:black"class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                <?php echo $total_profit; ?>
                </th>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php 
}
else{
	?>
    <form method='post' action='confirm.php'>
        <label for="exampleFormControlInput1" class="form-label" style="padding-top:4px;">Stock</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" name="accept" placeholder="Enter Pin" required>
          <div class="d-grid gap-2 col-6 mx-auto" style="padding:20px;" >
          <input type="submit" class="btn btn-primary" id="exampleFormControlInput1" name="login" value="LogIn">
        </div>
      </form>
<?php } ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
