<?php 
        session_start();
        include '../dbconnect.php';
        $id=$_GET['id'];

        $query="SELECT * FROM namaproduk WHERE idproduk=" . $id;

        $sql=mysqli_query($conn,$query);

?>
                            <form action="prosesubahproduk.php" method="post" enctype="multipart/form-data" >
                            <?php while($data=mysqli_fetch_array($sql)) { ?>
                            <table>
                                <tr>
									<td>Nama Produk</td>
									<input name="namaproduk" type="text" class="form-control" value="<?php echo $data['namaproduk'] ?>" required autofocus>
                                </tr>
								<div class="form-group">
									<label>Nama Kategori</label>
									<select name="idkategori" class="form-control">
									<option selected>Pilih Kategori</option>
									<?php
									$det=mysqli_query($conn,"select * from kategori order by namakategori ASC")or die(mysqli_error());
									while($d=mysqli_fetch_array($det)){
									?>
										<option value="<?php echo $d['idkategori'] ?>"><?php echo $d['namakategori'] ?></option>
										<?php
								}
								?>		
									</select>
									
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
									<input name="deskripsi" type="text" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Rating (1-5)</label>
									<input name="rate" type="number" class="form-control"  min="1" max="5" required>
								</div>
								<div class="form-group">
									<label>Harga Sebelum Diskon</label>
									<input name="hargabefore" type="number" class="form-control">
								</div>
								<div class="form-group">
									<label>Harga Setelah Diskon</label>
									<input name="hargaafter" type="number" class="form-control">
								</div>
								<div class="form-group">
									<label>Gambar</label>
									<input name="uploadgambar" type="file" class="form-control">
								</div>
                                </table>
                           <?php  } ?>