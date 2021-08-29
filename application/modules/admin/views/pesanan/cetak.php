<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?></title>
</head>
<body>

	<center>
		<h2>NOTA PESANAN CUSTOMER</h2>
		<h4>OBBY PETSHOP</h4>
	

    <div class="card-body">
            <div class="col-md-8">

            <table width="800" border='0'>
              <tr>
                  <td width=150>Nama Customer</td><td width=10>:</td><td><?= $pesanan->id_user ?></td>
              </tr>
              <tr>
                  <td>Tanggal Pemesanan</td><td>:</td><td><?= $pesanan->tanggal ?></td>
              </tr>
              <tr height="40" valign="top">
                  <td>Alamat Pickup</td><td>:</td><td><?= $pesanan->alamat_pengambilan ?></td>
              </tr>
              <tr height="40" valign="top">
                  <td>Alamat Pengantaran</td><td>:</td><td><?= $pesanan->alamat_pengantaran ?></td>
              </tr>
              <tr height="50" valign="top">
                  <td>Catatan</td><td>:</td><td><?= $pesanan->catatan ?></td>
              </tr>
                    
            </table>
            </center>
            <table align="center" width="800">
                <tr >
                    <td><h3>Detail Pesanan </h3><hr></td>
                </tr>
            </table>
           
            <center>
            <table width="800" border='1' style=' border-collapse: collapse; padding: 25px 50px 75px 100px;'>
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Catatan khusus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_pembelian = 0;
                    $total_barang = 0;
                    $nomor = 1;
                    foreach ($detail_pesanan as $data) :
                    ?>
                        <tr align="center">
                            <th scope="row"><?= $nomor++ ?></th>
                            <td><?= $data['nama_produk'] ?></td>
                            <td>Rp. <?= number_format($data['harga']) ?></td>
                            <td><?= $data['jumlah'] ?></td>
                            <td><?= $data['catatan'] ?></td>
                        </tr>
                    <?php
                        $total_pembelian = $total_pembelian += $data['harga'];
                        $total_barang = $total_barang += $data['jumlah'];
                    endforeach;

                    ?>
                    <tr align=center>
                        <td colspan="2"><strong>Total Pembelian : </strong></td>
                        <td>Rp <?= number_format($total_pembelian); ?></td>
                        <td><?= $total_barang; ?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            </center>
            <table align="center" width="800">
                <tr >
                    <td><h3>Hormat Kami,</h3><br>
                    OBBY PETSHOP<hr></td>
                </tr>
            </table>
            

        </div>

	<script>
		window.print();
	</script>
	
</body>
</html>