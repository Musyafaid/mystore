<div class="container rounded d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="row border border-light shadow-lg">
        <div class="col-md-12 border-start border-light-subtle">
            <div class="p-3 py-0 rounded">
                <div class="d-flex justify-content-center align-items-center mb-3 py-3">
                    <h4 class="text-center">Recovery</h4>
                </div>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="labels">Email</label>
                            <input type="email" class="form-control" id="usr_email" name="usr_email" >
                            <?php if(validation_errors()) : ?>
                                <small class="text-danger small"><?php echo form_error('usr_email'); ?></small>
                            <?php endif ; ?>
                        </div>
                    </div>
               
                    <div class="my-3 text-center w-100">
                        <button class="w-100 btn btn-primary profile-button" type="submit" name="submit">Send Verfication Code</button>
                        <span>Back Login </span>
                        <a href="<?= base_url('C_user/login') ?>" >Click here</a><br>
            
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
