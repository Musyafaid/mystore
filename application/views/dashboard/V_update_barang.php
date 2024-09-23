<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<style>
        input[type="file"] {
            display: none; 
        }

        .custom-file-label {
            display: inline-block;    
        }
        .custom-file-field {
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
          
           
            border: 1px solid #ced4da;
            border-radius: 4px;
            width: 100%;
            text-align: left;
        }
    </style>



<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Update Data Barang</h5>
                </div>
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="card-body d-flex justify-content-center gap-4">
                       
                        <div class="w-50">
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="form-control">
                                    <?php foreach ($kategori as $row) : ?>
                                        <?php foreach ($barang as $brg ) : ?>
                                        <option value="<?= $row['kategori_id'] ?>" <?= ($row['kategori_id'] == $brg['kategori_id']) ? 'selected' : '' ?>>
                                            <?= $row['kategori_name'] ?>
                                        </option>
                                        <?php endforeach ; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?php if(validation_errors()) : ?>
                                <small class="text-danger small"><?php echo form_error('kategori_id'); ?></small>
                                <?php endif ; ?>
                            </div>
                            <input type="hidden" name="pj_id" value="<?= $this->session->userdata('sellerId') ?>">

                            <?php foreach ($barang as $row) : ?>
                            <div class="mb-3">
                                <label for="brg_name" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" name="brg_name" id="brg_name" value="<?= $row['brg_name'] ?>" placeholder="Masukkan nama barang">
                                <?php if(validation_errors()) : ?>
                                <small class="text-danger small"><?php echo form_error('brg_name'); ?></small>
                                <?php endif ; ?>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="description" id="description" rows="5" placeholder="Masukkan deskripsi"><?= $row['description'] ?></textarea>
                                <?php if(validation_errors()) : ?>
                                <small class="text-danger small"><?php echo form_error('description'); ?></small>
                                <?php endif ; ?>
                            </div>
                        </div>
                        <div class="w-50">
                            <div class="mb-3">
                                <label for="brg_harga" class="form-label">Harga Barang</label>
                                <input type="number" class="form-control" name="brg_harga" id="brg_harga" value="<?= $row['brg_harga'] ?>" placeholder="Masukkan harga barang">
                                <?php if(validation_errors()) : ?>
                                <small class="text-danger small"><?php echo form_error('brg_harga'); ?></small>
                                <?php endif ; ?>
                                
                            </div>
                            <div class="mb-3">
                                <label for="brg_stok" class="form-label">Stok Barang</label>
                                <input type="number" class="form-control" name="brg_stok" id="brg_stok" value="<?= $row['brg_stok'] ?>" placeholder="Masukkan stok barang">
                                <?php if(validation_errors()) : ?>
                                <small class="text-danger small"><?php echo form_error('brg_stok'); ?></small>
                                <?php endif ; ?>
                            </div>
                            
                            <div class="mb-3">
                                <label for="brg_gambar" class="form-label">Gambar Barang</label>
                                <label class="custom-file-field d-flex justify-content-start gap-2" for="brg_gambar"><i class="bi bi-upload"></i>
                                <span class="custom-file-label">
                                    <?= $row['brg_gambar'] ?></label>
                                </span>
                                <?php if(validation_errors()) : ?>
                                <small class="text-danger small"><?php echo form_error('brg_gambar'); ?></small>
                                <?php endif ; ?>
                                
                                <input type="file" class="form-control" name="brg_gambar" id="brg_gambar" accept="image/*">
                            </div>

                            <div>
                                <img id="preview-img" src="<?= base_url('./uploads/').$row['brg_gambar'] ?>" height="75" alt="">
                            </div>

                            <script>
                            $(function () {
                                $('#brg_gambar').change(function () {
                                    var file = this.files[0];
                                    if (file) {
                                        $('.custom-file-label').text(file.name);
                                        
                                        var reader = new FileReader();
                                        reader.onload = function (e) {
                                            $('#preview-img').attr('src', e.target.result);
                                        };
                                        reader.readAsDataURL(file);
                                    } else {
                                        $('.custom-file-label').text('No file chosen');
                                        $('#preview-img').attr('src', '<?= base_url('./uploads/').$row['brg_gambar'] ?>');
                                    }
                                });
                            });
                            </script>

                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end gap-2">
                        <a href="<?= base_url('C_admin/get_barang/') ?>" class="btn btn-danger">Batal</a>
                        <button type="submit"  class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


