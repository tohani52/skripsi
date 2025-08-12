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
	<td rowspan="3" width="50%" style="font-size:20px;border:1px;text-align: left;padding-top: 0px;padding-left: 0px;padding-right: 0px;padding-bottom: 5px">
		<b><u>Pertamina Upstream Data Center</u></b>
	</td>	
	<td  colspan="2"width="30%" style="vertical-align: bottom;font-size:18px;border:1px;text-align: right;padding-top: 0px;padding-left: 0px;padding-right: 0px;padding-bottom: 0px">
		<b>PENGAJUAN ATK</b>
	</td>
</tr>
<tr>
	
  
	<td   colspan="2" width="30%" style="vertical-align: bottom;font-size:12px;border:1px;text-align: right;padding-top: 0px;padding-left: 0px;padding-right: 0px;padding-bottom: 0px">
		<u>Tanggal Pengajuan : <?=date('d F Y', strtotime($productout['request_date']))?></u>
	</td>
</tr>
<tr>
  
  <td   colspan="2" width="30%" style="vertical-align: bottom;font-size:12px;border:1px;text-align: right;padding-top: 0px;padding-left: 0px;padding-right: 0px;padding-bottom: 0px">
	  <u>Diajukan Oleh : <?=$productout['display_name']?></u>
  </td>
</tr>

</table>

<br>
<table style="width:100%;text-align: left ;font-size:10px;" >
	<tr>
		<th style="width:70%;text-align: center ;">ATK</th>
		<th style="width:30%;text-align: center ;">JUMLAH</th>
	</tr>
	<?php  
	foreach ($list_product_out as $key => $value) {
	?>
	<tr>
		<td style="width:70%;text-align: left ;"><?=$value['product_name']?></td>
		<td style="width:30%;text-align: right ;"><?=number_format($value['qty'])?></td>
	</tr>
	
	<?php  
	}
		

	?>
</table>
<br>
<table  class="center" style="width:50%;text-align: left;margin-left:0px;border:0px">

	<tr>
		<td width="200px" style="text-align:left;border:0px;margin-bottom:0px;">Diajukan Oleh</td>
		<td width="200px" style="text-align:left;border:0px;margin-bottom:0px;">Diketahui Oleh</td>
		<td width="200px" style="text-align:left;border:0px;margin-bottom:0px;">Disetujui Oleh</td>
	</tr>

	<tr>
		<td width="200px" style="text-align:left;border:0px">
			<?php if($productout['proccess'] >=1 ){
			?>
				<div ><img src="data:image/png;base64,<?=$ttd?>" style="width:100px" ></div>
			<?php
			} ?>
		</td>
		<td width="200px" style="text-align:left;border:0px">
			<?php if($productout['proccess'] >=2 && $productout['proccess'] != 999){
			?>
			<div ><img src="data:image/png;base64,<?=$ttd2?>" style="width:100px" ></div>
			<?php
			} ?>
		</td>
		<td width="200px" style="text-align:left;border:0px">
			<?php if($productout['proccess'] >=3 && $productout['proccess'] != 999){
			?>
			<div ><img src="data:image/png;base64,<?=$ttd3?>" style="width:100px" ></div>
			<?php
			} ?>
		</td>
	</tr>
	<tr>
		<td width="200px" style="text-align:left;border:0px;margin-bottom:0px;">(<?= $user1['display_name']?>)</td>
		<td width="200px" style="text-align:left;border:0px;margin-bottom:0px;">(<?= $user2['display_name']?>)</td>
		<td width="200px" style="text-align:left;border:0px;margin-bottom:0px;">(<?= $user3['display_name']?>)</td>
	</tr>
	<tr>
	<td width="200px" style="text-align:left;border:0px;margin-top:0px;"><?= $user1['level_name']?></td>
		<td width="200px" style="text-align:left;border:0px;margin-top:0px;"><?= $user2['level_name']?></td>
		<td width="200px" style="text-align:left;border:0px;margin-top:0px;"><?= $user3['level_name']?></td>
	</tr>
</table>
<br>

<p style="margin-top:30dp;font-size:8px">Printed Date : <?=date('d-M-Y H:i:s')?></p>
</body>
</html>

