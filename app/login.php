<?php include_once 'controller/user/login.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">
    <link href="assets/vendor/krajee/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fontawesome/css/fontawesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <title>Profile</title>
</head>
<body>
<div class="container">
    <div class="col-sm-6 offset-3">
        <br>
        <div class="card border-success">
            <div class="card-header">
                <h4 class="card-title">Login</h4>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="inputAddress">Email</label>
                        <input name="email" type="email" class="form-control" id="inputAddress" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Password</label>
                        <input name="password" type="password" class="form-control" id="inputAddress9" placeholder="Password">
                    </div>
                    <br>
                    <button name="login" type="submit" class="btn btn-primary">Login</button>
                    <hr>
                    <p class="text-muted">Don't have an account? <a href="register.php">Sign up</a></p>
                </form>
            </div>
        </div>

    </div>
</div>
<?php include_once 'includes/footer.php'; ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="assets/vendor/jquery/jquery.slim.min.js"></script>
<script src="assets/vendor/popper/popper.min.js"></script>
<script src="assets/vendor/bootstrap/bootstrap.min.js"></script>

<!--File input scripts-->
<script src="assets/vendor/krajee/js/plugins/piexif.js" type="text/javascript"></script>
<script src="assets/vendor/krajee/js/plugins/sortable.js" type="text/javascript"></script>
<script src="assets/vendor/krajee/js/fileinput.js" type="text/javascript"></script>
<script src="assets/vendor/krajee/js/locales/fr.js" type="text/javascript"></script>
<script src="assets/vendor/krajee/js/locales/es.js" type="text/javascript"></script>
<script src="assets/vendor/krajee/themes/fas/theme.js" type="text/javascript"></script>
<script src="assets/vendor/krajee/themes/explorer-fas/theme.js" type="text/javascript"></script>

</body>
</html>