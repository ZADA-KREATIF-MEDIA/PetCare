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
<?php
    switch($this->uri->segment(2)) :
        case "daftar":?>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC-qlg8MsyURHrlu-NcS1wbMF278nxAnJY&sensor=false"></script> 
    <?php endswitch; ?>
<script>
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
                            $('#streetAddress').text(results[0].address_components[1]['long_name']);
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
                    $('#streetAddress').text(results[0].address_components[1]['long_name']);
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
                    $('#streetAddress').text(results[0].address_components[1]['long_name']);
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
                                $('#streetAddress').text(results[0].address_components[1]['long_name']);
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
                                $('#streetAddress').text(results[0].address_components[1]['long_name']);
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
		<?php break;?>
    <?php endswitch; ?>
</script>
</body>

</html>