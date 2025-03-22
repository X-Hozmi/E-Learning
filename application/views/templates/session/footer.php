<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; HANZ <?= date('Y') ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Siap keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Logout" di bawah bila kamu sudah siap mengakhiri sesi.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="<?= base_url('autentikasi/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url(); ?>assets/vendor/jquery/1.9.1/jquery.js"></script>
<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url(); ?>assets/js/demo/chart-area-demo.js"></script>
<script src="<?= base_url(); ?>assets/js/demo/chart-pie-demo.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url(); ?>assets/js/demo/datatables-demo.js"></script>

<script>
// Script pertama berfungsi untuk membuat form dinamis
$(document).ready(function() {
    $(".add-more").click(function() {
        var html = $(".copy").html();
        $(".after-add-more").after(html);
    });

    // saat tombol remove dklik, control group akan dihapus 
    $("body").on("click", ".remove", function() {
        $(this).parents(".control-group").remove();
    });
});
// Akhir dari script pertama

// Script kedua berfungsi membuat nama file saat upload gambar muncul di form bootstrap
$('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});
// Akhir dari script kedua

// Script ketiga berfungsi untuk mengubah hak akses user terhadap menu ketika di klik
$('.form-check-input').on('click', function() {
    const IDmenu = $(this).data('menu');
    const IDrole = $(this).data('role');

    $.ajax({
        url: "<?= base_url('admin/ubahRoleAkses'); ?>",
        type: 'post',
        data: {
            IDmenu: IDmenu,
            IDrole: IDrole
        },
        success: function() {
            document.location.href = "<?= base_url('admin/dataRoleAkses/'); ?>" + IDrole;
        }
    });
});
// Akhir dari script ketiga

// Script keempat berfungsi untuk display display gambar saat diklik
// Get the display
var display = document.getElementById("mydisplay");

// Get the image and insert it inside the display - use its "alt" text as a caption
var img = document.getElementById("myImg");
var displayImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function() {
    display.style.display = "block";
    displayImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the display
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the display
span.onclick = function() {
    display.style.display = "none";
}
// Akhir dari script keempat

// Script kelima berfungsi untuk melihat preview gambar sebelum upload
$(document).on("click", ".browse", function() {
    var file = $(this).parents().find(".file");
    file.trigger("click");
});
$('input[type="file"]').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);

    var reader = new FileReader();
    reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});
// Akhir dari script kelima
</script>
</body>

</html>