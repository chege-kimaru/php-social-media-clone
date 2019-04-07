<?php
include_once 'session.php';
include_once "controller/post/post.php";
include_once "controller/post/posts.php";
include_once "controller/post/like.php";
include_once "controller/post/unlike.php";
include_once "controller/comment/comment.php";
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

        <!--  User Profile  -->
        <div class="col-lg-6">
            <div class="form-group">
                <textarea class="form-control" data-toggle="modal" data-target="#exampleModal"
                          placeholder="What do you feel right now."></textarea>
            </div>
            <!--News feed-->
            <div class="container">
                <div class="row">
                    <!-- Contenedor Principal -->
                    <div class="comments-container">
                        <ul id="comments-list" class="comments-list">
                            <?php foreach ($posts as $post) { ?>
                                <li>
                                    <div class="comment-main-level">
                                        <!-- Avatar -->
                                        <div class="comment-avatar"><img
                                                    src="<?php echo $post['user']['image']; ?>"
                                                    alt=""></div>
                                        <!-- Contenedor del Comentario -->
                                        <div class="comment-box">
                                            <div class="comment-head">
                                                <h6 class="comment-name">
                                                    <a href="profile.php?id=<?php echo $post['user']['id'] ?>"><?php echo $post['user']['name']; ?></a>
                                                </h6>
                                                <span><?php echo $post['dateAdded']; ?></span>

                                                <i class="fa fa-reply text-secondary" data-toggle="modal"
                                                   onclick="setData(<?php echo $post['id']; ?>)"
                                                   data-target="#exampleModalCenter"></i>
                                                <span>&nbsp;&nbsp;<b><?php echo $post['commentsCount']; ?></b> comments</span>
                                                <?php if ($post['isLiked']) { ?>
                                                    <form action="" method="post" class="form-inline">
                                                        <input type="hidden" name="friend_id"
                                                               value="<?php echo $user_id; ?>">
                                                        <input type="hidden" name="id"
                                                               value="<?php echo $post['id'] ?>">
                                                        <button type="submit" name="unlike"
                                                                class="btn btn-outline-success"><i
                                                                    class="fa fa-heart text-success"></i>
                                                        </button>
                                                        <span>&nbsp;&nbsp;<b><?php echo $post['likesCount']; ?></b> likes</span>
                                                    </form>
                                                <?php } else { ?>
                                                    <form action="" method="post" class="form-inline">
                                                        <input type="hidden" name="friend_id"
                                                               value="<?php echo $user_id; ?>">
                                                        <input type="hidden" name="id"
                                                               value="<?php echo $post['id'] ?>">
                                                        <button type="submit" name="like" class="btn btn-outline-info">
                                                            <i class="fa fa-heart"></i></button>
                                                        <span>&nbsp;&nbsp;<b><?php echo $post['likesCount']; ?></b> likes</span>
                                                    </form>
                                                <?php } ?>
                                            </div>
                                            <div class="comment-content">
                                                <?php if ($post['image']) { ?>
                                                    <img style='width:100px; height: 100px;' class='img-thumbnail'
                                                         src="<?php echo $post['image'] ?>">
                                                <?php } ?>
                                                <?php echo $post['post']; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Respuestas de los comentarios -->
                                    <ul class="comments-list reply-list">
                                        <?php foreach ($post['comments'] as $comment) { ?>
                                            <li>
                                                <!-- Avatar -->
                                                <div class="comment-avatar"><img
                                                            src="<?php echo $comment['user']['image']; ?>"
                                                            alt=""></div>
                                                <!-- Contenedor del Comentario -->
                                                <div class="comment-box">
                                                    <div class="comment-head">
                                                        <h6 class="comment-name"><a
                                                                    href="profile.php?id=<?php echo $comment['user']['id']; ?>"><?php echo $comment['user']['name']; ?></a>
                                                        </h6>
                                                        <span><?php echo $comment['dateAdded']; ?></span>
                                                    </div>
                                                    <div class="comment-content">
                                                        <?php echo $comment['comment']; ?>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>
            </div>
            <!--End news feed-->
        </div>
        <!-- End news feed -->

        <div class="col-lg-1"></div>

        <!--  Followers  -->
        <?php include_once 'includes/friends.php'; ?>
    </div>
</div>

<?php include_once 'includes/footer.php'; ?>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Post status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                    <div class="file-loading form-group">
                        <input name="file" id="file-0a" class="file form-control" type="file" data-min-file-count="1"
                               data-theme="fas">
                    </div>
                    <br>
                    <div class="form-group">
                        <textarea name="status" class="form-control" placeholder="status"></textarea>
                    </div>
                    <button name="post" type="submit" class="btn btn-outline-success">Post</button>
                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1"
     role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Add
                    Comment</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <input name="user_id" type="hidden"
                           value="<?php echo $user_id; ?>">
                    <input id="post_id" name="post_id" type="hidden">
                    <div class="form-group">
                        <textarea required name="comment"
                                  placeholder="comment"
                                  class="form-control"></textarea>
                    </div>
                    <button name="comment_r" type="submit"
                            class="btn btn-outline-success">Comment
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

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
    function setData(post_id) {
        $('#post_id').val(post_id);
    }
</script>

</body>
</html>