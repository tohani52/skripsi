<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

th {
  border: 1px solid #000000;
  padding: 8px;
  font-size: 12px;
}
td {
  border: 1px solid #000000;
  padding: 8px;
  font-size: 12px;
}

/* tr:nth-child(even) {
  background-color: #dddddd;
} */
p {
	margin : 5px;
}
div.auto-row {
  display: flex;
  flex-flow: row wrap;
  justify-content: space-between;
  padding-left: 0;
  padding-right: 0;

  > div {
    flex: 1 1 auto;
    min-height: 1px;
    padding-left: 15px;
    padding-right: 15px;
  }
}
.crop {
	width: 130px; /* Width of the cropped area */
	height: 50px; /* Height of the cropped area */
	overflow: hidden; /* Hide overflow */
	position: relative;
}

.crop img {
	position: absolute;
	right: -100px; /* Adjust the left position */
	width: 150px; /* Width of the original image */
	height: auto; /* Maintain aspect ratio */
}
.crop2 {
	width: 130px; /* Width of the cropped area */
	height: 50px; /* Height of the cropped area */
	overflow: hidden; /* Hide overflow */
	position: relative;
}

.crop2 img {
	position: absolute;
	right: -100px; /* Adjust the left position */
	width: 150px; /* Width of the original image */
	height: auto; /* Maintain aspect ratio */
}
</style>
</head>
<body>
				
<!-- <hr> -->
<table style="width:100%;text-align: left;padding: 0" >
<tr>
	<td rowspan="3" width="20%" style="border:1px;padding-top: 0px;padding-left: 0px;padding-right: 5px;padding-bottom: 0px">
		<img src="data:image/png;base64,<?=$logo?>" width="120" height="80" class="left">
	</td>
	<td width="80%" style="vertical-align: bottom;font-size:18px;border:1px;text-align: right;padding-top: 0px;padding-left: 0px;padding-right: 0px;padding-bottom: 0px">
		<b>LAPORAN PENGAJUAN ATK</b>
	</td>
</tr>
</table>

<br>
	<?php  
	foreach ($list_product_out as $key => $value) {
	?>
	
<table style="width:100%;text-align: left ;font-size:10px;" >
	<tr>
		<th style="width:20%;text-align: center ;">Tanggal</th>
		<th style="width:40%;text-align: center ;">Deskripsi</th>
		<th style="width:20%;text-align: center ;">Diajukan Oleh</th>
		<th style="width:20%;text-align: center ;">Status Pengajuan</th>
	</tr>
	<?php
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
		<td style="text-align: center ;"><?= date('d-F-Y',strtotime($value['request_date']))?></td>
		<td style="text-align: center ;"><?= $value['description']?></td>
		<td style="text-align: center ;"><?= $value['display_name']?></td>
		<td style="text-align: center ;"><?= $status?></td>
	</tr>
	
	<tr>
		<th colspan="3" style="text-align: left ;">ATK</th>
		<th style="text-align: center ;">Jumlah</th>
	</tr>
	<?php  
	
		foreach ($list_product_detail_out as $key => $value2) {
			if($value['request_code'] == $value2['request_code']){
	?>
	
	<tr>
		<td colspan="3" style="text-align: left ;"><?=$value2['product_name']?></td>
		<td style="text-align: center ;"><?=number_format($value2['qty'])?></td>
	</tr>
	<?php
			}
		
		}
	?>
	
</table>
<br>
	<?php
	}
	?>
<br>

<p style="margin-top:30dp;font-size:8px">Printed Date : <?=date('d-M-Y H:i:s')?></p>
</body>
</html>

