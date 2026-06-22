</div> <!-- /.row -->
    </div> <!-- /.container-fluid -->

    <footer class="footer py-3 bg-white border-top mt-5" style="font-size: 0.85rem;">
        <div class="container text-center">
            <span class="text-muted font-monospace">
                &copy; <?= date('Y'); ?> Enterprise Core Kernel &bull; Engine System PT Maju Jaya Enterprise Logistics Framework.
            </span>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            let alertMessage = "<?= strip_tags($this->session->flashdata('msg')); ?>";

            if (alertMessage.trim() !== "") {
                let iconType = 'success';
                if (alertMessage.toLowerCase().includes('gagal') || alertMessage.toLowerCase().includes('kunci') || alertMessage.toLowerCase().includes('tidak') || alertMessage.toLowerCase().includes('melebihi')) {
                    iconType = 'error';
                }

                Swal.fire({
                    title: 'System Notification',
                    text: alertMessage,
                    icon: iconType,
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                    background: '#ffffff',
                    color: '#1e293b',
                    confirmButtonColor: '#38bdf8',
                    customClass: { popup: 'border-radius-16' }
                });
            }
        });
    </script>
</body>
</html>