<style>
    .modal-backdrop {
    background-color: rgba(0, 0, 0, 0.6);
  }

    .modal-body input, 
    .modal-body textarea {
    width: 100%; 
    padding: 10px; 
    font-size: 1.1rem; 
  }

  .modal-body label {
    font-size: 1.1rem; 
  }
</style>

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content col-10">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Tambah Data Barang</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" action="<?= base_url('C_admin/add_barang') ?>" enctype="multipart/form-data"  class="w-100">
            <div class="modal-body d-flex justify-content-center gap-4 ">
                <div class="w-50" >

                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select name="kategori_id" id="kategori_id" class="form-control">
                                <?php foreach($kategori as $row) :?>
                                   <option value="<?= $row['kategori_id'] ?>"><?= $row['kategori_name'] ?></option>
                                <?php endforeach ;?>
                        </select>
                       
                    </div>
                    <input type="text" name="pj_id" hidden value="<?= $this->session->userdata('sellerId') ?>" disabled>
                    <div class="mb-3">
                        <label for="brg_name" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" name="brg_name" id="brg_name" placeholder="Masukkan nama barang">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Masukkan deskripsi"></textarea>
                    </div>
                </div>

                <div class="w-50">

                    <div class="mb-3">
                        <label for="brg_harga" class="form-label">Harga Barang</label>
                        <input type="number" class="form-control" name="brg_harga" id="brg_harga" placeholder="Masukkan harga barang">
                    </div>
                    <div class="mb-3">
                        <label for="brg_stok" class="form-label">Stok Barang</label>
                        <input type="number" class="form-control" name="brg_stok" id="brg_stok" placeholder="Masukkan stok barang">
                    </div>
                    <div class="mb-3">
                        <label for="brg_gambar" class="form-label">Gambar Barang</label>
                        <input type="file" class="form-control" name="brg_gambar" id="brg_gambar">
                    </div>
                </div>
            </div>
            <div class="modaladadmi-footer m-2">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button  type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>