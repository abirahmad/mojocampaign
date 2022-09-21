<!-- latest jquery-->
<script src="{{ asset('public/assets/backend/js/jquery-3.2.1.min.js') }}"></script>
<!-- Bootstrap js-->
<script src="{{ asset('public/assets/backend/js/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('public/assets/backend/js/bootstrap/bootstrap.js') }}"></script>
<!-- feather icon js-->
<script src="{{ asset('public/assets/backend/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('public/assets/backend/js/icons/feather-icon/feather-icon.js') }}"></script>
<!-- Sidebar jquery-->
<script src="{{ asset('public/assets/backend/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('public/assets/backend/js/config.js') }}"></script>
<!-- Plugins JS start-->

<!-- Data Tables -->
<script src="{{ asset('public/assets/backend/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>

<!-- Parsley JS For Validation -->
<script src="{{ asset('public/assets/backend/js/parsley/parsley.min.js') }}"></script>

<!-- Select2 Js For Multiple -->
<script src="{{ asset('public/assets/backend/js/select2/select2.min.js') }}"></script>
<script src="{{ asset('public/assets/backend/js/tooltip-init.js') }}"></script>

<!-- Theme js-->
<script src="{{ asset('public/assets/backend/js/script.js') }}"></script>
<!-- <script src="{{ asset('public/assets/backend/js/theme-customizer/customizer.js') }}"></script> -->
<!-- Plugin used-->


<!-- Dropify -->
<script src="{{ asset('public/assets/backend/js/dropify/js/dropify.min.js') }}"></script>
<!-- Common JS -->

<script src="{{ asset('public/assets/backend/js/custom.js') }}"></script>
<!-- Common JS -->

<!-- Data table -->
<script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
<!-- <script src="{{asset('public/assets/backend/js/tinymce.min.js')}}"></script> -->
<script src="https://cdn.tiny.cloud/1/4ww6gk0kgf4464nwjxojp2y4ye9io3fyjr4n1a9x2kylsg3s/tinymce/5/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
        toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
    });
</script>

<script>
    $('.select2').select2();
    $('.dropify').dropify();
</script>
<style>
    .dataTables_wrapper button {
        padding: 5px 8px !important;
        border-radius: 0px !important;
        color: #fff !important;
        background: #2f3c4e !important;
        font-size: 15px;
        margin: 5px 5px 10px;
        border: none !important;
        cursor: pointer !important;
    }
</style>

@include('backend.layouts.partials.flash-messages')