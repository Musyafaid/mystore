<div class="container rounded d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="row border border-light shadow-lg">
        <div class="col-md-12 border-start border-light-subtle">
            <div class="p-3 py-0 rounded">
                <div class="d-flex justify-content-center align-items-center mb-3 py-3">
                    <h4 class="text-center">Change Password</h4>
                </div>
                <form action="" method="post">
                    <div class="row">
                        <!-- Current Password -->
                 
                        <!-- New Password -->
                        <div class="col-md-12 mt-3">
                            <label class="labels">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                            <?php if(validation_errors()) : ?>
                                <small class="text-danger small"><?php echo form_error('new_password'); ?></small>
                            <?php endif ; ?>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="col-md-12 mt-3">
                            <label class="labels">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                            <?php if(validation_errors()) : ?>
                                <small class="text-danger small"><?php echo form_error('confirm_password'); ?></small>
                            <?php endif ; ?>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="my-3 text-center w-100">
                        <button class="w-100 btn btn-primary profile-button" type="submit" name="submit">Change Password</button>
                        <span>Back to Login</span>
                        <a href="<?= base_url('C_seller/login') ?>">Click here</a><br>
                    </div>
                </form>

                <!-- Success Alert -->
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

                <!-- Error Alert -->
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
