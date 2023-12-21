<?php
 session_start();
 if(isset($_SESSION["user"]))
 {
      header("location:home.php");
 }

 // db
 include('db.php');

 if(isset($_POST['submit_new'])){

  $user_name_new=$_POST['user_name_new'];
  $user_email_new=$_POST['user_email_new'];
  $user_password_new=$_POST['user_password_new'];

  $sql=mysqli_query($con,"SELECT * FROM `login` WHERE `email`='$user_email_new'");

  $data_check=mysqli_num_rows($sql);

  if($data_check==0){

    $data_insert_newa="INSERT INTO `login`(`usname`, `email`, `pass`)
    VALUES ('$user_name_new','$user_email_new','$user_password_new')";

    if(mysqli_query($con,$data_insert_newa)){

      $result_newe= " Your rejistration succesfull ";

      echo '<script>alert("Your rejistration succesfull") </script>' ;

    }else{
      
      echo '<script>alert("data insert problem") </script>' ;
    }
   

  }else{
    echo '<script>alert("this email allready exit") </script>' ;
    
  }
   
 }


 ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>BLUE ADMIN</title>



  <link rel="stylesheet" href="css/style.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  <!-- <div id="clouds">
    <div class="cloud x1"></div>
    <div class="cloud x2"></div>
    <div class="cloud x3"></div>
    <div class="cloud x4"></div>
    <div class="cloud x5"></div>
  </div> -->

  <div class="container d-flex justify-content-center flex-wrap">

    <div id="login" class="d-flex align-items-center">

      <form method="post">

        <fieldset class="clearfix">

          <p><span class="fontawesome-user"></span><input type="text" name="user" value="Username" onBlur="if(this.value == '') this.value = 'Username'" onFocus="if(this.value == 'Username') this.value = ''" required></p>
          <!-- JS because of IE support; better: placeholder="Username" -->
          <p><span class="fontawesome-lock"></span><input type="password" name="pass" value="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required></p>
          <!-- JS because of IE support; better: placeholder="Password" -->
          
          <p><input type="submit" name="sub" value="Login"></p>


          <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
              Create An Account
            </button>

            <button type="button" class="btn btn-success py-2"><a class="text-decoration-none text-light" href="../index.php">HOMEPAGE</a></button>
          </div>
         
          <!-- <p>  <h3><a href="../index.php">HOMEPAGE</a></h3><p> -->
        </fieldset>

        <!-- <div class="bottom">  <h3><a href="../index.php">HOMEPAGE</a></h3></div> -->

      </form>
    </div> <!-- end login -->

  </div>

  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Registration</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post">
            <div class="mb-3">
              <input type="text" name="user_name_new" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">
            </div>
            <div class="mb-3">
              <input type="email" name="user_email_new" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
            </div>
            <div class="mb-3">
              <input type="password" name="user_password_new" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" name="submit_new" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>

<?php
  

  if(isset($_POST['sub'])){
   
      // username and password sent from form

     $myusername = $_POST['user'];
     $mypassword = $_POST['pass'];


      $sql="SELECT * FROM `login` WHERE `usname`='$myusername'";




      $result_newa = mysqli_query($con,$sql);
      $data_row=mysqli_fetch_assoc($result_newa);

      $count = mysqli_num_rows($result_newa);
      if($count == 1) {

        $pass = $data_row['pass'];

        if($mypassword==$pass){

          $_SESSION['user'] = $myusername;

          header("location: home.php");

      

        }else{
           $result="Your Password is wrong";
           echo '<script>alert("Your Login  Password is invalid") </script>' ;
        }

     }else {
        echo '<script>alert("Your Login Name  is invalid") </script>' ;
     }


//---------------------------
   

     

    


      

     

      // If result matched $myusername and $mypassword, table row must be 1 row

     
   }
?>
