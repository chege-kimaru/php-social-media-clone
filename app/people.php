<?php
include_once 'session.php';
include_once 'controller/user/search.php';
include_once 'controller/user/follow.php';
include_once 'controller/user/unfollow.php';
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
            <h4>Search results</h4>
            <hr>
            <?php foreach ($people as $person) { ?>
                <div class="row">
                    <div class="col-sm-3">
                        <img src="<?php echo $person['image']; ?>" alt=""
                             style="border-radius: 50%; width: 50px; height: 50px;">
                    </div>
                    <div class="col-sm-9">
                        <p class="text-monospace" style="vertical-align: middle;"><?php echo $person['name']; ?></p>
                        <?php if ($person['following'] > 0) { ?>
                            <form action="" method="post" class="form-inline">
                                <input type="hidden" name="id" value="<?php echo $user_id; ?>">
                                <input type="hidden" name="friend_id" value="<?php echo $person['id']; ?>">
                                <button name="unfollow" class="btn btn-outline-warning">unfollow</button>
                            </form>
                        <?php } else { ?>
                            <form action="" method="post" class="form-inline">
                                <input type="hidden" name="id" value="<?php echo $user_id; ?>">
                                <input type="hidden" name="friend_id" value="<?php echo $person['id']; ?>">
                                <button name="follow" class="btn btn-outline-success">follow</button>
                            </form>
                        <?php } ?>
                        <hr>
                        <button class="btn btn-outline-secondary">
                            <a href="profile.php?id=<?php echo $person['id']; ?>">Profile</a>
                        </button>
                    </div>
                </div>
                <hr class="border-success">
            <?php } ?>
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