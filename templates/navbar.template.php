<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
    <div class="container">
        <a class="navbar-brand" href="<?=home?>">
            <i class="fa fa-leaf"></i> <?=config['project_name']?> <?=config['project_build'];?>
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?=home?>">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                        <i class="fa fa-user"></i> Your account
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#"><i class="fa fa-key fa-fw"></i> Login to <?=name?></a>
                        <a class="dropdown-item" href="#"><i class="fa fa-user-plus fa-fw"></i> Create <?=name?> account</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="fa fa-lock fa-fw"></i> Forgot password?</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="spacer"></div>