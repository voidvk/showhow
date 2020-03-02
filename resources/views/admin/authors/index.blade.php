@extends('admin.layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Авторы
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="page-actions">
                            <a href="{{lang_route('admin.'.$controller_name.'.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Добавить</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped no-margin">
                                <colgroup>
                                    <col width="150px">
                                </colgroup>
                                <thead>
                                <tr>
                                    <th>Действия</th>
                                    <th>ФИО</th>
                                    <th>Основной язык</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>
                                            <a class="btn btn-primary btn-sm" title="Редактировать" href="{{lang_route('admin.'.$controller_name.'.edit',$item)}}"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger btn-sm" href="javascript:void(0)" title="Удалить"
                                               data-action="destroy"
                                               data-href="{{lang_route('admin.'.$controller_name.'.destroy',$item)}}"
                                            ><i class="fa fa-trash"></i></a>
                                        </td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->locale}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        {{ $items->links('admin.layouts.partials.pagination.default') }}
                    </div>
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
    </section>
@endsection
