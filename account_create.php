<?php
/*
 * account_create.php
 * UI for creating another user account. Admin only feature.
 */

require_once 'includes/database.php';
require_once 'includes/header.php';

//ensures the user is logged in as an Admin to use this feature
if (($_SESSION['role']) != 2) {
    header("Location: login.php");
}
?>

<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1>Local History File Index</h1>
        <h2>Create a New User Account</h2>
    </div>
</div>


<div class="container">

    <form action="createAccount_SQL.php" method="post">
        <h3>Create Account</h3>

        <br/>
        <label for="username">Username</label><br/>
        <input type="text" name="username" class="form-control" autofocus required pattern=".*\S+.*" title="Space only entries are not allowed.">
        <br/>
        <label for="password">Password</label><br/>
        <input type="password" name="password" class="form-control" value=""required>
        <br/>

        <label class="radio-inline">
            <input type="radio" name="role" value="1" checked="checked"> Regular User
        </label><br/>
        <label class="radio-inline">
            <input type="radio" name="role" value="2"> Administrator
        </label>

        <br/>
        <br/>
        <button type="submit" class="btn btn-success">Create</button>
        <input type="button" class="btn btn-info inner inlineBtnRight" name="Cancel" value="Cancel" onclick="window.location.href = 'account_list.php'" />   
    </form>
</div>
<?php
require_once 'includes/footer.php';
