<!DOCTYPE html>  
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mr. Kimbob - Login</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
  <link rel = "stylesheet" type = "text/css" href = "index.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css" rel="stylesheet"/>
<style>
.center {
  display: block;
  margin-left: 300px;
  margin-right: auto;
  margin-top:10px;
  width: 100%;
}
fieldset {
  background-color: #eeeeee;
}

legend {
  background-color: gray;
  color: white;
  padding: 5px 10px;
}

input {
  margin: 5px;
}
</style>
</head>
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"
></script>
<?php
session_start();
?>
<body style = "background-image: linear-gradient(#323232 , #696969);">
<br><br>
           <section class=" text-center text-lg-start">
  <div class="card mb-3">
    <div class="row g-0 d-flex align-items-center">
      <div class="col-lg-4 d-none d-lg-flex">
        <img src="kimbobfood.jpg" alt="Mr. Kimbob"
          class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" 
		  width="950" height="600"/>
		  <br>
		  <img src="kimbobpic-horizontal.jpg" alt="Mr.Kimbob" width="450" height="150" class = "center"/>
		  <div style="position:absolute;">
		  <ul class="list-unstyled">
  <li style ="margin-left: 730px; margin-top:170px;">Mr. Kimbob®'s all-time favorite dish is a Bibimbob®. It's a delicious combination of rice,</li>
  <li style ="margin-left: 780px;margin-top:5px;">meat, and vegetables, which creates a beautiful arrangement of colors.</li>
		  </ul></div>
		  <br>
      </div>
      <div class="col-lg-8">
        <div class="card-body py-5 px-md-5">
          <form method = "POST">
		  <br><br><br><br><br><br><br><br><br>
            <!-- Email input -->
			<fieldset><legend>Log in to your account!</legend>
            <div class="form-outline mb-4">
              <input type="text" name="username" id="form2Example1" class="form-control"/>
              <label class="form-label" for="form2Example1">Username</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
              <input type="password" name="password" id="form2Example2" class="form-control"/>
              <label class="form-label" for="form2Example2">Password</label>
           

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
              <div class="col d-flex justify-content-center">
                <!-- Checkbox -->
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                  <label class="form-check-label" for="form2Example31"> Remember me </label>
                </div>
              </div>

              <div class="col">
                <!-- Simple link -->
                <a href="#!">Forgot password?</a>
              </div>
            </div>

            <!-- Submit button -->
            <input type="submit" name="submit" class="btn btn-successful btn-block mb-4" style = "background-image: linear-gradient(#00AB08 , #4DED30); color:white;" value = "Sign in →">
          </fieldset>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>
</body>	
</html>
			<?php
include 'db_connection.php';
if(isset($_POST['submit'])){
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
$sql = "SELECT * FROM tbl_acc WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $sql);
	if(mysqli_num_rows($result)=== 1){
		$row = mysqli_fetch_assoc($result);
		if($row['username']===$username && $row['password']===$password && $row['status']==='admin'){
   $_SESSION['status'] = "admin";
   $_SESSION['username'] = $username;
			header("Location: homeadmin.php");
			echo "successful";
		}
		else if($row['username']===$username && $row['password']===$password && $row['status']==='employee'){
   $_SESSION['status'] = "employee";
   $_SESSION['username'] = $username;
			header("Location:pos.php");
			echo "successful";
		}
		else 
		{
			header("Location: login.php?error=Username or Password is incorrect");
		}
	}
	else {header("Location: login.php?error=Username or Password is incorrect");
	exit();
	}
}

?> 