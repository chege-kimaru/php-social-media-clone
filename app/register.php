<?php include_once "controller/user/register.php"; ?>
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
                <h4 class="card-title">Register</h4>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Name</label>
                            <input name="name" type="text" class="form-control" id="inputEmail3" placeholder="Name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Phone</label>
                            <input name="phone" type="text" class="form-control" id="inputPassword4"
                                   placeholder="phone">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input name="email" type="email" class="form-control" id="inputEmail4" placeholder="Email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Password</label>
                            <input name="password" type="password" class="form-control" id="inputPassword4"
                                   placeholder="phone">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Date of Birth</label>
                        <input name="dob" type="date" class="form-control" id="inputAddress"
                               placeholder="date of birth">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Where do you live</label>
                        <input name="location" type="text" class="form-control" id="inputAddress9"
                               placeholder="Where do you live">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Education</label>
                        <input name="education" type="text" class="form-control" id="inputAddress2"
                               placeholder="Education">
                    </div>
                    <div class="file-loading form-group">
                        <input name="file" id="file-0a" class="file form-control" type="file"
                               data-min-file-count="1"
                               data-theme="fas" placeholder="profile picture">
                    </div>
                    <br>
                    <button type="submit" name="register" class="btn btn-primary">Register</button>
                    <hr>
                    <p class="text-muted">Already have an account? <a href="login.php">Sign in</a></p>
                </form>
            </div>
        </div>

    </div>
</div>
<hr>
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