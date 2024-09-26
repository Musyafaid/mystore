<nav class="navbar position-absolute top-0 col-12 navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="<?= base_url('C_home/landing') ?>">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="<?= base_url('C_home/landing') ?>">All Products</a></li>
                                <li><hr class="dropdown-divider" /></li>
                                <?php foreach($kategori as $row) :?>
                                    <li><a class="dropdown-item" href="<?= base_url('C_home/kategori/'.$row['kategori_id'] ) ?>"><?= $row['kategori_name'] ?></a></li>
                                <?php endforeach ;?>
                                </ul>
                        </li>
                    </ul>
                    <form class="d-flex mx-2" role="search" action="<?= base_url('C_home/search/') ?>" method="post">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                    <button class="btn btn-outline-success" type="submit" name="submit">Search</button>
                    </form>
                  
                        <a href="<?= base_url('C_home/view_cart/') ?>" class="btn btn-outline-dark" >
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill"><?= $this->session->userdata('checkout') ?></span>
                        </a>

                        <?php if($this->session->userdata('textbtn') == 'logout') :?>
                        <button  onclick="confirmLogout()"  class="btn btn-outline-danger mx-2" >
                             <i class="bi bi-box-arrow-left"></i> <?= $this->session->userdata('textbtn') ?>
                        </button>
                        <?php endif ; ?>
                        <?php if($this->session->userdata('textbtn') == 'login') :  ?>
                            <a href="<?= base_url('C_user/login/') ?>" class="btn btn-outline-dark mx-2" >
                                <i class="bi bi-box-arrow-in-right"></i> <?= $this->session->userdata('textbtn') ?>
                            </a>
                        <?php endif ;?>
                   
        </div>    
    </div>
</nav>



<script>
        function confirmLogout() {
         

            Swal.fire({
                title: 'Are you sure?',
                text: "You will be logged out of your account!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, log out!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?= base_url('C_user/logout'); ?>';
                }
            });
        }
    </script>