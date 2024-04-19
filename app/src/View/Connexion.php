<?php
include("../www/header.inc.php");
?>

<form class="row g-3 justify-content-center" action="login.php?action=authenticate" method="POST">
    <div class="col-auto">
        <label for="staticEmail2" class="visually-hidden">Email</label>
        <input type="text" name="email" class="form-control" id="staticEmail2" placeholder="Email">
    </div>
    <div class="col-auto">
        <label for="inputPassword2" class="visually-hidden">Password</label>
        <input type="password" name="password" class="form-control" id="inputPassword2" placeholder="Password">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Confirm identity</button>
    </div>
</form>

<?php
include("../www/footer.inc.php");
?>