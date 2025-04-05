<div class="container" style="height: 80vh;">
  <div class="row card p-5 w-50 mx-auto">
    <form class="col mx-auto" method="POST" target="../pages/login.php">
      <div class="mb-3 form-floating">
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username here." required>
        <label for="username">Username: </label>
      </div>
      <div class="mb-3 form-floating">
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password here." required>
        <label for="password">Password: </label>
      </div>
      <button name="submit" type="submit" class="btn btn-primary mx-auto d-block w-100 p-2">Login</button>
      <div class="p-2 mt-3 text-center" style="color: red;">
            <?php if (isset($error_msg)) echo $error_msg ?>
      </div>
    </form>
  </div>
</div>
