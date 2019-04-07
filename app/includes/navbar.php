<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Social-media</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if ($title = 'index') echo 'active'; ?>">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item <?php if ($title = 'edit-profile') echo 'active'; ?>">
                <a class="nav-link" href="edit-profile.php">Profile</a>
            </li>
            <li class="nav-item <?php if ($title = 'index') echo 'active'; ?>">
                <a class="nav-link" href="people.php">Friends</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="people.php">
            <input value="<?php echo $_GET['name']; ?>" name="name" class="form-control mr-sm-2" type="search" placeholder="Search people" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>