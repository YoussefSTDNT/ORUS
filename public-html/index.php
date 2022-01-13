<?php 
session_start();
require 'system.ctrl.php';
if(!empty($_SESSION["msgid"])){
  if($_SESSION["option"]==1){
    header("Location: professor.php");
  }
  else if($_SESSION["option"]==2){
    header("Location: student.php");
  }
  else if($_SESSION["option"]==3){
    header("Location: it.php");
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- ORUSystem CSS -->
    <link rel="stylesheet" href="orus.css">
    <title>Online Registration University System</title>
  </head>
  <body>
    <div class="container">

    <?php if (!empty($_SESSION["msgid"]) && phpShowSystemFeedback($_SESSION["msgid"])[0]!="") { ?>

      <div class="row">
        <div class="col-12">
          <div class="alert alert-<?php echo (phpShowSystemFeedback($_SESSION['msgid'])[0]); ?>" role="alert">
            <?php echo (phpShowSystemFeedback($_SESSION['msgid'])[1]); ?>
          </div>
        </div>
      </div>

    <?php } ?>


      <!-- SIGN IN FORM -->
      <div class="row sign-in-row rounded border border-dark">
            <div class="col-lg-4 blockquote text-center"><h1>Online Registration University System</h1></div>
            <div class="col-lg-9">
              <form name="formSignIn" action="signin.ctrl.php" method="post">
                <div class="form-inline">
                  <label class="sr-only" for="formSignInId">ID</label>
                  <input type="text" class="form-control form-control-sm mb-2 mr-sm-2 mb-sm-0" id="formSignInId" name="formSignInId" placeholder="ID">

                  <label class="sr-only mt-1" for="formSignInPassword">Password</label>
                  <input type="password" class="form-control form-control-sm mb-2 mr-sm-2 mb-sm-0" id="formSignInPassword" name="formSignInPassword" placeholder="Password">


                  <div class="btn-group btn-group-toggle d-flex align-items-center justify-content-center mt-4 mb-4" data-toggle="buttons">
                    <label class="btn btn-secondary">
                      <input type="radio" name="option" value='1' id="radioProfessor" autocomplete="off" onclick="jsSignInSubmitEnable();"> Professor
                    </label>
                    <label class="btn btn-secondary">
                      <input type="radio" name="option" value='2' id="radioStudent" autocomplete="off" onclick="jsSignInSubmitEnable();"> Student
                    </label>
                    <label class="btn btn-secondary">
                      <input type="radio" name="option" value='3' id="radioIt" autocomplete="off" onclick="jsSignInSubmitEnable();"> IT
                    </label>
                  </div>
                  <div id="formSignInHeader" class="sign-in-row rounded border border-danger">
                    <h2 class="text-center">Choose who you are before signing in!</h2>
                  </div>
                  <button type="submit" id="formSignInSubmit" class="btn btn-primary btn-md btn-block">Sign In</button>
                </div>
              </form>
            </div>
          </div>
          
    </div>
    <footer id="sticky-footer" class="flex-shrink-0 py-4 bg-dark text-white-50">
    <div class="container text-center">
      <small>Copyright &copy; ORUS</small>
    </div>

    <?php 
    $_SESSION["msgid"]="";
    $_SESSION["option"]="";
    ?>

    <!-- Optional JavaScript; choose one of the two! -->
    <script>
      document.getElementById("formSignInSubmit").disabled=true;
      document.getElementById("formSignInSubmit").classList.add("btn-danger");

      function jsSignInSubmitEnable() {
          document.getElementById("formSignInSubmit").disabled = false;
          document.getElementById("formSignInSubmit").classList.remove("btn-danger");
          document.getElementById("formSignInSubmit").classList.remove("btn-md");
          document.getElementById("formSignInSubmit").classList.add("btn-success");
          document.getElementById("formSignInSubmit").classList.add("btn-lg");
          document.getElementById("formSignInHeader").classList.add("d-none");
      }
    </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>