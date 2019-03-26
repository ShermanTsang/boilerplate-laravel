@php
    $id = uniqid();
@endphp

<div class="post">
    <div id="content" class="content">
        @if( $type === 'markdown' )
            <div id="content-markdown-{{$id}}" class="content-body">
                <textarea style="display:none;">{{ $slot }}</textarea>
            </div>
        @elseif( $type === 'html' )
            <div id="content-html-{{$id}}" class="content-body">
                {!! $slot!!}
            </div>
        @endif
    </div>
</div>

@push('footer')
    @if($type === 'markdown')
        <script type="text/javascript" src="{{asset('js/build/markdown-support.js')}}"></script>
    @endif
    <script>
        var content;
        $(function () {
            @if( $type === 'markdown' )
                content = editormd.markdownToHTML("content-markdown-{{$id}}", {
                htmlDecode: "style,script,iframe",
                emoji: true,
                taskList: true,
                flowChart: true,
                toc: true,
                tocm: true,
                tocDropdown: true,
                // tocContainer: "#catalog"
            });
            @endif
        });
    </script>
@endpush