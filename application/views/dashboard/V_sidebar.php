<div class="d-flex">
    <nav class="sidebar col-2">
        <h4 class="text-dark text-center p-3">Admin Panel</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link " href="<?= base_url('C_admin/index'); ?>">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('C_admin/users'); ?>">
                    <i class="bi bi-people"></i> Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-toggle="collapse" href="#productsMenu" role="button" aria-expanded="false" aria-controls="productsMenu">
                    <i class="bi bi-box-seam"></i> Products
                </a>
                <div class="collapse" id="productsMenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('C_admin/get_barang/') ?>">
                                <i class="bi bi-eye"></i> View
                            </a>
                        </li>
                      
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('C_admin/analytics'); ?>">
                    <i class="bi bi-bar-chart-line"></i> Analytics
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('C_admin/settings'); ?>">
                    <i class="bi bi-gear"></i> Settings
                </a>
            </li>
            <li class="nav-item">
                <button onclick="confirmLogout()" class="nav-link w-100 text-start" >
                <i class="bi bi-box-arrow-left"></i> Logout
                </button>
            </li>
        </ul>
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
                    // Redirect to logout URL or perform logout action
                    window.location.href = '<?= base_url('C_admin/logout'); ?>';
                }
            });
        }
    </script>