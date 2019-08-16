<div class="container">
    <div class="row">
        <div class="offset-md-3 col-md-6 col-12">
            <div class="card">
                <div class="card-body">
                    <h3>Register: <?=Functions::getIP()?></h3>
                    <hr>
                    <form method="POST" action="" name="register" default="true">
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-user fa-fw"></i></div>
                            <input type="text" class="form-control" name="username" placeholder="Username" />
                        </div>
                        <div class="input-group mt-3">
                            <div class="input-group-text"><i class="fa fa-inbox fa-fw"></i></div>
                            <input type="text" class="form-control" name="email" placeholder="E-mail address" />
                        </div>
                        <div class="py-3"></div>
                        <div class="input-group">
                            <div class="input-group-text"><i class="fa fa-asterisk fa-fw"></i></div>
                            <input type="password" class="form-control" name="password" placeholder="Password" />
                        </div>
                        <div class="input-group mt-3">
                            <div class="input-group-text"><i class="fa fa-asterisk fa-fw"></i></div>
                            <input type="password" class="form-control" name="cpassword" placeholder="Confirm password" />
                        </div>
                        <hr>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="agreement" name="agreement" value="toggled">
                            <label class="form-check-label" for="agreement">
                                I agree to the terms and conditions
                            </label>
                        </div>
                        <hr>
                        <a href="<?=home?>/users/login" class="btn btn-warning">
                            <i class="fa fa-arrow-left"></i> Already have an account?
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