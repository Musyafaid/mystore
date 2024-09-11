<div class="container rounded d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="row border border-light shadow-lg">
        <!-- Profile Image Section Moved Above Form -->
        <div class="col-md-12 text-center">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle" width="100px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" alt="Profile Image">
                <span class="font-weight-bold">Image</span>
            </div>
        </div>
        <div class="col-md-12 border-start border-light-subtle">
            <div class="p-3 py-0 rounded">
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <h4 class="text-center">Login</h4>
                </div>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="labels">Email</label>
                            <input type="email" class="form-control" id="pj_email" name="pj_email" value="<?php echo set_value('pj_email'); ?>">
                            <?php if(validation_errors()) : ?>
                                <small class="text-danger small"><?php echo form_error('pj_email'); ?></small>
                            <?php endif ; ?>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Password</label>
                            <input type="password" class="form-control" id="pj_password" name="pj_password">
                            <?php if(validation_errors()) : ?>
                                <small class="text-danger small"><?php echo form_error('pj_password'); ?></small>
                            <?php endif ; ?>
                        </div>
                    </div>
                    <div class="my-5 text-center w-100">
                        <button class="w-100 btn btn-primary profile-button" type="submit" name="submit">Login</button>
                        <span>Don't have an account? </span>
                        <a href="<?= base_url('C_seller/register') ?>" >Click here</a><br>
                        <span>Forgot Password? </span>
                        <a href="<?= base_url('C_seller/recovery_password') ?>" >Click Here</a>
                    </div>
                </form>
                <?php if ($this->session->flashdata('alertSuccess')) : ?>
                    <script>
                        function alertSuccess() {
                            Swal.fire({
                                title: 'Success',
                                text: '<?php echo $this->session->flashdata('alertSuccess'); ?>',
                                icon: 'success'
                            });
                        }

                        alertSuccess();
                    </script>
                <?php endif; ?>
                <?php if ($this->session->flashdata('alertError')) : ?>
                    <script>
                        function alertError() {
                            Swal.fire({
                                title: 'Error',
                                text: '<?php echo $this->session->flashdata('alertError'); ?>',
                                icon: 'error'
                            });
                        }

                        alertError();
                    </script>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
