<?php
  include 'include/header.php';
  include 'include/navbar.php';
  include 'include/sidebar.php';
?>

<?php
  
  
?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Employee List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Employee List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage Employee</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <a class="btn btn-primary" href="add_employee.php">Add Employee</a>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr no.</th>
                    <th>UserName</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Gender</th>
                    <th>Skills</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      include 'config.php';

                      $sr = 0;
                      $sql = "SELECT * FROM employees";

                      $result = mysqli_query($conn, $sql);

                      // print_r($result);exit;
                      while ($res = mysqli_fetch_array($result)) {
                        
                    ?>

                  <tr>
                    <td><?php echo ++$sr; ?></td>
                    <td><?php echo $res['name']; ?></td>
                    <td><?php echo $res['email']; ?></td>
                    <td><?php echo $res['mobile']; ?></td>
                    <td>
                      <?php 
                        if($res['gender']==1){
                          echo "Male";
                        }else{
                          echo "Female";
                        }
                      ?>
                    </td>
                    <td>
                      <?php 
                        $sql1 = "SELECT * FROM employees_skills WHERE employee_id = ".$res['id']."";

                        $query1 = mysqli_query($conn, $sql1);

                        while($res1 = mysqli_fetch_array($query1)){
                          if ($res1['skill_id'] == 1) {
                            echo "Android ,";
                          }elseif($res1['skill_id'] == 2){
                            echo "Java ,";
                          }elseif($res1['skill_id'] == 3){
                            echo "iOS ,";
                          }elseif($res1['skill_id'] == 4){
                            echo "PHP ";
                          }
                        }
                      ?>
                    </td>
                    <td>
                      <a class="btn text-primary" href="edit_employee.php?id=<?php echo $res['id']; ?>"><i class="fas fa-edit"></i></a>
                      <a class="btn text-danger" href="delete_employee.php?id=<?php echo $res['id']; ?>"><i class="far fa-trash-alt"></i></a>
                    </td>
                  </tr>
                <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php
  include 'include/footer.php';
?>