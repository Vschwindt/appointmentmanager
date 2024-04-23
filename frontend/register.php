<form method="post" action="include/register.inc.php" autocomplete="off">
    <div class="row align-items-center mt-2">
        <div class="col-lg-3 col-sm-12 offset-lg-3">
            <div class="form-group">
                <label for="anrede" class="form-label">Anrede</label>
                <input type="text" class="form-control" id="anrede" placeholder="Enter salutation" name="salutation" required>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12">
            <div class="form-group">
                <label for="username" class="form-label">Nutzername / Anzeigename</label>
                <input type="text" class="form-control" id="username" placeholder="Enter username" name="uid" required>
            </div>
        </div>
    </div>
    <div class="row align-items-center mt-2">
        <div class="col-lg-3 col-sm-12 offset-lg-3">
            <div class="form-group">
                <label for="first_name" class="form-label">Vorname</label>
                <input type="text" class="form-control" id="first_name" placeholder="Enter first name" name="first_name" required>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12">
            <div class="form-group">
                <label for="surname" class="form-label">Nachname</label>
                <input type="text" class="form-control" id="surname" placeholder="Enter surname" name="surname" required>
            </div>
        </div>
    </div>
    <div class="row align-items-center mt-2">
        <div class="col-lg-6 col-sm-12 offset-lg-3">
            <div class="form-group">
                <label for="email" class="form-label">Email addresse</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
            </div>
        </div>
    </div>
    <div class="row align-items-center mt-2">
        <div class="col-lg-3 col-sm-12 offset-lg-3">
            <div class="form-group">
                <label for="password" class="form-label">Passwort</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
            </div>
        </div>
        <div class="col-lg-3 col-sm-12">
            <div class="form-group">
                <label for="password_repeat" class="form-label">Passwort Wiederholen</label>
                <input type="password" class="form-control" id="password_repeat" placeholder="Repeat password" name="password_repeat" required>
            </div>
        </div>
    </div>
    <div class="row align-items-center mt-2">
        <div class="col-lg-3 col-sm-12 offset-lg-3">
            <button type="Login" class="btn btn-primary mt-2">Registrieren</button>
        </div>
    </div>
</form>
<?php

if (isset($_GET["error"])) {
    if ($_GET["error"] == "invaliduid") {
        echo "<p class='text-danger'>Choose a proper username!</p>";
    } else if ($_GET["error"] == "invalidemail") {
        echo "<p class='text-danger'>Choose a proper email!</p>";
    } else if ($_GET["error"] == "passwordsdontmatch") {
        echo "<p class='text-danger'>Passwords doesn't match!</p>";
    } else if ($_GET["error"] == "usernametaken") {
        echo "<p class='text-danger'>Username or Email already in Use</p>";
    } else if ($_GET["error"] == "none") {
        echo "<p class='text-success'>You have signed up!</p>";
    }

    switch ($_GET["error"]) {
        case "email":
            echo "<p class='text-danger'>Invalid Email.</p>";
            break;
        case "match":
            echo "<p class='text-danger'>Passwords don't match!</p>";
            break;
        case "uidtaken":
            echo "<p class='text-danger'>Username is already in Use</p>";
            break;
        case "uid":
            echo "<p class='text-danger'>Your username should consist of letters and numbers exclusively.</p>";
            break;
        case 'emailtaken':
            echo "<p class='text-danger'>Email is already in Use</p>";
            break;
        default:
            echo "<p class='text-success'>Success!</p>";
            break;
    }
}
?>