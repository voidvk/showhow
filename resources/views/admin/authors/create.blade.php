@extends('admin.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Добавленние автора
        </h1>
    </section>
    <section class="content" id="content-page">
        <div class="row">
            <div class="col-md-12">
                <form action="{{lang_route('admin.'.$controller_name.'.store')}}" enctype="multipart/form-data" method="POST">
                    {{ csrf_field() }}
                    @include('admin.'.$controller_name.'._form')
                </form>
            </div>
        </div>
    </section>
@endsection
