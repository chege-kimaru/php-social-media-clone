<?php
include_once 'controller/user/followers.php';
include_once 'controller/user/following.php';
include_once 'controller/user/follow.php';
include_once 'controller/user/unfollow.php';
?>
<div class="col-lg-2">
    <h4>Followers</h4>
    <hr>
    <?php foreach ($followers as $person) { ?>
        <div class="row">
            <div class="col-sm-3">
                <img src="<?php echo $person['image']; ?>" alt=""
                     style="border-radius: 50%; width: 50px; height: 50px;">
            </div>
            <div class="col-sm-9">
                <p class="text-monospace" style="vertical-align: middle;"><?php echo $person['name']; ?></p>
                <?php if ($person['following'] > 0) { ?>
                    <span class="badge badge-success">Following</span>
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

    <h4>Following</h4>
    <hr>
    <?php foreach ($following as $pers) { ?>
        <div class="row">
            <div class="col-sm-3">
                <img src="<?php echo $pers['image']; ?>" alt="" style="border-radius: 50%; width: 50px; height: 50px;">
            </div>
            <div class="col-sm-9">
                <p class="text-monospace" style="vertical-align: middle;"><?php echo $pers['name']; ?></p>
                <form action="" method="post" class="form-inline">
                    <input type="hidden" name="id" value="<?php echo $user_id; ?>">
                    <input type="hidden" name="friend_id" value="<?php echo $pers['id']; ?>">
                    <button name="unfollow" class="btn btn-outline-warning">unfollow</button>
                </form>
                <hr>
                <button class="btn btn-outline-secondary">
                    <a href="profile.php?id=<?php echo $person['id']; ?>">Profile</a>
                </button>
            </div>
        </div>
        <hr class="border-success">
    <?php } ?>
</div>