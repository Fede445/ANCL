<header class="header">
    <ul class="container flex">
        <li class="website">
            <a href="index.php">ANCL U.P. di VERONA</a>
        </li>
        <li>
            <img src="img/round-account-button-with-user-inside 1.svg">
            <a href="reset-password.php"><?php echo htmlspecialchars($_SESSION["displayName"]); ?></a>
        </li>
        <li>
            <img src="img/logout 1.svg">
            <a href="logout.php">Logout</a>
        </li>
    </ul>
</header>