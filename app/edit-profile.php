<?php
include_once 'session.php';
include_once 'controller/user/edit-profile.php';
?>
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
<?php include_once 'includes/navbar.php'; ?>

<div class="container-fluid">
    <div class="row" style="padding: 20px;">
        <!--  User Profile  -->
        <?php include_once 'includes/profile.php'; ?>

        <div class="col-lg-6">
            <form method="post" enctype="multipart/form-data">
                <h4>Edit Profile</h4>
                <hr>
                <input value="<?php echo $user_id; ?>" name="id" type="hidden">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Name</label>
                        <input value="<?php echo $profile['name']; ?>" name="name" type="text" class="form-control"
                               id="inputEmail3" placeholder="Name">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Email</label>
                        <input value="<?php echo $profile['email']; ?>" name="email" type="email" class="form-control"
                               id="inputEmail4" placeholder="Email">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Phone</label>
                        <input value="<?php echo $profile['phone']; ?>" name="phone" type="text" class="form-control"
                               id="inputPassword4" placeholder="phone">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Date of Birth</label>
                    <input value="<?php echo $profile['dob']; ?>" name="dob" type="date" class="form-control"
                           id="inputAddress" placeholder="date of birth">
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Where do you live</label>
                    <input value="<?php echo $profile['location']; ?>" name="location" type="text" class="form-control"
                           id="inputAddress9" placeholder="Where do you live">
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Education</label>
                    <input value="<?php echo $profile['education']; ?>" name="education" type="text"
                           class="form-control" id="inputAddress2" placeholder="Education">
                </div>
                <div class="file-loading form-group">
                    <input name="file" id="file-0a" class="file form-control" type="file" multiple
                           data-min-file-count="1"
                           data-theme="fas" placeholder="profile picture">
                </div>
                <br>
                <button name="edit-profile" type="submit" class="btn btn-primary">Edit Profile</button>
            </form>
        </div>

        <div class="col-lg-1"></div>

        <!--  Followers  -->
        <?php include_once 'includes/friends.php'; ?>
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

<script>
    $("#file-0a").fileinput({
        overwriteInitial: true,
        initialPreviewAsData: true,
        initialPreview: [
            "http://localhost/social-media/app/<?php echo $profile['image']; ?>",
        ]
    });
</script>
</body>
</html>