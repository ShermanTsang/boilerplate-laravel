@if ($value)
    @php
        $carbonTime = new Carbon\Carbon($value);
        $localtime = $carbonTime->setTimezone('Asia/Shanghai');
    @endphp
    <div class="datetime-column">
        <div>{{ $carbonTime->toDateTimeString()  }}
        </div>
        <div><span
                class="datetime-column-sub">{{ $carbonTime->diffForHumans() }}</span>
        </div>
    </div>
@endif
