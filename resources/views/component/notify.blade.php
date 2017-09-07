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
        @if(!empty(session('notifyInfo')))
        toastr.info('{{session('notifyInfo')}}');
        @endif
        @if(!empty(session('notifySuccess')))
        toastr.success('{{session('notifySuccess')}}');
        @endif
        @if(!empty(session('notifyWarning')))
        toastr.warning('{{session('notifyWarning')}}');
        @endif
        @if(!empty(session('notifyError')))
        toastr.error('{{session('notifyError')}}');
        @endif
    })
</script>
