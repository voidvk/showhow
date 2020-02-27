<div class="box box-primary">
    <div class="box-header with-border">
        <div class="form-actions">
            <button type="submit" class="btn-success btn btn-sm" name="continue"><i class="fa fa-retweet"></i> Сохранить</button>
            &nbsp;&nbsp;
            <button name="commit" type="submit" class="btn-default btn btn-sm" onclick="$(this).val(1);">
                <i class="fa fa-check"></i>
                <span class="hidden-xs hidden-sm">Сохранить и Закрыть</span>
            </button>
            &nbsp;&nbsp;
            <a href="{{lang_route('admin.'.$controller_name.'.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>
                <span class="hidden-xs hidden-sm">Создать ещё</span>
            </a>
            &nbsp;&nbsp;
            <a href="{{ Session::get('redirect.' . $controller_name) }}" class="btn btn-default btn-sm">
                <i class="fa fa-arrow-left"></i>
                <span class="hidden-xs hidden-sm">Вернуться</span>
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#{{$controller_name}}_main" data-toggle="tab">Основные</a>
                </li>
                @foreach ($locales as $lang)
                    <li>
                        <a href="#{{$controller_name}}_{{$lang->locale}}" data-toggle="tab">{{$lang->name}}</a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="{{$controller_name}}_main">
                    @if (false&&$errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @include('admin.layouts.partials.form._field', [
                   'lang'=>false,
                   'name' => 'Основной язык',
                   'attr'=>'locale',
                   'type'=>'select2',
                   'data'=>$locales->pluck('name','locale')->toArray()
                   ])
                    @include('admin.layouts.partials.form._field', [
                   'lang'=>false,
                   'name' => 'В каких языковых версиях видим',
                   'attr'=>'visible_locale',
                   'type'=>'select2',
                   'data'=>$model->listVisibleLocale()
                   ])
                    @include('admin.layouts.partials.form._field', [
                   'lang'=>false,
                   'name' => 'Партнёр',
                   'attr'=>'partner_id',
                   'type'=>'select2',
                   'data'=>[''=>'Не выбран']+\App\Models\Partner::orderBy('name')->get()->pluck('name','id')->toArray()
                   ])
                    @include('admin.layouts.partials.form._field', [
                       'lang'=>false,
                       'name' => 'Логотип',
                       'attr'=>'img',
                       'type'=>'image'
                    ])
                </div>
                @foreach ($locales as $lang)
                    @php
                        $prefix_field_name = 'translate.'.$lang->locale.'.';
                        if($lang->locale==$model->locale){
                          $prefix_field_name = '';
                        }
                    @endphp
                    <div class="tab-pane" id="{{$controller_name}}_{{$lang->locale}}">
                        @include('admin.layouts.partials.form._field', [
                           'lang'=>$lang,
                           'name' => 'ФИО',
                           'attr'=>'name',
                           'type'=>'text',
                       ])
                        @include('admin.layouts.partials.form._field', [
                            'lang'=>$lang,
                            'name' => 'Краткая информация',
                            'attr'=>'short_body',
                            'type'=>'ckeditor'
                        ])
                        @include('admin.layouts.partials.form._field', [
                            'lang'=>$lang,
                            'name' => 'Биография',
                            'attr'=>'body',
                            'type'=>'ckeditor'
                        ])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
