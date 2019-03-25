<script>
    $(function () {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "6000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        @if(!empty(session('notify')))
        {!! 'toastr.' . session('notify')['type'] . '("' . session('notify')['text'] .'");' !!}
        @endif
    })
</script>
