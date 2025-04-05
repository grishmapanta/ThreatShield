<div class="container" style="height: 80vh;">
  <div class="row card p-5 w-50 mx-auto">
    <form class="col mx-auto" method="POST" target="../pages/login.php">
      <div class="mb-3 form-floating">
        <input type="text" class="form-control" id="acc_num" name="acc_num" placeholder="Enter account number where the funds are to be transferred." required>
        <label for="acc_num">Account Number: </label>
      </div>
      <div class="mb-3 form-floating">
        <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter amount here." required>
        <label for="amount">Amount to Transfer: </label>
      </div>
      <div class="mb-3 form-floating">
        <input type="password" class="form-control" id="pin" name="pin" placeholder="Enter PIN here." required>
        <label for="pin">PIN: </label>
      </div>
      <button name="submit" type="submit" class="btn btn-primary mx-auto d-block w-100 p-2">Transfer</button>
      <?php if (isset($error_msg)): ?>
        <div class="p-2 mt-3 text-center" style="color: red;">
            <?php echo $error_msg ?>
        </div>   
      <?php endif ?>
      <?php if (isset($success_msg)): ?>
        <div class="p-2 mt-3 text-center" style="color: green;">
            <?php echo $success_msg ?>
        </div>   
      <?php endif ?>
    </form>
  </div>
</div>
