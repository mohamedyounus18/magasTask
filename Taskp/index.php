<?php
include 'connect.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if (isset($_POST['submit'])) {
    if (empty($_POST["recipient_name"])) {
      $nameErr = "Name is required";
    } else {
      $name = test_input($_POST["recipient_name"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        $nameErr = "Only letters and white space allowed";
      }
    }
    if (empty($_POST["recipient_email"])) {
        $emailErr = "Email is required";
      } else {
        $email = test_input($_POST["recipient_email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "Invalid email format";
        }
      }
      if (empty($_POST["website"])) {
        $website = "";
      } else {
        $website = test_input($_POST["website"]);
        // check if URL address syntax is valid
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
          $websiteErr = "Invalid URL";
        }    
      }
      if(!$nameErr and !$emailErr)
      {
      //HTML_INPUTS
$recipient_name = $_POST['recipient_name'];
$recipient_email = $_POST['recipient_email'];
$addr1 = $_POST['addr1'];
$addr2 = $_POST['addr2'];
$state = $_POST['state'];
$district = $_POST['district'];
$postal_code = $_POST['postal_code'];
$item = $_POST['item'];
$quantity = $_POST['quantity'];



// insert method

//SQL_QUERY
$data_input_query =  "insert into customer_info(recipient_name,recipient_email,addr1,addr2,state,district,postal_code,item,quantity)
values('$recipient_name','$recipient_email','$addr1','$addr2','$state','$district','$postal_code','$item','$quantity')";
$validate_result = mysqli_query($conn,$data_input_query);

 if($validate_result == true){

            echo "success";

 }
}

    
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>www.mgform.com</title>

    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<!-- MultiStep Form --> 
<div class="row">
    <div class="wrapper">  
    <form id="msform" name="form" action="#"  method="post" auto_complte="off">  
            <!-- fieldsets -->
            <fieldset>
                <h2 class="fs-title" id="demo">Welcome to MAGAS store</h2>
                <!-- <h3 class="fs-subtitle">Tell us something more about you</h3> -->
                <input type="text" name="recipient_name" value="<?php echo $name ?>" placeholder="Kindly Enter Your First Name"/>
                <span  style="color:red" class="error"><?php echo $nameErr;?></span>
                <br><br>                
                <input type="email" name="recipient_email" value="<?php echo $email ?>" placeholder="Kindly Enter Your Email"/>
                <span style="color:red" class="error"><?php echo $emailErr;?></span>
                <br><br>
                <input type="text" name="addr1" placeholder="Kindly Enter Your Address 1" />
                <input type="text" name="addr2" placeholder="Kindly Enter Your Addrress 2" />
              
                <select class="col-3" name="state" id="state" >
                    <option selected="selected" name="state" value="">Select State</option> 
                    <?php
                    $sql = mysqli_query($conn, "SELECT DISTINCT StateName 
                               FROM pincode ORDER BY StateName ASC");
                            while($row = mysqli_fetch_array($sql)){ ?>
                    <option value="<?php echo $row['StateName'];?>"><?php echo $row['StateName'];?></option> 
                       <?php } ?>        
                </select>

                <select class="col-3" name="district" id="district" >  
                    <option selected="selected">District</option> 
             </select>

                <select class="col-3" name="postal_code" id="postal_code" >
                <option selected="selected">Postal Code</option> 
                </select>

                <select  name="item" id="item" >
                <option selected="selected">Kindly Choose The Item</option>
                <?php
                    $sql = mysqli_query($conn, "SELECT item_name  
                               FROM mock_data ORDER BY item_name ASC");
                            while($row = mysqli_fetch_array($sql)){ ?>
                    <option value="<?php echo $row['item_name'];?>"><?php echo $row['item_name'];?></option> 
                       <?php } ?>    
                </select>

                <input onchange="myFunction()" type="number" min="0" max="50" id="qty" name="quantity" placeholder="Item Quantity"/>

                <select class="col-3" onchange="myFunction()" name="price" id="price" >
                <option selected="selected">Price</option> 
                </select>

                <p id="total"></p>

                <input type="submit" name="submit" id="sub" class="next action-button" value="Submit"/>
                <a href="logcheck.php"><button type="button"  class="next action-button" value="Display">Display</button></a>

            </fieldset>
        </form>

</div>
</div>

 <script>
        $(document).ready(function () {

$('#state').change(function () {
    var stateOption = $(this).val();
   
        $.ajax({
            url: "queries.php",
            method: "POST",
            data: { stateOption: stateOption },
            success: function (data) {
                $('#district').html(data);
                $('#pincode').html('<option value="">Select Pincode</option>');
            }
        });
    });


$('#district').change(function () {
    var districtOption = $(this).val();

        $.ajax({
            url: "queries.php",
            method: "POST",
            data: { districtOption: districtOption },
            success: function (data) {
                $('#postal_code').html(data);
            } 
        });
       
});

$('#item').change(function () {
    var itemOption = $(this).val();

        $.ajax({
            url: "queries.php",
            method: "POST",
            data: { itemOption: itemOption },
            success: function (data) {
                $('#price').html(data);
            } 
        });
       
});

});

</script>
 
<script>
function myFunction() {

  var x = document.getElementById("price").value;
  var y = document.getElementById("qty").value;
  var z = x*y
  document.getElementById("total").innerHTML = "Sum of Your Order: " + z;
}
</script>

</body>
</html>