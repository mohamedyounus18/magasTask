<?php
include 'connect.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

if(isset($_POST['stateOption']))
{
    $state = $_POST['stateOption'];
    $sql = mysqli_query($conn, "SELECT DISTINCT District from pincode where StateName = '$state' order by District");

?>
<select name="district">
    <option value="">Select District</option>
    <?php
    while($row = mysqli_fetch_array($sql)){
        ?>
         <option value="<?php echo $row['District'];?>"><?php echo $row['District'];?></option>
         <?php
    }
    ?>
</select>

<?php
}

if(isset($_POST['districtOption']))
{
    $districtOption = $_POST['districtOption'];
    $sql = mysqli_query($conn, "SELECT DISTINCT Pincode from pincode where District = '$districtOption' order by Pincode");

?>
<select name="postal_code">
    <option value="">Select Pincode</option>
    <?php
    while($row = mysqli_fetch_array($sql)){
        ?>
         <option value="<?php echo $row['Pincode'];?>"><?php echo $row['Pincode'];?></option>
         <?php
    }
    ?>
</select>
<?php
}

if(isset($_POST['itemOption']))
{
    $itemOption = $_POST['itemOption'];
    $sql = mysqli_query($conn, "SELECT DISTINCT item_price from mock_data where item_name = '$itemOption' order by item_price");

?>
<select name="price">
    <option value="">Select Price That may Range in size</option>
    <?php
    while($row = mysqli_fetch_array($sql)){
        ?>
         <option value="<?php echo $row['item_price'];?>"><?php echo $row['item_price'];?></option>
         <?php
    }
    ?>
</select>
<?php
}



?>