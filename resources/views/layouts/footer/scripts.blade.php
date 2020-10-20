<!-- Back To Top Button-->
<a class="btn-scroll-top" href="#top" data-scroll>
    <span class="btn-scroll-top-tooltip text-muted font-size-sm mr-2">Top</span><i class="btn-scroll-top-icon czi-arrow-up"></i>
</a>
<!-- Vendor scrits: js libraries and plugins-->
<script src="{{ asset('vendor/jquery/dist/jquery.slim.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/bs-custom-file-input/dist/bs-custom-file-input.min.js') }}"></script>
<script src="{{ asset('vendor/simplebar/dist/simplebar.min.js') }}"></script>
<script src="{{ asset('vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>
<script src="{{ asset('vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
<script src="{{ asset('vendor/drift-zoom/dist/Drift.min.js') }}"></script>
<script src="{{ asset('vendor/lightgallery.js/dist/js/lightgallery.min.js') }}"></script>
<script src="{{ asset('vendor/lg-video.js/dist/lg-video.min.js') }}"></script>
<!-- Main theme script-->
<script src="{{ asset('js/theme.min.js') }}"></script>
@stack('scripts')
@livewireScripts
