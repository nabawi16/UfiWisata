<!doctype html>
<html class="no-js" lang="en">

<?php 
	session_start();
	include '../dbconnect.php';
    $orderids = $_GET['detailid'];
    $liatcust = mysqli_query($conn,"select * from login l, cart c where orderid='$orderids' and l.userid=c.userid");
    $checkdb = mysqli_fetch_array($liatcust);
    date_default_timezone_set("Asia/Bangkok");

if(isset($_POST['kirim']))
	{
		$updatestatus = mysqli_query($conn,"update cart set status='Pengiriman' where orderid='$orderids'");
		$del =  mysqli_query($conn,"delete from konfirmasi where orderid='$orderids'");
		
		if($updatestatus&&$del){
			echo " <div class='alert alert-success'>
			<center>Pesanan dikirim.</center>
		  </div>
		<meta http-equiv='refresh' content='1; url= manageorder.php'/>  ";
		} else {
			echo "<div class='alert alert-warning'>
			Gagal Submit, silakan coba lagi
		  </div>
		 <meta http-equiv='refresh' content='1; url= manageorder.php'/> ";
		}
		
	};

if(isset($_POST['selesai']))
	{
		$updatestatus = mysqli_query($conn,"update cart set status='Selesai' where orderid='$orderids'");
		
		if($updatestatus){
			echo " <div class='alert alert-success'>
			<center>Transaksi diselesaikan.</center>
		  </div>
		<meta http-equiv='refresh' content='1; url= manageorder.php'/>  ";
		} else {
			echo "<div class='alert alert-warning'>
			Gagal Submit, silakan coba lagi
		  </div>
		 <meta http-equiv='refresh' content='1; url= manageorder.php'/> ";
		}
		
	};
	?>



<html>
<head>
<title>*Data Pesanan</title>
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
			<h2>Daftar Pesanan Customer</h2>
			<h4>UFI Wisata</h4>
            <h3>Order id : #<?php echo $orderids ?></h3>
            <div class="data-tables datatable-dark">
										 <table id="dataTable3" class="display" style="width:100%"><thead class="thead-dark">
											<tr>
												<th>No</th>
												<th>Destinasi</th>
												<th>Jumlah</th>
												<th>Harga</th>
												<th>Total</th>
												
											</tr></thead><tbody>
											<?php 
											$brgs=mysqli_query($conn,"SELECT * from detailorder d, produk p where orderid='$orderids' and d.idproduk=p.idproduk order by d.idproduk ASC");
											$no=1;
											while($p=mysqli_fetch_array($brgs)){
												$total = $p['qty']*$p['hargaafter'];
												
												$result = mysqli_query($conn,"SELECT SUM(d.qty*p.hargaafter) AS count FROM detailorder d, produk p where orderid='$orderids' and d.idproduk=p.idproduk order by d.idproduk ASC");
												$row = mysqli_fetch_assoc($result);
												$cekrow = mysqli_num_rows($result);
												$count = $row['count'];
												
												?>
												
												<tr>
													<td><?php echo $no++ ?></td>
													<td><?php echo $p['namaproduk'] ?></td>
													<td><?php echo $p['qty'] ?></td>
													<td>Rp<?php echo number_format($p['hargaafter']) ?></td>
													<td>Rp<?php echo number_format($total) ?></td>
													
												</tr>
												
												
												<?php 
											}
											?>
										</tbody>
										<tfoot>
											<tr>
												<th colspan="4" style="text-align:right">Total:</th>
												<th>Rp<?php 
												
												$result1 = mysqli_query($conn,"SELECT SUM(d.qty*p.hargaafter) AS count FROM detailorder d, produk p where orderid='$orderids' and d.idproduk=p.idproduk order by d.idproduk ASC");
												$cekrow = mysqli_num_rows($result1);
												$row1 = mysqli_fetch_assoc($result1);
												$count = $row1['count'];
												if($cekrow > 0){
													echo number_format($count);
													} else {
														echo 'No data';
													}?></th>
											</tr>
										</tfoot>
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