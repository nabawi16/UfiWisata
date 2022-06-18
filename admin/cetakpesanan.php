<!doctype html>
<html class="no-js" lang="en">

<?php 
	
	include '../dbconnect.php';
	?>

<html>
<head>
<title>*Cetak Pesanan</title>
<link rel="icon" 
      type="image/png" 
      href="favicon.png">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144808195-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-144808195-1');
	</script>

</head>

<body>
		<div class="container">
			<h2>Daftar Semua Pesanan Customer</h2>
			<h4>UFI Wisata</h4>
				<div class="data-tables datatable-dark">
					<table id="dataTable3" class="display" style="width:100%"><thead class="thead-dark">
											<tr>
                                            <th>No</th>
												<th>ID Pesanan</th>
												<th>Nama Customer</th>
												<th>Tanggal Order</th>
												<th>Total</th>
												<th>Status</th>
												
												<!--<th>Opsi</th>-->
											</tr></thead><tbody>
											<?php 
											$brgs=mysqli_query($conn,"SELECT * from cart c, login l where c.userid=l.userid and status!='Cart' order by idcart ASC");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){
											$orderids = $p['orderid'];
												?>
												
												<tr>
													<td><?php echo $no++ ?></td>
													<td><strong><a href="order.php?orderid=<?php echo $p['orderid'] ?>">#<?php echo $p['orderid'] ?></a></strong></td>
													<td><?php echo $p['namalengkap'] ?></td>
													<td><?php echo $p['tglorder'] ?></td>
													<td>Rp<?php 
												
												$result1 = mysqli_query($conn,"SELECT SUM(d.qty*p.hargaafter) AS count FROM detailorder d, produk p where orderid='$orderids' and p.idproduk=d.idproduk order by d.idproduk ASC");
												$cekrow = mysqli_num_rows($result1);
												$row1 = mysqli_fetch_assoc($result1);
												$count = $row1['count'];
												if($cekrow > 0){
													echo number_format($count);
													} else {
														echo 'No data';
													}?></td>
													<td><?php 
													
													//echo $p['status'] 
													$orders = $p['orderid'];
													$cekkonfirmasipembayaran = mysqli_query($conn,"select * from konfirmasi where orderid='$orders'");
													$cekroww = mysqli_num_rows($cekkonfirmasipembayaran);
													
													if($cekroww > 0){
														echo 'Confirmed';
													} else {
														if($p['status']!='Pengiriman'){
															echo "Menunggu Konfirmasi";
														} else {
															echo "Pengiriman";
														};
													}
													
													?></td>
												</tr>		
												<?php 
											}
											?>
										</tbody>
										</table>
								</div>
						</div>
	
<script>
$(document).ready(function() {
    $('#dataTable3').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           'copy', 'csv', 'excel', 'pdf', 'print',
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

	

</body>

</html>