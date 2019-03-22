<div class="form-group {!! !$errors->has($label) ?: 'has-error' !!}">
    <label for="{{$id}}" class="col-sm-2 control-label">{{$label}}</label>
    <div class="col-sm-8">
        @include('admin::form.error')
        <input type="text" id="{{$id}}" name="{{$name}}" class="tags" value="{{ old($column, $value) }}">
    </div>
</div>