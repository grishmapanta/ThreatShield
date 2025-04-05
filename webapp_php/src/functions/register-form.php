<div class="container">
  <div class="row card p-5 w-50 mx-auto">
    <form action="../pages/register.php" method="POST">
        <div class="mb-3 form-floating">
            <input class="form-control" type="text" name="fname" id="fname" placeholder="Enter first name here." required>
            <label class="form-label" for="fname">First Name:</label>
        </div>
        <div class="mb-3 form-floating">
            <input class="form-control" type="text" name="lname" id="lname" placeholder="Enter last name here." required>
            <label class="form-label" for="lname">Last Name:</label>
        </div>
        <div class="mb-3 form-floating">
            <input class="form-control" type="text" name="username" id="username" placeholder="Enter username here." required>
            <label class="form-label" for="username">Username:</label>
        </div>
        <div class="mb-3 form-floating">
            <input class="form-control" type="email" name="email" id="email" placeholder="Enter email here." required>
            <label class="form-label" for="email">Email:</label>
        </div>
        <div class="mb-3 form-floating">
            <input class="form-control" type="password" name="password" id="password" placeholder="Enter password here." required>
            <label class="form-label" for="password">Password:</label>
        </div>
        <div class="mb-3 form-floating">
            <input class="form-control" type="text" name="phone" id="phone" placeholder="Enter phone number here." required>
            <label class="form-label" for="phone">Phone Number:</label>
        </div>
        <div class="mb-3 form-floating">
            <input class="form-control" type="number" min=0 name="balance" id="balance" placeholder="Enter balance amount here." required>
            <label class="form-label" for="balance">Balance:</label>
        </div>
        <div class="mb-3 form-floating">
            <input class="form-control" type="number" min=0000 max=9999 name="pin" id="pin" placeholder="Enter PIN here." required>
            <label class="form-label" for="pin">PIN:</label>
        </div>
        <button class="btn btn-primary d-block w-100 p-2" type="submit" name="submit">
            Register
        </button>
        <div class="p-2 mt-3 text-center" style="color: red;">
            <?php if (isset($error_msg)) echo $error_msg ?>
        </div>
    </form>
  </div>
</div>