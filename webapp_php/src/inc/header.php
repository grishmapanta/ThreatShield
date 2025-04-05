<header>
    <nav class="navbar navbar-expand navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Bank Of Islington</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../pages/index.php">About</a>
                </li>
                <?php if (isset($_SESSION["uid"])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/transfer.php">Transfer</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/logout.php">Logout</a>
                    </li>
                <?php else: ?>
                  <li class="nav-item">
                      <a class="nav-link" href="../pages/login.php">Login</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../pages/register.php">Register</a>
                </li>
                <?php endif ?>
            </ul>
        </div>       
    </nav>
</header>
