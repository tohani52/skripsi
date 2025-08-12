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
             
              <table class="table datatable">
                <thead>
                  <tr>
                    <th width="100px">No</th>
                    <th>Tanggal</th>
                    <th>Deskripsi</th>
                    <th>Diajukan Oleh</th>
                    <th>Status Pengajuan</th>
                    <th width="200px">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no =1;
                    foreach ($list_productout as $key => $value) {
                      $approver = explode(",",$value['approval']);
                      if($value['proccess'] > 0 && $value['proccess'] <= count($approver)){
                        $nama = "";
                        foreach ($list_user as $key => $value2) {
                          if($approver[$value['proccess']-1] == $value2['id']){
                            $nama = $value2['display_name'];
                          }
                        }
                        $status = "Menunggu Approval ".$nama;
                      }else{
                        if($value['proccess'] == 0){
                          $status = "Belum disubmit";
                        }else if($value['proccess'] == 999){
                          $status = "Pengajuan ditolak";
                        }else{
                          $status = "Pengajuan diterima";
                        }

                        
                      }
                  ?>
                  <tr>
                    <td><?=$no++?></td>
                    <td><?= date('d-F-Y',strtotime($value['request_date']))?></td>
                    <td><?= $value['description']?></td>
                    <td><?= $value['display_name']?></td>
                    <td><?= $status?></td>
                    <td>
                      <?php if($value['proccess'] == 0){?>
												<a href="/submit_productout/<?=$value['id']?>" class="btn btn-secondary shadow btn-xs sharp me-1"><i class="bi bi-send"></i></a>
                      
												<a href="<?=$update.'/'.$value['request_code']?>" class="btn btn-warning shadow btn-xs sharp me-1"><i class="bi bi-pencil-fill"></i></a>
                        <a id="<?=$value['id']?>" href="#" class="btn btn-danger shadow btn-xs sharp hapus" onclick="myFunction(<?=$value['id']?>)"><i class="bi bi-trash-fill"></i></a>
                        <?php }else{
                          
                          ?>
                          
												<a href="/cetak_productout/<?=$value['id']?>" class="btn btn-danger shadow btn-xs sharp me-1"><i class="bi bi-file-earmark-pdf-fill"></i></a>
                        
                  </tr>
                  <?php } ?>
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

