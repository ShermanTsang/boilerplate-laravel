@php
    $id = uniqid();
@endphp

@push('header')
    <script type="text/javascript" src="{{asset('js/build/markdown-support.js')}}"></script>
@endpush

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
    <script>
        let content;
        let contentBody = $(".content-body");
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
            // Warping img tag
            contentBody.find("img").each(function () {
                $(this).attr('data-original', $(this).attr('src'));
                $(this).removeAttr('src');
                $(this).wrap('<a data-fancybox="gallery" href="' + $(this).attr('data-original') + '"></a>');
            });
            // Warping table
            contentBody.find("table").each(function () {
                $(this).wrapAll("<div class='table-container'></div>")
            });
            // LazyLoad activator
            $("img").lazyload({effect: "fadeIn"});
        });
    </script>
@endpush