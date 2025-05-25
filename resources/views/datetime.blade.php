@if ($value)
    @php
        $carbonTime = new Carbon\Carbon($value);
        $localtime = $carbonTime->setTimezone('Asia/Shanghai');
    @endphp
    <div class="datetime-column">
        <div><span
                class="datetime-column-region">具体</span>{{ $localtime->toDateTimeString()  }}
        </div>
        <div><span
                class="datetime-column-region">已读</span>{{ $localtime->diffForHumans() }}
        </div>
    </div>
@endif
