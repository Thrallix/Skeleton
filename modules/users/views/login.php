<div class="container">
    <div class="row">
        <div class="offset-md-3 col-md-6 col-12">
            <div class="card">
                <div class="card-body">
                    <h3>Login: <?=Functions::getIP()?></h3>
                    <hr>
                    <form method="POST" action="" name="login" default="true">
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-user fa-fw"></i></div>
                            <input type="text" class="form-control" name="person" placeholder="Username or email" />
                        </div>
                        <div class="py-2"></div>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-asterisk fa-fw"></i></div>
                            <input type="password" class="form-control" name="password" placeholder="Password" />
                        </div>
                        <hr>
                        <a href="<?=home?>/users/register" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> Don't have an account?
                        </a>
                        <button type="submit" class="btn btn-primary float-right">
                            <i class="fa fa-check"></i> Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>