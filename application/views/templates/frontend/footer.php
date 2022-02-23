<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>Arsha</h3>
                    <p>
                        A108 Adam Street <br>
                        New York, NY 535022<br>
                        United States <br><br>
                        <strong>Phone:</strong> +1 5589 55488 55<br>
                        <strong>Email:</strong> info@example.com<br>
                    </p>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Social Networks</h4>
                    <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                    <div class="social-links mt-3">
                        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container footer-bottom clearfix">
        <div class="copyright">
            &copy; Copyright <strong><span>Arsha</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="<?= base_url() ?>assets/frontend/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url()?>assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/frontend/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?= base_url() ?>assets/frontend/vendor/php-email-form/validate.js"></script>
<script src="<?= base_url() ?>assets/frontend/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="<?= base_url() ?>assets/frontend/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= base_url() ?>assets/frontend/vendor/venobox/venobox.min.js"></script>
<script src="<?= base_url() ?>assets/frontend/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?= base_url() ?>assets/frontend/vendor/aos/aos.js"></script>
<script src="<?= base_url() ?>assets/frontend/js/sweetalert2.js"></script>

<!-- Template Main JS File -->
<script src="<?= base_url() ?>assets/frontend/js/main.js"></script>
<?php if($this->uri->segment(1) == "alamat_pengambilan" || $this->uri->segment(1) == "alamat_pengantaran" || $this->uri->segment(2) == "daftar" || $this->uri->segment(2) == "checkout" || $this->uri->segment(1) == "checkout"):?>
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC-qlg8MsyURHrlu-NcS1wbMF278nxAnJY"></script>
<?php endif;?>
<script>
    <?php if($this->uri->segment(1) == ""):?>
        $('#header').removeClass("header-inner-pages");
    <?php endif;?>
    <?php if($this->uri->segment(1) == "alamat_pengambilan" || $this->uri->segment(1) == "alamat_pengantaran" || $this->uri->segment(2) == "daftar"):?>
        var map;
        var marker
        var geocoder = new google.maps.Geocoder();
        var arrKoord;
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            let koordinat = position.coords.latitude+','+position.coords.longitude;
            $.ajax({
                url     : "<?= base_url('home/setKoordinat')?>",
                method  : "POST",
                data    : { koordinat : koordinat},
                success : function(res){
                    window.location.reload();
                }
            });
        }

        <?php if (isset($_SESSION['koordinat']) && $_SESSION['koordinat']!= "") { ?>
            var koordinat = new google.maps.LatLng(<?php echo $_SESSION['koordinat'];?>);
        <?php }else{ ?>
            var koordinat = new google.maps.LatLng(-7.783224820470059,110.37240414007569);
        <?php } ?>
        var geocoder = new google.maps.Geocoder();
        var infowindow = new google.maps.InfoWindow();

        function taruhMarker(peta, posisiTitik){
            if( marker ){
            // pindahkan marker
                marker.setPosition(posisiTitik);
            } else {
            // buat marker baru
            marker = new google.maps.Marker({
                position: posisiTitik,
                map: peta,
                draggable: true 
            });
            }
            document.getElementById("latitude").value = posisiTitik.lat();
            document.getElementById("longitude").value = posisiTitik.lng();
        }
        
        function disablePOIInfoWindow(){
            var fnSet = google.maps.InfoWindow.prototype.set;
            google.maps.InfoWindow.prototype.set = function () {
            };
        }

        function initialize() {
            var propertiPeta = {
                center:koordinat,
                zoom:18,
                mapTypeId:google.maps.MapTypeId.ROADMAP,
                visible:true,
                gestureHandling: "greedy",
                disableDefaultUI: true
            };
            var peta = new google.maps.Map(document.getElementById("map"), propertiPeta);
            disablePOIInfoWindow();  
            
            // even listner ketika peta diklik
            google.maps.event.addListener(peta, 'click', function(event) {
                geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
    
                            $('#detailAlamat').text(results[0].formatted_address);
                            $('#alamat').val(results[0].formatted_address);
                            $('#latitude').val(marker.getPosition().lat());
                            $('#longitude').val(marker.getPosition().lng());
                        }
                    }
                });
                taruhMarker(this, event.latLng);
            });
            if ($('#latitude').val() == "") {
                geocoder.geocode( { 'latLng': koordinat}, function(results, status) {
                                    if (status == google.maps.GeocoderStatus.OK) {
                    let latitude = results[0].geometry.location.lat();
                    let longitude = results[0].geometry.location.lng();
                    $('#detailAlamat').text(results[0].formatted_address);
                    $('#alamat').val(results[0].formatted_address);
                    $('#latitude').val(latitude);
                    $('#longitude').val(longitude);
                } 
            })
            }
            marker = new google.maps.Marker({
                position: koordinat,
                map: peta,
                animation: google.maps.Animation,
                draggable:true
            });


            google.maps.event.addListener(marker, 'dragend', function() {
                geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            $('#alamat').text(results[0].address_components[1]['long_name']);
                            $('#detailAlamat').text(results[0].formatted_address);
                            $('#latitude').val(marker.getPosition().lat());
                            $('#longitude').val(marker.getPosition().lng());
                        }
                    }
                });
            });
        }

        function getlatlang(){
            let address = document.getElementById('address').value;
            if (address != "") {
                geocoder.geocode( { 'address': address}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var latitude = results[0].geometry.location.lat();
                        var longitude = results[0].geometry.location.lng();
                        $('#detailAlamat').text(results[0].formatted_address);
                        $('#alamat').val(results[0].formatted_address);
                        $('#latitude').val(latitude);
                        $('#longitude').val(longitude);
                    } 
                    var latlang = {lat: latitude, lng: longitude};

                    map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 18,
                        center: latlang,
                        disableDefaultUI: true 
                    });

                    marker = new google.maps.Marker({
                        map: map,
                        position: latlang,
                        disableDefaultUI: true,
                        draggable: true
                    });

                    google.maps.event.addListener(marker, 'dragend', function() {
                        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                if (results[0]) {
            
                                    $('#detailAlamat').text(results[0].formatted_address);
                                    $('#alamat').val(results[0].formatted_address);
                                    $('#latitude').val(marker.getPosition().lat());
                                    $('#longitude').val(marker.getPosition().lng());
                                    // infowindow.setContent(results[0].formatted_address);
                                    // infowindow.open(map, marker);
                                }
                            }
                        });
                    });

                    var propertiPeta = {
                        center:koordinat,
                        zoom:18,
                        mapTypeId:google.maps.MapTypeId.ROADMAP,
                        visible:true,
                        gestureHandling: "greedy",
                        disableDefaultUI: true
                    };

                    google.maps.event.addListener(map, 'click', function(event) {
                        geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {
                                if (results[0]) {
                                    $('#detailAlamat').text(results[0].formatted_address);
                                    $('#alamat').val(results[0].formatted_address);
                                    $('#latitude').val(marker.getPosition().lat());
                                    $('#longitude').val(marker.getPosition().lng());
                                }
                            }
                        });
                        taruhMarker(this, event.latLng);
                    });

                });
            }
        }
        // event jendela di-load  
        google.maps.event.addDomListener(window, 'load', initialize);
    <?php endif;?>
    <?php if($this->uri->segment(1) == "order"):?>
        $('#order').addClass('active');
        $('.btn-number').click(function(e){
            e.preventDefault();
            fieldName = $(this).attr('data-field');
            type      = $(this).attr('data-type');
            var input = $("input[name='"+fieldName+"']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if(type == 'minus') {                
                    if(currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    } 
                    if(parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if(type == 'plus') {

                    if(currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if(parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });
        $('.input-number').focusin(function(){
            $(this).data('oldValue', $(this).val());
        });
        $('.input-number').change(function() {
            minValue =  parseInt($(this).attr('min'));
            maxValue =  parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());
            name = $(this).attr('name');
            if(valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if(valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }
        });
        $(".input-number").keydown(function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) || 
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
        beli = (id) => {
            $.ajax({
                url         : '<?= base_url('order/show') ?>',
                method      : 'POST',
                data        : {id : id},
                success     : function(res){
                    let hasil = $.parseJSON(res);
                    $('#judulBarang').text('Pembelian'+hasil.nama_produk);
                    $('#inputPembelian').attr({"max" : hasil.stock});
                    $('#id_produk').val(hasil.id);
                    $('#harga').val(hasil.harga);
                }
            });
            $('#beliModal').modal('show');
        }
    <?php endif;?>
    <?php if($this->uri->segment(1) == "checkout" || $this->uri->segment(2) == "checkout"):?>
        function convertToRupiah(angka) {
            var rupiah = '';
            var angkarev = angka.toString().split('').reverse().join('');
            for (var i = 0; i < angkarev.length; i++)
                if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
            return rupiah.split('', rupiah.length - 1).reverse().join('');
        }
        $('#order').addClass('active');
        $('.btn-number').click(function(e){
            e.preventDefault();
            fieldName = $(this).attr('data-field');
            type      = $(this).attr('data-type');
            var input = $("input[name='"+fieldName+"']");
            var currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if(type == 'minus') {                
                    if(currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    } 
                    if(parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if(type == 'plus') {

                    if(currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if(parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });
        $('.input-number').focusin(function(){
            $(this).data('oldValue', $(this).val());
        });
        $('.input-number').change(function() {
            minValue =  parseInt($(this).attr('min'));
            maxValue =  parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());
            name = $(this).attr('name');
            if(valueCurrent >= minValue) {
                $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val($(this).data('oldValue'));
            }
            if(valueCurrent <= maxValue) {
                $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
            } else {
                alert('Sorry, the maximum value was reached');
                $(this).val($(this).data('oldValue'));
            }
        });
        $(".input-number").keydown(function (e) {
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) || 
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
        beli = (id) => {
            $.ajax({
                url         : '<?= base_url('order/show') ?>',
                method      : 'POST',
                data        : {id : id},
                success     : function(res){
                    let hasil = $.parseJSON(res);
                    $('#judulBarang').text('Pembelian'+hasil.nama_produk);
                    $('#inputPembelian').attr({"max" : hasil.stock});
                    $('#id_produk').val(hasil.id);
                    $('#harga').val(hasil.harga);
                }
            });
            $('#beliModal').modal('show');
        }
        window.addEventListener('load', (event) => {
            var geocoder = new google.maps.Geocoder();
            let koordinatPengambilan    = '<?= $produk['koordinat_pengambilan'] ?>';
            let koordinatPengantaran    = '<?= $produk['koordinat_pengantaran'] ?>';
            let koordinatPetShop        = '-7.970549,110.5886896';
            var directionsService = new google.maps.DirectionsService();
            var directionsRenderer = new google.maps.DirectionsRenderer();
            if(koordinatPengambilan == koordinatPengantaran) {
                let request = {
                    origin          : koordinatPetShop,
                    destination     : koordinatPengambilan,
                    travelMode      : 'DRIVING'
                }
                directionsService.route(request, function(response, status) {
                    if ( status == google.maps.DirectionsStatus.OK ) {
                        let jarak =  response.routes[0].legs[0].distance.text;
                        $.ajax({
                            url     : '<?= base_url('order/hitung_harga_ongkir') ?>',
                            method  : 'POST',
                            data    : { jarak : jarak},
                            success : function(res){
                                let hasil = $.parseJSON(res);
                                $('#jarakOngkir').text(hasil.jarak);
                                $('#biayajarakOngkir').text(hasil.harga_txt);
                                $('#valueBiayajarakOngkir').val(hasil.harga);
                                $('#valueJarakOngkir').val(hasil.jarak);
                            }
                        }); 
                    }
                    const hitungTotal = () => {
                        let total
                        let a = parseInt($('#valueBiayajarakOngkir').val());
                        let subTotal = parseInt($('#valueSubtotalProduk').val());
                        if(subTotal > 500000){
                            total = subTotal;
                        }else{
                            total = a+subTotal;
                        }
                        $('#totalBelanja').text(convertToRupiah(total));
                        $('#valueTotalBelanja').val(total);
                    }
                    hitungTotal();
                });
            } else {
                var jarak1;
                var jarak2;
                let request1 = {
                    origin          : koordinatPetShop,
                    destination     : koordinatPengambilan,
                    travelMode      : 'DRIVING'
                }
    
                let request2 = {
                    origin          : koordinatPetShop,
                    destination     : koordinatPengantaran,
                    travelMode      : 'DRIVING'
                }
    
                directionsService.route(request1, function(response, status) {
                    if ( status == google.maps.DirectionsStatus.OK ) {
                        jarak1 =  response.routes[0].legs[0].distance.text; 
                        $.ajax({
                            url     : '<?= base_url('order/hitung_harga_pengambilan') ?>',
                            method  : 'POST',
                            data    : { jarak : jarak1},
                            success : function(res){
                                let hasil = $.parseJSON(res);
                                $('#jarakPengambilan').text(hasil.jarak);
                                $('#valueJarakPengambilan').val(hasil.jarak);
                                $('#valueBiayaOngkirPengambilan').val(hasil.harga);
                                $('#biayaOngkirPengambilan').text(hasil.harga_txt);
                            }
                        });
                    }
                });
    
                directionsService.route(request2, function(response, status) {
                    if ( status == google.maps.DirectionsStatus.OK ) {
                        jarak2 =  response.routes[0].legs[0].distance.text;
                        $.ajax({
                            url     : '<?= base_url('order/hitung_harga_pengantaran') ?>',
                            method  : 'POST',
                            data    : { jarak : jarak2},
                            success : function(res){
                                let hasil = $.parseJSON(res);
                                $('#jarakPengantaran').text(hasil.jarak);
                                $('#valueJarakPengantaran').val(hasil.jarak);
                                $('#valueBiayaOngkirPengantaran').val(hasil.harga);
                                $('#biayaOngkirPengantaran').text(hasil.harga_txt);
                            }
                        }); 
                    }
                });
    
                const hitungTotal = () => {
                    let a = parseInt($('#valueBiayaOngkirPengambilan').val());
                    let b = parseInt($('#valueBiayaOngkirPengantaran').val());
                    let subTotal = parseInt($('#valueSubtotalProduk').val());
                    let total
                    if(subTotal > 500000){
                        total = subTotal;
                    }else{
                        total = a+b+subTotal;
                    }
                    $('#totalBelanja').text(convertToRupiah(total));
                    $('#valueTotalBelanja').val(total);
                }
                hitungTotal();
            }
        });
        const updateKeranjang = (id) => {
            $.ajax({
                url     : '<?= base_url('order/showDetailKeranjang') ?>',
                method  : 'POST',
                data    : {id : id},
                success : function(res){
                    let hasil = $.parseJSON(res);
                    $('#id').val(hasil.id);
                    $('#id_produk').val(hasil.id_produk);
                    $('#inputPembelian').attr({"max" : hasil.stock}).val(hasil.jumlah);
                    $('#catatanProduk').text(hasil.catatan);
                    $('#harga').val(hasil.harga);
                    $('#jumlahSebelumnya').val(hasil.jumlah);
                    $('#editKeranjang').modal('show');
                }
            });
        }
        const selfService = () => {
            $('#jenisPelayananSimpan').val('self_service');
            $.ajax({
                url     : "<?= base_url('order/set_self_service')?>",
                method  : "GET",
                dataType : "JSON",
                success : function(res){
                    console.log(res);
                    if(res.cek_belanjaan > 0){
                        Swal.fire(
                            'Perhatian!!',
                            'Anda memiliki tipe barang berjenis jasa, anda tidak dapat menggunakan layanan ini',
                            'warning'
                        )
                    }else {
                        let totalSubTotalProduk= $('#valueSubtotalProduk').val();
                        $('#jenisPelayanan').text(res.jenis_pembelian);
                        $('#jarakOngkir').text('-');
                        $('#biayajarakOngkir').text(res.status);
                        $('#valueBiayajarakOngkir').val(0);
                        $('#totalBelanja').text(convertToRupiah(totalSubTotalProduk));
                        $('#valueTotalBelanja').val(totalSubTotalProduk);
                        $('#bagianAlamatPengambilan').addClass('d-none');
                        $('#bagianAlamatPengantaran').addClass('d-none');
                        $('#bagianHargaPengambilan').addClass('d-none');
                        $('#bagianHargaPengantaran').addClass('d-none');
                        $('#valueBiayaOngkirPengambilan').val(0);
                        $('#valueBiayaOngkirPengantaran').val(0);
                    }
                }
            })
        }
        const servicePengantaran = () => {
            $('#jenisPelayanan').text('Pengantaran');
            $('#jenisPelayananSimpan').val('pengantaran');
            $('#bagianAlamatPengambilan').addClass('d-none');
            var geocoder                = new google.maps.Geocoder();
            let totalSubTotalProduk     = $('#valueSubtotalProduk').val();
            let koordinatPetShop        = '-7.970549,110.5886896';
            let koordinatPengantaran    = '<?= $produk['koordinat_pengantaran'] ?>';
            var directionsService       = new google.maps.DirectionsService();
            var directionsRenderer      = new google.maps.DirectionsRenderer();
            let request = {
                origin          : koordinatPetShop,
                destination     : koordinatPengantaran,
                travelMode      : 'DRIVING'
            }
            directionsService.route(request, function(response, status) {
                if ( status == google.maps.DirectionsStatus.OK ) {
                    let jarak =  response.routes[0].legs[0].distance.text;
                    console.log(jarak);
                    $.ajax({
                        url     : '<?= base_url('order/hitung_harga_pengantaran') ?>',
                        method  : 'POST',
                        data    : { jarak : jarak},
                        success : function(res){
                            let hasil = $.parseJSON(res);
                            if(hasil.cek_belanjaan > 0){
                                Swal.fire(
                                    'Perhatian!!',
                                    'Anda memiliki tipe barang berjenis jasa, anda tidak dapat menggunakan layanan ini',
                                    'warning'
                                )
                            }else {
                                let ongkir;
                                if(hasil.harga > 500000){
                                    ongkir = 0;
                                } else {
                                    ongkir = hasil.harga;
                                }
                                $('#jarakOngkir').text(hasil.jarak);
                                $('#biayajarakOngkir').text(hasil.harga_txt);
                                $('#valueBiayajarakOngkir').val(ongkir);
                                $('#valueJarakOngkir').val(hasil.jarak);
                                $('#textFreeOngkir').text(convertToRupiah(hasil.harga));
                                totalBelanja = parseInt(totalSubTotalProduk) + parseInt(ongkir);
                                $('#totalBelanja').text(convertToRupiah(totalBelanja));
                                $('#valueTotalBelanja').val(totalBelanja);
                                $('#bagianHargaPengambilan').addClass('d-none');
                                $('#valueBiayaOngkirPengambilan').val(0);
                            }
                        }
                    }); 
                }
            });
        }
    <?php endif;?>
    <?php if($this->uri->segment(1) == "transaksi" || $this->uri->segment(2) == "transaksi"):?>
        const detailTransaksi = (id) => {
            $.ajax({
                url     : '<?= base_url('order/detail_transaksi') ?>',
                method  : 'POST',
                data    : { id : id },
                success : function(res) {
                    let hasil = $.parseJSON(res);
                    $('#detailTransaksi').empty();
                    let splitJarakPengantaran = hasil.jarak_pengantaran.split(" ");
                    let html = '';
                    $.each(hasil.detail, function(index,value){
                        html += `
                        <div class="mb-3">
                            <h5>${value.nama_barang} | ${value.kategori}</h5>
                            <span class="d-block">@${value.harga}x${value.jumlah} = ${value.total_harga}</span>
                            <span>Catatan Produk:</span>
                            <span>${value.catatan}</span>
                        </div>
                        `;
                    });
                    switch (hasil.jenis_transaksi){
                        case  "lengkap":
                            let splitJarakPengambilan = hasil.jarak_pengambilan.split(" ");
                            html += `
                                <h6>Rincian Tarif Ongkir</h6>
                                <hr/>
                            `
                            if(splitJarakPengantaran[0] <= 5 && splitJarakPengambilan[0] <= 5){
                                html += `
                                        <span>Jarak Pengambilan: ${hasil.jarak_pengambilan}</span><br/>
                                        <span>Jarak Pengantaran: ${hasil.jarak_pengantaran}</span><br/>
                                        <span>Tarif : ${hasil.harga_jarak_minimal}</span><br/>
                                        <span><i class="fas fa-info-circle text-info"></i> Untuk pengiriman dibawah 5 km maka akan dikenakan tarif ${hasil.harga_jarak_minimal}</span>
                                    `
                            }else{
                                let jarakKelebihanOngkirNormal = parseFloat(splitJarakPengantaran[0]) + parseFloat(splitJarakPengambilan[0]) - parseInt(5);
                                let perhitunganChageOngkir = (parseInt(jarakKelebihanOngkirNormal) *  parseInt(hasil.harga_charge)) + (parseInt(hasil.harga_jarak_minimal) * parseInt(1));
                                html += `
                                    <span>Jarak Pengambilan: ${hasil.jarak_pengambilan}</span><br/>
                                    <span>Jarak Pengantaran: ${hasil.jarak_pengantaran}</span><br/>
                                    <span>Tarif Minimal : ${hasil.harga_jarak_minimal} = ${parseInt(hasil.harga_jarak_minimal)}</span><br/>
                                    <span>Tarif Ongkir : ${jarakKelebihanOngkirNormal} * ${hasil.harga_charge} = ${perhitunganChageOngkir}</span><br/>
                                    <span><i class="fas fa-info-circle text-info"></i> Untuk pengiriman diatas 5 km maka akan dikenakan tarif tambahan ${hasil.harga_jarak_minimal}</b> / km</span>
                                `
                            }
                            break;
                        case "pengantaran":
                            splitJarakPengantaran = hasil.jarak_pengantaran.split(" ");
                            html += `
                                <h6>Rincian Tarif Ongkir</h6>
                                <hr/>
                            `
                            if(splitJarakPengantaran[0] <= 5){
                                html += `
                                        <span>Jarak Pengantaran: ${hasil.jarak_pengantaran}</span><br/>
                                        <span>Tarif : ${hasil.harga_jarak_minimal}</span><br/>
                                        <span><i class="fas fa-info-circle text-info"></i> Untuk pengiriman dibawah 5 km maka akan dikenakan tarif ${hasil.harga_jarak_minimal}</span>
                                    `
                            }else{
                                let jarakKelebihanOngkirNormal = Math.round(splitJarakPengantaran[0]) - parseInt(5);
                                let perhitunganChageOngkir = (parseInt(jarakKelebihanOngkirNormal) *  parseInt(hasil.harga_charge)) + parseInt(5000);
                                html += `
                                    <span>Jarak Pengantaran: ${hasil.jarak_pengantaran}</span><br/>
                                    <span>Tarif Minimal : ${hasil.harga_jarak_minimal}</span><br/>
                                    <span>Tarif Ongkir : ${jarakKelebihanOngkirNormal} * ${hasil.harga_charge} = ${perhitunganChageOngkir}</span><br/>
                                    <span><i class="fas fa-info-circle text-info"></i> Untuk pengiriman datas 5 km maka akan dikenakan tarif ${hasil.harga_jarak_minimal}</b> / km</span>
                                `
                            }
                            break
                    }
                    html += `
                        <hr/>
                        <span>Subtotal: ${hasil.subtotal}</span><br/>`
                        if(hasil.ongkir != "") {
                    html +=        `<span>Ongkir: ${hasil.ongkir}</span>`
                        } else {
                    html +=        `<span>Ongkir: - </span>`
                        }
                    html += `<h6>Total: ${hasil.total}</h6>`
                    $('#detailTransaksi').append(html);
                    $('#detailTransaksiModal').modal('show');
                } 
            });
        }
    <?php endif;?>
</script>
</body>

</html>