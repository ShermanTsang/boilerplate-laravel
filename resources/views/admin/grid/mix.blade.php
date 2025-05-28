@if ($value and $model)
    @php
        if(!is_array($value)) {
            $value = [$value];
        }
        $value = collect($value);
        $model = collect($model);
    @endphp
    <div class="multipleList">
        @foreach( $value as $row )

            @php
                $row = collect($row);

                $rowName = $row->get('name');
                $rowField = $row->get('field');
                $rowType = $row->get('type');
                $rowUsing = $row->get('using');
                $rowElementClass = $row->get('elementClass');

                $rowValue = (function () use ($row,$value,$rowField,$model) {
                   if($row->has('value')){
                       return $row->get('value');
                   } elseif($model->has($rowField)) {
                        return $model->get($rowField);
                   }
                   return null;
                })();

                if($rowValue && $rowType === 'datetime') {
                    $carbonTime = new Carbon\Carbon($rowValue);
                    $localtime = $carbonTime->setTimezone('Asia/Shanghai');
                    $rowValue = $localtime->toDateTimeString() . ' '.$localtime->diffForHumans() ;
                }

                if(is_null($rowValue)) {
                    $rowValue = $row->has('default') ?  $row->get('default') : '-';
                }

                if($rowUsing) {
                    $rowValue = $rowUsing[$rowValue];
                }

            @endphp

            <div class="flex-row flex-nowrap justify-content-start text-sm" style="display:flex">
                @if($rowName)
                    <div class="text-black-50">{{$rowName}}</div>
                @endif
                <div class="ml-1 text-black {{$rowElementClass ?? ''}}">{{$rowValue}}</div>
            </div>

        @endforeach
    </div>
@endif
