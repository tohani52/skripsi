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
            if($validation->hasError('field_level_name')) {
              $was_validated = "was-validated";
            }
          ?>
          <!-- Vertical Form -->
          <form action="<?=$action?>" class="row g-3 needs-validation <?=$was_validated?>" method="POST" novalidate>
							<input type="hidden" name="id" value="<?=$id?>">
            <div class="col-12">
              <label for="inputNanme4" class="form-label">Jabatan</label>
              <div class="input-group has-validation">
                <input type="text" name="field_level_name" class="form-control" value="<?=$field_level_name?>"  <?=($validation->hasError('field_level_name')?'required=""':'')?>>
                <?php if($validation->hasError('field_level_name')) {?>
                  <div class="invalid-feedback">
                        <?= $validation->getError('field_level_name')?> 
                  </div>
                <?php }?>
              
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="<?=$back?>" class="btn btn-secondary">Kembali</a>
            </div>
          </form><!-- Vertical Form -->

        </div>
      </div>

    </div>
  </div>
</section>

</main><!-- End #main -->
<?= $this->endSection() ?>

