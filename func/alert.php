


<script>
    function successTambah() {
        swal({
            title: "Berhasil!",
            text: "Data berhasil ditambahkan",
            type: "success"
        });
    }
    function passwordWrong() {
        swal({
            title: "Gagal!",
            text: "Password anda tidak cocok",
            type: "warning"

        });
    }
    function successEdit() {
        swal({
            title: "Berhasil!",
            text: "Data berhasil diedit",
            type: "success"

        });
    }
    function successHapus() {
        swal({
            title: "Berhasil!",
            text: "Data berhasil dihapus",
            type: "success"
        });
    }
    function cancelHapus() {
        swal({
            title: "Berhasil!",
            text: "Data berhasil diedit",
            type: "success"

        });
    }
    function welcome(user) {
        swal({
            title: "Selamat Datang",
            text: "Anda login sebagai " + user + " \n pesan akan hilang dalam 2 detik",
            type: "success",
            showConfirmButton: false,
            timer: 3000
        });
    }
    function berhasilHapus(page) {

        swal({
            title: "Data sudah terhapus",
            text: "(pesan akan hilang dalam 3 detik)",
            timer: 3000,
            showConfirmButton: false
        },
        function () {
            window.location.href = "?page=" + page;
        });

    }
    function hapus(id, page) {
        swal({
            title: "Apakah anda yakin?",
            text: "Data tidak akan bisa di kembalikan setelah terhapus!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yakin, hapus!",
            cancelButtonText: "Jangan di hapus",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                swal("Deleted!", "Terhapus", "success");
                window.location.href = "?page=" + page + "&aksi=hapus&id=" + id;

            } else {
                swal({
                    title: "Data tidak terhapus",
                    text: "(pesan akan hilang dalam 2 detik)",
                    timer: 2000,
                    imageUrl: "style/img/jempol.jpg",
                    showConfirmButton: false
                });
            }
        });
    }
    function chgPwd(page,id) {
        swal({
            title: "Ganti Password?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yakin, ganti!",
            cancelButtonText: "Tidak Yakin",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                //swal("Deleted!", "Terhapus", "success");
                window.location.href = "?page=" + page + "&aksi=password&id=" + id;

            } else {
                swal({
                    title: "Password tidak diganti",
                    text: "(pesan akan hilang dalam 2 detik)",
                    timer: 2000,
                    imageUrl: "style/img/jempol.jpg",
                    showConfirmButton: false
                });
            }
        });
    }
</script>
