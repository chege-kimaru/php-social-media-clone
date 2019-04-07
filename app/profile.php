<?php
include_once 'session.php';
include_once 'controller/user/edit-profile.php';
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/bootstrap.min.css">
    <link href="assets/vendor/krajee/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fontawesome/css/fontawesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">

    <title>Let us connect</title>
</head>
<body>


<?php include_once 'includes/navbar.php'; ?>

<div class="container-fluid">
    <div class="row" style="padding: 20px;">
        <!--  User Profile  -->
        <?php include_once 'includes/profile.php'; ?>

        <div class="col-lg-6">
            <h4><?php echo $user_profile['name'] ?> Profile</h4>
            <hr>
            <section style="padding: 10px;">
                <div class="card mb-3">
                    <img src="<?php echo $user_profile['image'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $user_profile['name'] ?></h5>
                        <p class="card-text"><i class="fa fa-envelope"></i> <?php echo $user_profile['email'] ?></p>
                        <p class="card-text">
                            <small class="text-muted"><i class="fa fa-phone"></i> <?php echo $user_profile['phone'] ?></small>
                        </p>
                    </div>
                </div>
                <div class="row text-center text-capitalize">
                    <div class="col-sm-6">
                        <div class="card border-success">
                            <div class="card-body">
                                <h4><?php echo $profile['followersCount']; ?></h4>
                                <p class="text-sm-center">Followers</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card border-primary">
                            <div class="card-body">
                                <h4><?php echo $profile['followingCount']; ?></h4>
                                <p>Following</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="border-danger">
                <div class="card border-warning">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa fa-calendar"></i> Date of birth</h5>
                        <p class="card-text"><?php echo $user_profile['dob'] ?></p>
                        <hr class="border-primary">
                        <h5 class="card-title"><i class="fa fa-location-arrow"></i> Where do you live</h5>
                        <p class="card-text"><?php echo $user_profile['location'] ?></p>
                        <hr class="border-primary">
                        <h5 class="card-title"><i class="fa fa-graduation-cap"></i> Education</h5>
                        <p class="card-text"><?php echo $user_profile['education'] ?></p>
                        <hr class="border-primary">
                    </div>
                </div>
            </section>
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

</body>
</html>