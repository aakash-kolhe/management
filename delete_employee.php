<?php
	include 'config.php';

	$id = $_GET['id'];

	$query = "DELETE FROM employees WHERE id = $id";

	$result = mysqli_query($conn, $query);

	if($result){
		?>
		<script>
          alert("data Succefully Deleted");
          window.location.href="employee_list.php";
        </script>
        <?php
	}

?>