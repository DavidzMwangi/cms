
<!DOCTYPE html>
<html>
<?php
require_once 'header.php';
?>
<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />-->

<body>

<?php

require_once "config.php";
//                      $results=mysqli_query($db->connect(),$sql);

$DB=new DB_FACADE();




if (isset($_POST['submit'])){
    $cow_id=$_POST['cow'];
    $milking_time=$_POST['milking_time'];
    $amount=$_POST['litres_amount'];


    //initiate the saving process
    require_once 'SaveMilk.php';
    $newRecord=new SaveMilk($cow_id,$milking_time,$amount);

    if ($newRecord->saveMilk()){
        //saved successfully
        $status=true;
    }else{
        //error occurred
        $status=false;
    }

}
?>
<div class="container-fluid">
    <form action="" method="post">

        <?php
        if (isset($status)){
            if ($status){
               ?>
<!--                <div class="row">-->
        <div class="col-offset-4 col-md-4 col-lg-4 col-sm-12  alert-success" >
            <h3>Record Saved successfully</h3>
        </div>
<!--                </div>-->
        <?php
            }else{
                ?>

                <div class="row">
                   <div class="col-md-4 alert-danger">
                       <h3>Error saving the record</h3>
                   </div>
                </div>
        <?php
            }
        }
        ?>
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
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>-->

<script>

$(document).ready(function () {
        $('#cow_name').select2();

    });
</script>
</html>
