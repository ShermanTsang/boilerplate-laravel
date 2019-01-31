<div class="form-group {!! !$errors->has($label) ?: 'has-error' !!}">
    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>
    <div class="col-sm-10">
        @include('admin::form.error')
        <textarea autofocus id="{{$id}}"
                  name="{{$name}}" {!! $attributes !!} >{!! old($column, $value) !!}</textarea>
    </div>
</div>

<style>
    .simditor-body img {
        width: 60% !important;
        height: auto !important;
    }
</style>