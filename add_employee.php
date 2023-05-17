<?php
  include 'include/header.php';

  include 'include/navbar.php';
  include 'include/sidebar.php';
?>

<?php
  include 'config.php';

    $error = '';
  if(isset($_POST['submit'])){

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
      $error .= "please select gender<br>";
    }else{
      $gender = $_POST['gender'];
    }

    if($error == ''){
      $sql = "INSERT INTO employees(name, email, mobile, gender) VALUES('$name', '$email', '$mobile', '$gender')";

      $result = mysqli_query($conn, $sql);

      if($result){
        $last_id = $conn->insert_id;
        if(!empty($_POST['skills'])){
          foreach ($_POST['skills'] as $key => $value) {
            $query = "INSERT INTO employees_skills(employee_id, skill_id) VALUES('$last_id', '$value')";
            mysqli_query($conn, $query);
          }
        }
        ?>
        <script>
          alert("data Succefully saved");
          window.location.href="employee_list.php";
        </script>
        <?php
      }
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
                <h3 class="card-title">Add Employee</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post">
                <div class="card-body row">
                  <div class="text-danger col-md-12"><?php echo $error; ?></div>
                  <div class="form-group col-md-6">
                    <label for="username">User Name</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter email" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="mobile">Mobile</label>
                    <input type="number" name="mobile" class="form-control" id="mobile" placeholder="mobile" required>
                  </div>


                  <div class="form-group col-md-6">
                    <label for="gender">Select Gender</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="exampleRadios1" value="1">
                      <label class="form-check-label" for="exampleRadios1">
                        Male
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="gender" id="exampleRadios2" value="2">
                      <label class="form-check-label" for="exampleRadios2">
                        Female
                      </label>
                    </div>
                  </div>


                  <div class="form-group col-md-6">
                    <label for="email">Skills</label>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="skills[]" value="1" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                        Android
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="skills[]" value="2" id="flexCheckChecked">
                      <label class="form-check-label" for="flexCheckChecked">
                        Java
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="skills[]" value="3" id="flexCheckChecked">
                      <label class="form-check-label" for="flexCheckChecked">
                        iOS
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="skills[]" value="4" id="flexCheckChecked">
                      <label class="form-check-label" for="flexCheckChecked">
                        PHP
                      </label>
                    </div>
                  </div>
                <!-- /.card-body -->

                <div class="col-md-12">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>

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