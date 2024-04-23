<form method="post" action="include/login.inc.php" class="needs-validation" autocomplete="off">
    <div class="row align-items-center">
        <div class="row">
            <div class="col-lg-4 col-sm-12 offset-lg-4 form-group">
                <label for="username" class="form-label">Nutzername / Anzeigename</label>
                <input type="text" class="form-control" id="username" name="uid" placeholder="Enter username" required>
            </div>
            <div class="col-lg-4 col-sm-12 offset-lg-4 form-group">
                <label for="password" class="form-label">Passwort</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
            </div>
            <div class="col-lg-4 col-sm-12 offset-lg-4 form-group">
                <button type="Login" class="btn btn-primary mt-2">Einloggen</button>
            </div>
        </div>
    </div>
</form>
<?php
if (isset($_GET["error"])) {
    switch ($_GET["error"]) {
        case "deactivated":
            echo "<p class='text-danger'>Your account is deactivated!</p>";
            break;
        case "login":
            echo "<p class='text-danger'>Wrong login!</p>";
            break;
        default:
            echo "<p>Successful login!</p>";
            break;
    }
}
?>