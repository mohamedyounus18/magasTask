
<?php
include('connect.php');
$sql = mysqli_query($conn, "SELECT *  from customer_info");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
    

</head>
<body>
    <div class="container mt-5 p-3 w-70">

 <table class="table">
    <a href="magas-store" class="btn btn-primary mb-3">Magas Store</a>
    <h4>Display Data</h4>
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Purchase Date</th>
      <th scope="col">Recipient_Name</th>
      <th scope="col">Recipient_Email</th>
      <th scope="col">addr1</th>
      <th scope="col">addr2</th>
      <th scope="col">state</th>
      <th scope="col">district</th>
      <th scope="col">postal_code</th>
      <th scope="col">item</th>
      <th scope="col">quantity</th>
      

    </tr>
  </thead>
  <tbody>
    <?php foreach ($sql as $row) { ?>
    <tr>
      <th scope="row"><?= $row['id'] ?></th>
      <td><?= $row['created_at'] ?></td>
      <td><?= $row['recipient_name'] ?></td>
      <td><?= $row['recipient_email'] ?></td>
      <td><?= $row['addr1'] ?></td>
      <td><?= $row['addr2'] ?></td>
      <td><?= $row['state'] ?></td>
      <td><?= $row['district'] ?></td>
      <td><?= $row['postal_code'] ?></td>
      <td><?= $row['item'] ?></td>
      <td><?= $row['quantity'] ?></td>
      <td>
    </td>
    </tr>
    
    <?php } ?>
  </tbody>
</table>
</div>


</body>
</html>

