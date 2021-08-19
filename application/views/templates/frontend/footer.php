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

<!-- Template Main JS File -->
<script src="<?= base_url() ?>assets/frontend/js/main.js"></script>
<?php if($this->uri->segment(1) == "alamat_pengambilan" || $this->uri->segment(1) == "alamat_pengantaran" || $this->uri->segment(2) == "daftar" || $this->uri->segment(2) == "checkout"):?>
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC-qlg8MsyURHrlu-NcS1wbMF278nxAnJY&sensor=false"></script>
<?php endif;?>
<script>
    <?php if($this->uri->segment(1) == ""):?>
        $('#header').removeClass("header-inner-pages");
    <?php endif;?>
    <?php if($this->uri->segment(1) == "alamat_pengambilan" || $this->uri->segment(1) == "alamat_pengantaran"):?>
        var marker
        var geocoder = new google.maps.Geocoder();
        <?php
        if (isset($_SESSION['koordinat']) && $_SESSION['koordinat']!= "") { ?>
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
                                // infowindow.setContent(results[0].formatted_address);
                                // infowindow.open(map, marker);
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
    <?php
    switch($this->uri->segment(1)):
        case "order":?>
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
                        console.log(res);
                        let hasil = $.parseJSON(res);
                        $('#judulBarang').text('Pembelian'+hasil.nama_produk);
                        $('#inputPembelian').attr({"max" : hasil.stock});
                        $('#id_produk').val(hasil.id);
                        $('#harga').val(hasil.harga);
                    }
                });
                $('#beliModal').modal('show');
            }
        <?php break;?>
    <?php endswitch;?>
    <?php
    switch($this->uri->segment(2)) :
        case "daftar":?>
            var map;
            var marker
            var geocoder = new google.maps.Geocoder();
            <?php
            if (isset($_SESSION['koordinat']) && $_SESSION['koordinat']!= "") { ?>
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
                                        // infowindow.setContent(results[0].formatted_address);
                                        // infowindow.open(map, marker);
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
		<?php break;
        case "checkout":?>
            var geocoder = new google.maps.Geocoder();
            let koordinatPengambilan    = '<?= $produk['koordinat_pengambilan'] ?>';
            let koordinatPengantaran    = '<?= $produk['koordinat_pengantaran'] ?>';
            let koordinatPetShop        = '-7.970549,110.5886896';
            var directionsService = new google.maps.DirectionsService();
            var directionsRenderer = new google.maps.DirectionsRenderer();
            function convertToRupiah(angka) {
                var rupiah = '';
                var angkarev = angka.toString().split('').reverse().join('');
                for (var i = 0; i < angkarev.length; i++)
                    if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
                return rupiah.split('', rupiah.length - 1).reverse().join('');
            }
            const updateKeranjang = (id) => {
                $.ajax({
                    url     : '<?= base_url('order/showDetailKeranjang') ?>',
                    method  : 'POST',
                    data    : {id : id},
                    success : function(res){
                        let hasil = $.parseJSON(res);
                        console.log(hasil);
                        $('#id').val(hasil.id);
                        $('#id_produk').val(hasil.id_produk);
                        $('#inputPembelian').attr({"max" : hasil.stock}).val(hasil.jumlah);
                        $('#catatan').text(hasil.catatan);
                        $('#harga').val(hasil.harga);
                        $('#jumlahSebelumnya').val(hasil.jumlah);
                        $('#editKeranjang').modal('show');
                    }
                });
            }
            if(koordinatPengambilan == koordinatPengantaran) {
                let request = {
                    origin          : koordinatPetShop,
                    destination     : koordinatPengambilan,
                    travelMode      : 'DRIVING'
                }
                // console.log(request);
                directionsService.route(request, function(response, status) {
                    if ( status == google.maps.DirectionsStatus.OK ) {
                        jarak =  response.routes[0].legs[0].distance.text;
                        $.ajax({
                            url     : '<?= base_url('order/hitung_harga_ongkir') ?>',
                            method  : 'POST',
                            data    : { jarak : jarak},
                            success : function(res){
                                let hasil = $.parseJSON(res);
                                console.log(hasil);
                                $('#jarakOngkir').text(hasil.jarak);
                                $('#biayajarakOngkir').text(hasil.harga_txt);
                                $('#valueBiayajarakOngkir').val(hasil.harga);
                            }
                        }); 
                    }
                    const hitungTotal = () => {
                        let a = parseInt($('#valueBiayajarakOngkir').val());
                        let subTotal = parseInt($('#valueSubtotalProduk').val());
                        let total = a+subTotal;
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
                    let total = a+b+subTotal;
                    $('#totalBelanja').text(convertToRupiah(total));
                    $('#valueTotalBelanja').val(total);
                }
                hitungTotal();
            }
        <?php break;?>
    <?php endswitch; ?>
</script>
</body>

</html>