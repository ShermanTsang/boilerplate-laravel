@if ($value)
    @php
        $carbonTime = new Carbon\Carbon($value);
        $localtime = $carbonTime->setTimezone('Asia/Shanghai');
    @endphp
    <div class="datetime-column">
        <div>{{ $localtime->toDateTimeString()  }}
        </div>
        <div><span
                class="datetime-column-sub">{{ $localtime->diffForHumans() }}</span>
        </div>
    </div>
@endif
