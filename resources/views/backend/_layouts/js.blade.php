@php
$route = url()->current();
@endphp

<!-- ================== BEGIN core-js ================== -->
<script src="{{ asset('assets/hud/assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/hud/assets/js/app.min.js') }}"></script>
<!-- ================== END core-js ================== -->


@if( $route == route('admin.dashboard'))
<!-- ================== BEGIN page-js ================== -->
<script src="{{ asset('assets/hud/assets/plugins/jvectormap-next/jquery-jvectormap.min.js') }}"></script>
<script src="{{ asset('assets/hud/assets/plugins/jvectormap-content/world-mill.js') }}"></script>
<script src="{{ asset('assets/hud/assets/plugins/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/hud/assets/js/demo/dashboard.demo.js') }}"></script>
<!-- ================== END page-js ================== -->
@endif

@if( $route == route('admin.pos') )
<!-- ================== BEGIN page-js ================== -->
<script src="{{ asset('assets/hud/assets/js/demo/pos-customer-order.demo.js') }}"></script>
<!-- ================== END page-js ================== -->
@endif

<!-- Custom JS -->
<script src="{{ asset('assets/custom/js/product.custom.js') }}"></script>
<script src="{{ asset('assets/custom/js/pos.custom.js') }}"></script>
<script src="{{ asset('assets/custom/js/calculator.custom.js') }}"></script>


<script>
//Display Brand image on upload in add and edit page
$('.img__thumbnail').change(function(e){
    e.preventDefault();
    let display_image =  $(this).closest('.img__area').find('img');
    let image_upload = URL.createObjectURL(e.target.files[0]);
    display_image.attr('src', image_upload);   
});   
</script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-53034621-1', 'auto');
    ga('send', 'pageview');

</script>