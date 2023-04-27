@if($url)
    <div class="embed-frame">
        <div class="embed-frame-header">
            <div class="embed-frame-name">
                {{ $name }}
            </div>
            <div class="embed-frame-button"><a href="{{ $url }}" target="_blank">在新窗口中打开</a></div>
        </div>
        <div class="embed-frame-overlay"></div>
        <iframe class="embed-frame-web" src="{{ $url }}"></iframe>
    </div>
@endif
