<?php
  include 'include/header.php';

  include 'include/navbar.php';
  include 'include/sidebar.php';
?>

<?php
  include 'config.php';

  $error = '';
  $id = $_GET['id'];
  if(isset($_POST['update']))
  {
    if(empty($_POST['username'])){
      $error .= "name can not be blank<br>";
    }else{
      $name = $_POST['username'];
    }

    if(empty($_POST['email'])){
      $error .= "email can not be blank<br>";
    }else{
      $email = $_POST['email'];
    }

    if(empty($_POST['mobile'])){
      $error .= "mobile can not be blank<br>";
    }else{
      $mobile = $_POST['mobile'];
    }

    if(empty($_POST['gender'])){
      $error .= "Please select gender<br>";
    }else{
      $gender = $_POST['gender'];
    }

    if($error == ''){
      $sql = "UPDATE employees SET name = '$name', email = '$email', mobile = '$mobile', gender ='$gender' WHERE id=$id";

      // $skill_id = "SELECT employee_id FROM employees_skills";

      // echo $skill_id;exit;

      $result = mysqli_query($conn, $sql);

      $sql2 = "DELETE FROM employees_skills WHERE employee_id=$id";

      $res2 = mysqli_query($conn, $sql2);

      // print_r($sql2);exit;

      if(!empty($_POST['skills'])){
          foreach ($_POST['skills'] as $key => $value) {
            $query1 = "INSERT INTO employees_skills(employee_id, skill_id) VALUES('$id', '$value')";
            mysqli_query($conn, $query1);
          }
        }

      ?>
        <script>
          alert("data updated succeffully");
          window.location.href="employee_list.php";
        </script>
      <?php 
    }
  }

?>

<?php
  $id = $_GET['id'];
  $sql = "SELECT * FROM employees WHERE id = $id";
  $query = mysqli_query($conn, $sql);

  $res = mysqli_fetch_array($query);

?>

<?php
  $id = $_GET['id'];
  $sql2 = "SELECT * FROM employees_skills WHERE employee_id =$id";
  $query2 = mysqli_query($conn, $sql2);

  // $res2 = mysqli_fetch_array($query2);
  
  $checked1=$checked2=$checked3=$checked4= '';
  while ($row = mysqli_fetch_array($query2)) {
    
    $skill_id = $row['skill_id'];
    
    if($skill_id == 1){
      $checked1 = 'checked';
    }elseif($skill_id == 2){
      $checked2 = 'checked';
    }elseif($skill_id == 3){
      $checked3 = 'checked';
    }elseif($skill_id == 4){
      $checked4 = 'checked';
    }
    
  }

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>General Form</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Employee</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body row">
                  <div class="text-danger col-md-12"><?php echo $error; ?></div>
                  <div class="form-group col-md-6">
                    <label for="username">User Name</label>
                    <input type="text" class="form-control" value="<?php echo $res['name'];?>" id="username" name="username" placeholder="Enter email" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" value="<?php echo $res['email'];?>" name="email" id="email" placeholder="Enter email" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="mobile">Mobile</label>
                    <input type="number" name="mobile" class="form-control" value="<?php echo $res['mobile'];?>" id="mobile" placeholder="mobile" required>
                  </div>


                  <div class="form-group col-md-6">
                    <label for="gender">Select Gender</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="1" <?php if($res['gender']=="1"){ echo "checked";}?>>
                      <label class="form-check-label" for="exampleRadios1">
                        Male
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="2" <?php if($res['gender']=="2"){ echo "checked";}?>>
                      <label class="form-check-label" for="exampleRadios2">
                        Female
                      </label>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="email">Skills</label>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="skills[]" value="1" id="flexCheckDefault" <?=$checked1?> >
                      <label class="form-check-label" for="flexCheckDefault">
                        Android
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="skills[]" value="2" id="flexCheckChecked" <?=$checked2?>>
                      <label class="form-check-label" for="flexCheckChecked">
                        Java
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="skills[]" value="3" id="flexCheckChecked" <?=$checked3?> >
                      <label class="form-check-label" for="flexCheckChecked">
                        iOS
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="skills[]" value="4" id="flexCheckChecked" <?=$checked4?> >
                      <label class="form-check-label" for="flexCheckChecked">
                        PHP
                      </label>
                    </div>
                  </div>
                <!-- /.card-body -->

                <div class="col-md-12">
                  <button type="submit" name="update" class="btn btn-primary">Update</button>
                  <a class="btn btn-danger" href="employee_list.php">Back</a>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
  include 'include/footer.php';
?>