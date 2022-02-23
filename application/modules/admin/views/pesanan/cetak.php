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
                        <td width=150>Nama Customer</td>
                        <td width=10>:</td>
                        <td><?= $customer->nama ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Pemesanan</td>
                        <td>:</td>
                        <td><?= $pesanan->tanggal ?></td>
                    </tr>
                    <tr height="40" valign="top">
                        <td>Alamat Pickup</td>
                        <td>:</td>
                        <td><?= $pesanan->alamat_pengambilan ?></td>
                    </tr>
                    <tr height="40" valign="top">
                        <td>Alamat Pengantaran</td>
                        <td>:</td>
                        <td><?= $pesanan->alamat_pengantaran ?></td>
                    </tr>
                    <tr height="40" valign="top">
                        <td>Jenis Transaksi</td>
                        <td>:</td>
                        <td><?= ucwords($pesanan->jenis_transaksi) ?></td>
                    </tr>
                    <tr height="50" valign="top">
                        <td>Catatan</td>
                        <td>:</td>
                        <td><?= $pesanan->catatan ?></td>
                    </tr>

                </table>
    </center>
    <table align="center" width="800">
        <tr>
            <td>
                <h3>Detail Pesanan </h3>
                <hr>
            </td>
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
                        <td>Rp. <?= number_format($data['harga'],0,'.','.') ?></td>
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
                    <td>Rp <?= number_format($total_pembelian,0,'.','.'); ?></td>
                    <td><?= $total_barang; ?></td>
                    <td></td>
                </tr>
                <?php $explode_jarak_pengantaran = explode(' ',$pesanan->jarak_pengantaran); ?>
                <?php switch($pesanan->jenis_transaksi):
                case "lengkap":?>
                    <tr align=center>
                        <td colspan="5"><strong>Rincian Ongkir : </strong></td>
                    </tr>
                    <?php $explode_jarak_pengambilan = $pesanan->jarak_pengambilan ? explode(' ',$pesanan->jarak_pengambilan) : 0; ?>
                    <?php if(round($explode_jarak_pengambilan[0]) <= 5 && round($explode_jarak_pengantaran[0]) <= 5):?>
                        <tr align=center>
                            <td colspan="2">Jarak Pengambilan:</td>
                            <td colspan="3"><?= $pesanan->jarak_pengambilan ?></td>
                        </tr>
                        <tr align=center>
                            <td colspan="2">Jarak Pengantaran:</td>
                            <td colspan="3"><?= $pesanan->jarak_pengantaran ?></td>
                        </tr>
                        <tr>
                            <td colspan="5">Untuk pengiriman dibawah 5 km maka akan dikenakan tarif <?= number_format($setting_ongkir->harga_jarak_minimal,0,'.','.') ?></td>
                        </tr>
                    <?php else:?>
                       <?php
                            $jarak_kelebihan_ongkir_normal = $explode_jarak_pengambilan[0] + $explode_jarak_pengantaran[0] - 5;
                            $perhitungan_chage_ongkir = $jarak_kelebihan_ongkir_normal + $setting_ongkir->harga + ($setting_ongkir->harga_jarak_minimal * 2);
                            $total_charge = $jarak_kelebihan_ongkir_normal * $setting_ongkir->harga;
                            $pembagian_jarak_minimal = 5/2;
                            $biaya_pengambilan = (($explode_jarak_pengambilan[0] - $pembagian_jarak_minimal) * 5000);
                            $biaya_pengantaran = (($explode_jarak_pengantaran[0] - $pembagian_jarak_minimal) * 5000);
                            $pengurangan_jarak_pengambilan = $explode_jarak_pengambilan[0] - 5;
                            $pengurangan_jarak_pengantaran = $explode_jarak_pengantaran[0] - 5;
                        ?>
                        <tr align=center>
                            <td colspan="2">Jarak Pengambilan:</td>
                            <td colspan="3"><?= $pesanan->jarak_pengambilan ?></td>
                        </tr>
                        <tr align=center>
                            <td colspan="2">Jarak Pengantaran:</td>
                            <td colspan="3"><?= $pesanan->jarak_pengantaran ?></td>
                        </tr>
                        <tr align=center>
                            <td colspan="2">Biaya Pengambilan:</td>
                            <td colspan="3"><?php echo "5 * ".$setting_ongkir->harga_jarak_minimal."=".number_format(5*$setting_ongkir->harga_jarak_minimal,0,'.','.')." + ".$pengurangan_jarak_pengambilan." * 5000 = ".number_format($pengurangan_jarak_pengambilan*5000,0,'.','.') ?></td>
                        </tr>
                        <tr align=center>
                            <td colspan="2">Biaya Pengantaran:</td>
                            <td colspan="3"><?php echo "5 * ".$setting_ongkir->harga_jarak_minimal."=".number_format(5*$setting_ongkir->harga_jarak_minimal,0,'.','.')." + ".$pengurangan_jarak_pengantaran." * 5000 = ".number_format($pengurangan_jarak_pengantaran*5000,0,'.','.') ?></td>
                        </tr>
                        <!--<tr align=center>-->
                        <!--    <td colspan="2">Detail Tarif Ongkir:</td>-->
                        <!--    <td colspan="3"><?php echo $jarak_kelebihan_ongkir_normal." * ".number_format($setting_ongkir->harga,0,'.','.')." = ".number_format($total_charge,0,'.','.'); ?></td>-->
                        <!--</tr>-->
                        <tr>
                            <td colspan="5">Untuk pengiriman diatas 5 km maka akan dikenakan tarif tambahan <b><?= number_format($setting_ongkir->harga,0,'.','.') ?></b> / km</td>
                        </tr>
                    <?php endif;?>
                <?php break;?>
                <?php case "pengantaran":?>
                    <?php if(round($explode_jarak_pengantaran[0]) <= 5):?>
                        <tr align=center>
                            <td colspan="2">Jarak Pengambilan:</td>
                            <td colspan="3"><?= $pesanan->jarak_pengambilan ?></td>
                        </tr>
                        <tr align=center>
                            <td colspan="2">Jarak Pengantaran:</td>
                            <td colspan="3"><?= $pesanan->jarak_pengantaran ?></td>
                        </tr>
                        <tr>
                            <td colspan="5">Untuk pengiriman dibawah 5 km maka akan dikenakan tarif <?= number_format($setting_ongkir->harga_jarak_minimal,0,'.','.') ?></td>
                        </tr>
                    <?php else:?>
                        <?php
                            $jarak_kelebihan_ongkir_normal = round($explode_jarak_pengantaran[0]) - 5;
                            $perhitungan_chage_ongkir = $jarak_kelebihan_ongkir_normal + $setting_ongkir->harga + $setting_ongkir->harga_jarak_minimal;
                            $total_charge = $jarak_kelebihan_ongkir_normal * $setting_ongkir->harga;
                            $biaya_pengambilan = (($explode_jarak_pengambilan[0] - $pembagian_jarak_minimal) * 5000);
                            $biaya_pengantaran = (($explode_jarak_pengambilan[0] - $pembagian_jarak_minimal) * 5000);
                        ?>
                        <tr align=center>
                            <td colspan="2">Jarak Pengambilan:</td>
                            <td colspan="3"><?= $pesanan->jarak_pengambilan ?></td>
                        </tr>
                        <tr align=center>
                            <td colspan="2">Jarak Pengantaran:</td>
                            <td colspan="3"><?= $pesanan->jarak_pengantaran ?></td>
                        </tr><tr align=center>
                            <td colspan="2">Biaya Pengambilan:</td>
                            <td colspan="3"><?= number_format($biaya_pengambilan,0,'.','.') ?></td>
                        </tr><tr align=center>
                            <td colspan="2">Biaya Pengantaran:</td>
                            <td colspan="3"><?= number_format($biaya_pengantaran,0,'.','.') ?></td>
                        </tr>
                        <!--<tr align=center>-->
                        <!--    <td colspan="2">Detail Tarif Ongkir:</td>-->
                        <!--    <td colspan="3"><?php echo $jarak_kelebihan_ongkir_normal." * ".number_format($setting_ongkir->harga,0,'.','.')." = ".number_format($total_charge,0,'.','.'); ?></td>-->
                        <!--</tr>-->
                        <tr>
                        <td colspan="5">Untuk pengiriman diatas 5 km maka akan dikenakan tarif tambahan <b><?= number_format($setting_ongkir->harga,0,'.','.') ?></b> / km</td>
                        </tr>
                    <?php endif;?>
                <?php break;?>
                <?php endswitch;?>
                <tr align=center>
                    <td colspan="2"><strong>Total Ongkir : </strong></td>
                    <?php if($pesanan->ongkir != ""):?>
                        <td colspan="3">Rp <?= number_format($pesanan->ongkir,0,'.','.'); ?></td>
                    <?php else:?>
                        <td colspan="3" style="text-align: left;">Free Ongkir</td>
                    <?php endif;?>
                </tr>
                <tr align=center>
                    <td colspan="2"><strong>Kode Uniq : </strong></td>
                    <td colspan="3">Rp <?= number_format($pesanan->kode_uniq,0,'.','.'); ?></td>
                </tr>
                <tr align=center>
                    <td colspan="2"><strong>Total Pembelian : </strong></td>
                    <td colspan="3">Rp <?= number_format($pesanan->total_pembelian,0,'.','.'); ?></td>
                </tr>
            </tbody>
        </table>

    </center>
    <table align="center" width="800">
        <tr>
            <td>
                <h3>Hormat Kami,</h3><br>
                OBBY PETSHOP
                <hr>
            </td>
        </tr>
    </table>


    </div>

    <script>
        window.print();
    </script>

</body>

</html>