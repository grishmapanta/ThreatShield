<?php if (session_status() == PHP_SESSION_NONE) session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Of Islington</title>
    <!-- Include the bootstrap libraries. -->
    <link rel="stylesheet" href="../inc/bootstrap-5.3.3-dist/css/bootstrap.css">
    <script src="../inc/bootstrap-5.3.3-dist/js/bootstrap.js" defer></script>
</head>
<body>
    <!-- Include the header. -->
    <?php include("../inc/header.php"); ?>

    <!-- Include the main content. -->
    <main class="card" style="height: 90vh;">
        <div class="card-header text-center">
            Bank Of Islington - Home Page
        </div>
        <div class="card-body">
            <div class="container card-text p-2">
            <?php if(isset($_SESSION["uid"])): ?>
              <div class="container">
                  <div class="row text-center fs-4">
                    <li class="col m-1 card">
                      <h3 class="card-title text-center">Account Details:</h3>
                    </li>
                  </div>
                  <ul class="list-group">
                    <li class="list-group-item fs-5"><span class="fs-4 fw-bolder">Name:</span> <?php echo $_SESSION["fname"] . " " . $_SESSION["lname"] ?></li>
                    <li class="list-group-item fs-5"><span class="fs-4 fw-bolder">Phone Number:</span> <?php echo $_SESSION["phone"] ?></li>
                    <li class="list-group-item fs-5"><span class="fs-4 fw-bolder">Email:</span> <?php echo $_SESSION["email"] ?></li>
                    <li class="list-group-item fs-5"><span class="fs-4 fw-bolder">Account Number:</span> <?php echo $_SESSION["acc_num"] ?></li>
                    <li class="list-group-item fs-5"><span class="fs-4 fw-bolder">Bank Balance:</span> <?php echo "$" . $_SESSION["balance"] ?></li>
                  </ul>
              </div>
            <?php else: ?>
              <p>Please login to view your account details.</p>
              <a href="/pages/login.php" class="btn btn-primary">Log In</a>
            <?php endif ?>
        </div>
    </main>
    <!-- Include the footer. -->
    <?php include("../inc/footer.php"); ?>

    <script>
        // Make the "About" link active.
        document.getElementsByClassName("nav-link")[0].classList.add("active");
    </script>
</body>
</html>
