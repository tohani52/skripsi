<?= $this->extend('layout/template') ?>
 
<?= $this->section('content') ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1 style="color:white"><?=$judul_page?></h1>
      <nav >
        <ol class="breadcrumb" style="background-color:#64b5f6;color:white">
          <li class="breadcrumb-item" style="color:white"><?=$judul_page?></li>
          <li class="breadcrumb-item active" style="color:white"><?=$sub_judul_page?></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?=$judul_page?> 
                <a href="<?=$add?>" class="btn btn-primary shadow btn-xs sharp me-1"> Tambah <?=$judul_page?>
                  <i class="bi bi-file-plus-fill"></i>
                </a>
              </h5>
             
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th width="100px">No</th>
                    <th >Nama</th>
                    <th width="200px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no =1;
                    foreach ($list_masterapproval as $key => $value) {
                  ?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?= $value['display_name']?></td>
                    <td>
                        <a id="<?=$value['id']?>" href="#" class="btn btn-danger shadow btn-xs sharp hapus" onclick="myFunction(<?=$value['id']?>)"><i class="bi bi-trash-fill"></i></a>
                      </td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
<?= $this->endSection() ?>

