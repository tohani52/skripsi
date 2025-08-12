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
              <label>Pilih ATK</label>
              <select name="id_product" class="form-control select2" style="width:100%" >
                <?php 
                  foreach ($list_product as $key => $value) { 
                  ?>
                  <option value="<?=$value['id']?>" <?=($value['id'] == $id_product?'selected':'')?>><?=$value['product_name']?></option>
                <?php 
                
                  }?>
              </select>
            </div>
            
            <div class="col-12">
              <label for="inputPassword4" class="form-label">Jumlah Pengajuan</label>
              <input type="text" name="qty" class="form-control number" value="<?=number_format($qty)?>" required>
            </div>
            
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a onclick="history.back()" class="btn btn-secondary">Kembali</a>
            </div>
          </form><!-- Vertical Form -->

        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->
<?= $this->endSection() ?>

