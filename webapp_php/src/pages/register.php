<?php if (session_status() == PHP_SESSION_NONE) session_start() ?>
<?php include("../functions/register-submit.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Manish Koirala">
    <title>Registration Portal</title>
    <!-- Include the bootstrap libraries. -->
    <link rel="stylesheet" href="../inc/bootstrap-5.3.3-dist/css/bootstrap.css">
    <script src="../inc/bootstrap-5.3.3-dist/js/bootstrap.js" defer></script>
</head>
<body>
    <!-- Include the header. -->
    <?php include("../inc/header.php") ?>

    <!-- Include the main part. -->
    <main class="card">
        <div class="card-header text-center">Registration Form</div>
        <div class="card-body">
            <?php include("../functions/register-form.php") ?>
        </div>
    </main>

    <!-- Include the footer. -->
    <?php include("../inc/footer.php") ?>

    <script>
        // Make the "About" link active.
        document.getElementsByClassName("nav-link")[3].classList.add("active");
    </script>
</body>
</html>