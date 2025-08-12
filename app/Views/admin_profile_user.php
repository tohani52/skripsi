<?php
$this->session = \Config\Services::session();
$this->session->start();
?>
<?= $this->extend('layout/template_profile') ?>

<?= $this->section('content') ?>
<style>
#signature-pad {
    border: 1px solid #000;
    width: 400px;
    height: 200px;
}
</style>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb" style="background-color:#64b5f6;color:white">
                <li class="breadcrumb-item" style="color:white"><?= $judul_page ?></li>
                <li class="breadcrumb-item active" style="color:white"><?= $sub_judul_page ?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="<?= base_url('assets-admin/img/profile/' . $this->session->get("photo_profile")); ?>"
                            alt="Profile" class="rounded-circle">
                        <h2><?= $this->session->get("display_name") ?></h2>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">


                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>


                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">Change Password</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-ttd">Tanda
                                    Tangan</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form action="<?= $action ?>" method="POST" enctype="multipart/form-data" novalidate>
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                            Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <!-- <img src="<?= base_url() ?>/assets-admin/img/profile-img.jpg" alt="Profile"> -->
                                            <input type="file" name="file_upload" id="gambar" class="pull-left"
                                                onchange="bacaGambaredit(this);">
                                            <img src="<?= base_url('assets-admin/img/profile/' . $photo_profile); ?>"
                                                id="gambar_edit" alt="Profile" />

                                            <!-- <div class="pt-2">
                      <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                    </div> -->
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="display_name" type="text" class="form-control" id="displayname"
                                                value="<?= $display_name ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">User Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="user_name" type="text" class="form-control" id="username"
                                                value="<?= $user_name ?>">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>


                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->


                                <div class="row mb-3">
                                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password
                                        Lama</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="password" type="password" class="form-control"
                                            id="currentPassword">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password
                                        Baru</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Input Ulang
                                        Password Baru</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="renewpassword" type="password" class="form-control"
                                            id="renewPassword">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button onclick="change_password()" class="btn btn-primary">Change Password</button>
                                </div>

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-ttd">

                                <div id="preview-container" style="margin-top:20px;">
                                    <img src="<?= base_url('public/assets-admin/img/ttd/' . $photo_ttd); ?>"
                                        alt="Profile" />

                                </div>
                                <canvas id="signature-pad"></canvas><br>

                                <button onclick="clearPad()">Hapus</button>
                                <button onclick="submitPad()">Simpan</button>

                                <form id="signature-form" method="POST" action="<?= base_url('upload_ttd') ?>">
                                    <input type="hidden" name="signature" id="signature">
                                </form>

                                <script
                                    src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.5/dist/signature_pad.umd.min.js">
                                </script>
                                <script>
                                const canvas = document.getElementById('signature-pad');
                                const signaturePad = new SignaturePad(canvas);

                                function clearPad() {
                                    signaturePad.clear();
                                }

                                function submitPad() {
                                    if (signaturePad.isEmpty()) {
                                        alert("Silakan tanda tangan terlebih dahulu.");
                                        return;
                                    }

                                    const dataUrl = signaturePad.toDataURL('image/png');
                                    document.getElementById('signature').value = dataUrl;
                                    document.getElementById('signature-form').submit();
                                }
                                </script>

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
<script src="<?= base_url() ?>/assets-admin/js/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
<script>
//  $('#ttd').change(function(){
//       bacaGambarTtd(this);
//     })

// function bacaGambarTtd(input)
// {
//   if(input.files && input.files[0])
//   {
//     var reader = new FileReader();

//     reader.onload = function (e){
//       $('#ttd_edit').attr('src',e.target.result);
//       console.log(e.target.result);
//     }
//     reader.readAsDataURL(input.files[0]);
//   }

// }
var canvas = document.getElementById('signature-pad');

function resizeCanvas() {
    // When zoomed out to less than 100%, for some very strange reason,
    // some browsers report devicePixelRatio as less than 1
    // and only part of the canvas is cleared then.
    var ratio = Math.max(window.devicePixelRatio || 1, 1);
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
}

window.onresize = resizeCanvas;
resizeCanvas();

var signaturePad = new SignaturePad(canvas, {
    backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
});

document.getElementById('save-png').addEventListener('click', function() {
    if (signaturePad.isEmpty()) {
        alert("Tanda Tangan Anda Kosong! Silahkan tanda tangan terlebih dahulu.");
    } else {
        var data = signaturePad.toDataURL('image/png');

        $('#ttd_edit').attr('src', data);

        $('#signature64').val(data);

        console.log(data);
    }
});


document.getElementById('clear').addEventListener('click', function() {
    signaturePad.clear();
});

document.getElementById('undo').addEventListener('click', function() {
    var data = signaturePad.toData();
    if (data) {
        data.pop(); // remove the last dot or line
        signaturePad.fromData(data);
    }
});
</script>
<?= $this->endSection() ?>