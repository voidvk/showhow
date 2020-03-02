@extends('admin.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Редактирование "{!! $model->name !!}"
        </h1>
    </section>
    <section class="content" id="content-page">
        <div class="row">
            <div class="col-md-12">
                <form action="{{lang_route('admin.'.$controller_name.'.update',['id'=>$model->id])}}" enctype="multipart/form-data" method="POST">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    @include('admin.'.$controller_name.'._form')
                </form>
            </div>
        </div>
    </section>
@endsection
