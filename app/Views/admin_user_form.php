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
            if($validation->hasError('display_name')) {
              $was_validated = "was-validated";
            }
            if($validation->hasError('user_name')) {
              $was_validated = "was-validated";
            }
            if($validation->hasError('password')) {
              $was_validated = "was-validated";
            }
            if($validation->hasError('repassword')) {
              $was_validated = "was-validated";
            }
          ?>
          <!-- Vertical Form -->
          <form action="<?=$action?>" class="row g-3 needs-validation <?=$was_validated?>" method="POST" novalidate>
							<input type="hidden" name="id" value="<?=$id?>">
            <div class="col-12">
              <label for="inputNanme4" class="form-label">Nama User</label>
              <div class="input-group has-validation">
                <input type="text" name="display_name" class="form-control" value="<?=$display_name?>"  <?=($validation->hasError('display_name')?'required=""':'')?>>
                <?php if($validation->hasError('display_name')) {?>
                  <div class="invalid-feedback">
                        <?= $validation->getError('display_name')?> 
                  </div>
                <?php }?>
              
              </div>
            </div>
            <div class="col-12">
              <label for="inputEmail4" class="form-label">UserName</label>
              <input type="text" name="user_name" class="form-control" value="<?=$user_name?>" <?=($validation->hasError('user_name')?'required=""':'')?>>
              <?php if($validation->hasError('user_name')) {?>
                <div class="invalid-feedback">
                      <?= $validation->getError('user_name')?> 
                </div>
              <?php }?>
            </div>
            <div class="col-12">
              <label for="inputPassword4" class="form-label">Password</label>
              <input type="password" name="password" class="form-control" value="<?=$password?>"  <?=($validation->hasError('password')?'required=""':'')?>>
              <?php if($validation->hasError('password')) {?>
                <div class="invalid-feedback">
                      <?= $validation->getError('password')?> 
                </div>
              <?php }?>
            </div>
            
            <div class="col-12">
              <label for="inputPassword4" class="form-label">Input Ulang Password</label>
              <input type="password" name="repassword" class="form-control" value="<?=($validation->hasError('repassword')?'':$password)?>" <?=($validation->hasError('repassword')?'required=""':'')?>>
              <?php if($validation->hasError('repassword')) {?>
                <div class="invalid-feedback">
                      <?= $validation->getError('repassword')?> 
                </div>
              <?php }?>
            </div>
            
            <div class="col-12">
              <label>Pilih Level User</label>
              <select name="id_level" class="form-control select2" style="width:100%" >
                <?php foreach ($list_level as $key => $value) { ?>
                  <option value="<?=$value['id']?>" <?=($value['id'] == $id_level?'selected':'')?>><?=$value['level_name']?></option>
                <?php } ?>
              </select>
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

