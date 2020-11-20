<a href="{{ url('admin/invoice/'.$invoice->id.'/delete-temporary-document') }}" class="btnDisable btn btn-sm btn-danger">
    <i class="la la-send"></i> Eliminar documento temporal
</a>
@push('after_scripts')
<script>
    console.log($('.btnDisable'))
    $('.btn').on('onclick', function() {
        this.parent().find('a').attr('disable','disable')
    })
</script>
@endpush
