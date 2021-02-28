<header>
    <nav class="navbar navbar-expand-sm bg-dark">
        <a style="text-decoration: none;" href="Index.php">
            <p style="color: white;font-size: 1.5rem;"><span style="color: #E4B820;font-size:3rem;font-family: 'Great Vibes', cursive;">C</span>ed<span style="color: #E4B820;font-size:2.5rem;font-family: 'Great Vibes', cursive;">C</span>ab</p>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="USER/Index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Index.php">Book A Ride</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Change Password</a>
                        <a class="dropdown-item" href="#">Update Profile</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="USER/Logout.php" aria-expanded="false">
                        Log out
                    </a>
                </li>
            </ul>
        </div>
        <p style="color: #E4B820;">Welcome, <?php
                                            if (isset($_SESSION['user']['email'])) {
                                                $name = $_SESSION['user']['email'];
                                                echo "$name";
                                            }
                                            ?></p>
    </nav>
</header>