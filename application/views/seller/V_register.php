<div class="container rounded d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="row border border-light shadow-lg">
        <div class="col-md-3 border-end">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg" alt="Profile Image">
                <span class="font-weight-bold">Image</span>
            </div>
        </div>
        <div class="col-md-9 border-start border-light-subtle">
            <div class="p-3 py-5 rounded">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Register</h4>
                </div>
                <form action="<?= site_url('C_seller/register'); ?>" method="post" enctype="multipart/form-data">
                    <!-- <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>"> -->
                    <div class="row">
                        <div class="col-md-6">
                            <label class="labels">Name</label>
                            <input type="text" class="form-control" id="pj_name" name="pj_name" value="<?php echo set_value('pj_name'); ?>">
                            <?php if(validation_errors()) : ?>
                                <small class="text-danger small"><?php echo form_error('pj_name'); ?></small>
                            <?php endif ; ?>
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Email</label>
                            <input type="email" class="form-control" id="pj_email" name="pj_email" value="<?php echo set_value('pj_email'); ?>">
                            <?php if(validation_errors()) : ?>
                                <small class="text-danger small"><?php echo form_error('pj_email'); ?></small>
                            <?php endif ; ?>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="labels">Password</label>
                            <input type="password" class="form-control" id="pj_password" name="pj_password">
                            <?php if(validation_errors()) : ?>
                                <small class="text-danger small"><?php echo form_error('pj_password'); ?></small>
                            <?php endif ; ?>
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Handphone</label>
                            <input type="text" class="form-control" id="pj_handphone" name="pj_handphone" value="<?php echo set_value('pj_handphone'); ?>">
                            <small class="text-danger small"><?php echo form_error('pj_handphone'); ?></small>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="labels">Address</label>
                            <textarea name="pj_alamat" id="pj_alamat" class="form-control" rows="3"><?php echo set_value('pj_alamat'); ?></textarea>
                            <small class="text-danger small"><?php echo form_error('pj_alamat'); ?></small>
                        </div>
                        <div class="col-md-6">
                            <label class="labels">Profile Picture</label>
                            <input type="file" class="form-control" id="pj_gambar" name="pj_gambar">
                        </div>
                    </div>
                    <div class="mt-5 text-center w-100">
                        <button class="w-100 btn btn-primary profile-button" type="submit" name="submit">Register</button>
                        <span>Already have an account? </span>
                        <a href="<?= base_url('C_seller/login') ?>" >Login here</a>
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

<!-- <script>
    // Setup CSRF token for AJAX requests
    $(document).ready(function() {
        $.ajaxSetup({
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            }
        });
    });
</script> -->
