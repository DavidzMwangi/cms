
<!DOCTYPE html>
<html>
<?php
require_once 'header.php';
?>

<body>

<?php

require_once "config.php";
//                      $results=mysqli_query($db->connect(),$sql);

$DB=new DB_FACADE();


?>
<div class="container-fluid">
    <form action="save_milk.php" method="post">
<div class="row">
    <div class="col-md-4 col-sm-12 col-lg-4">
        <label for="cow_name">Cow Name</label>
        <select id="cow_name" name="cow" class="form-control" required>
            <option selected disabled>Select a cow</option>
            <?php
            $sql="SELECT id,nick_name FROM cows ";
            $results=mysqli_query($DB->connect(),$sql);
            while ($row = mysqli_fetch_array($results)) {
                echo "<option value='$row[0]'>$row[1]</option>";
            }

            //            foreach ($cow_records as $cow_record){
//                echo '<option value='.$cow_record->id .'>'.$cow_record->name .'</option>';
//            }
            ?>
<!--            <option >Ngombe</option>-->
        </select>
    </div>

    <div class="col-md-4 col-sm-12 col-lg-4">
        <label for="cow_name">Milking Time</label>
        <select id="cow_name" name="milking_time" class="form-control" required>
            <option selected disabled>Select Milking Time</option>
            <option value="1" >Morning</option>
            <option value="2">Evening</option>
        </select>
    </div>


    <div class="col-md-4 col-sm-12 col-lg-4">
        <label for="cow_name">Amount in litres</label>
        <input class="form-control" placeholder="Milk Produced (ltrs)" name="litres_amount" type="number" required>
    </div>
</div>
<p></p>
    <div class="row">
           <div class="col-md-4 col-sm-12 col-lg-4">
               <button class="btn btn-success" name="submit" type="submit">Save</button>
           </div>


        </div>

    </form>
</div>

</body>
<?php
include_once 'footer.php';
?>
