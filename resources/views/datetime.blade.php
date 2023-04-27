@if ($value)
    @php
        $carbonTime = new Carbon\Carbon($value)
    @endphp
    <div class="datetime-column">
        <div><span
                class="datetime-column-region">大陆</span>{{ $carbonTime->setTimezone('Asia/Shanghai')->toDateTimeString()  }}
        </div>
        <div><span
                class="datetime-column-region">日本</span>{{ $carbonTime->setTimezone('Asia/Tokyo')->toDateTimeString() }}
        </div>
    </div>
@endif
