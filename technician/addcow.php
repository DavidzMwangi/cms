<?php
require_once 'authcontroller.php';
?>
<?php
require_once 'Cow.php';

if (isset($_POST['btn-add'])){
  $id = $_POST ['id'];
  $name = $_POST ['name'];
  $breed = $_POST ['breed'];
  $date = $_POST ['dob'];
  $dob = date_format(date_create ($date),"Y-m-d");

  $cow = new Cow($id,$name,$breed,$dob);

  if ($cow->add()){
   $success[] = "Added Successfully";
  }else{
    $success[] = "Failed";
  }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
    integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  </head>
  <body>
<div class="container" style="margin-top:30px;">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <?php
      if (isset($success)) {
        foreach ($success as $key) {
          ?>
           <div class="alert alert-success">
             <h6><?= $key ?></h6>
           </div>
          <?php
        }
      }
       ?>
      <div class="card">
        <div class="card-header bg-primary text-white"><h3>Add Cow</h3></div>
        <div class="card-body">

            <form method="post">
              <div class="form-group">
                <input type="text" name="id" placeholder=" ID" class="form-control" required/>
              </div>

              <div class="form-group">
                <input type="text" name="name" placeholder=" Name" class="form-control" required/>
              </div>
              <div class="form-group">
                <input type="text" name="breed" placeholder=" Breed" class="form-control" required/>
              </div>
              <div class="form-group">
                <input type="date" name="dob" placeholder=" Date of birth" class="form-control" required/>
              </div>
              <div class="form-group">
                <button class="btn btn-primary" name="btn-add">Submit</button>
              </div>

            </form>
        </div>
      </div>

    </div>
  </div>
</div>

    <!--  -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
     integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
    integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>
