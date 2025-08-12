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
          <h5 class="card-title"><?=$judul_page?></h5>
          <?php 
            $was_validated = "";
          ?>
          <!-- Vertical Form -->
          <form action="<?=$action?>" class="row g-3 needs-validation <?=$was_validated?>" method="POST" novalidate>
							<input type="hidden" name="id" value="<?=$id?>">
              <input type="hidden" name="request_code" value="<?=$request_code?>">
            
            <div class="col-12">
              <label for="inputPassword4" class="form-label">Tanggal Pengajuan</label>
              <input type="date" name="request_date" class="form-control" value="<?=$request_date?>" required>
            </div>
            <div class="col-12">
              <label for="inputPassword4" class="form-label">Deskripsi Pengajuan</label>
              <input type="text" name="description" class="form-control" value="<?=($description)?>" required>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <?php if(count($list_product_out) ==0){?>
              <a href="<?=$back?>" class="btn btn-secondary">Kembali</a>
              <?php }?>
            </div>
          </form><!-- Vertical Form -->

        </div>
      </div>

    </div>
    
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Datftar Pengajuan ATK
                <a href="<?=$add_list?>" class="btn btn-primary shadow btn-xs sharp me-1"> Tambah <?=$judul_page?>
                  <i class="bi bi-file-plus-fill"></i>
                </a>
              </h5>
             
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th width="100px">No</th>
                    <th >ATK</th>
                    <th >Jumlah</th>
                    <th width="200px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no =1;
                    foreach ($list_product_out as $key => $value) {
                  ?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?= $value['product_name']?></td>
                    <td><?= number_format($value['qty'])?></td>
                    <td>
                        <a href="<?=$update_list.'/'.$value['id']?>" class="btn btn-warning shadow btn-xs sharp me-1"><i class="bi bi-pencil-fill"></i></a>
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

