<?php include_once 'controller/user/profile.php'; ?>
<div class="col-lg-3">
    <h4>My Profile</h4>
    <hr>
    <section style="padding: 10px; padding-bottom: 40px;">
        <div class="card mb-3">
            <img src="<?php echo $profile['image']; ?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?php echo $profile['name']; ?></h5>
                <p class="card-text"><i class="fa fa-envelope"></i> <?php echo $profile['email']; ?></p>
                <p class="card-text">
                    <small class="text-muted"><i class="fa fa-phone"></i> <?php echo $profile['phone']; ?></small>
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
                <p class="card-text"><?php echo $profile['dob']; ?></p>
                <hr class="border-primary">
                <h5 class="card-title"><i class="fa fa-location-arrow"></i> Where do you live</h5>
                <p class="card-text"><?php echo $profile['location']; ?></p>
                <hr class="border-primary">
                <h5 class="card-title"><i class="fa fa-graduation-cap"></i> <?php echo $profile['education']; ?></h5>
                <p class="card-text"><?php echo $profile['education']; ?></p>
                <hr class="border-primary">
            </div>
        </div>
        <hr>
        <div>
            <button class="btn btn-outline-secondary"><i class="fa fa-pencil"></i>
                <a href="edit-profile.php">Edit</a>
            </button>
            <hr>
            <form method="get" class="form-inline">
                <button name="logout" class="btn btn-outline-danger"><i class="fa fa-lock"></i>
                    Logout
                </button>
            </form>
        </div>
    </section>
</div>