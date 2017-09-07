@extends('layout.app')
@section('title',$page->name)
@section('css')
@endsection
@section('content')
    <div class="mdui-row">
        <div class="mdui-col-md-8 mdui-col-offset-md-2">
            <div class="mdui-card">
                <div class="mdui-card-media">
                    <img src="{{getCdn().$page->image}}"/>
                    <div class="mdui-card-media-covered mdui-card-media-covered-gradient card-overlay">
                        <div class="mdui-card-primary">
                            <div class="mdui-card-primary-title">{{$page->name}}</div>
                            <div class="mdui-card-primary-subtitle">{{$page->description}}</div>
                        </div>
                    </div>
                </div>
                <div class="mdui-card-content content">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection