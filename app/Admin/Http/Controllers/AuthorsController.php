<?php

namespace App\Admin\Http\Controllers;

use App\Admin\Libraries\Uuid;
use App\Admin\Models\TmpDataModel;
use App\Models\AuditLog;
use App\Models\Authors;
use App\Services\SEOService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Admin\Http\Requests\Author as Request;
use App\Models\Author as Model;
use Session;

class AuthorsController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        Session::put('redirect.' . $this->controllerName(), request()->fullUrl());

        $q       = Model::query()->orderBy('name', 'asc');
        $appends = [];
        if ($search = \request('search', false)) {
            $search = e($search);
            Model::addSearchQuery($q, $search);
            $appends['search'] = $search;
        }
        return view('admin.' . $this->controllerName() . '.index', [
            'items'  => $q->paginate(20),
            'search' => $search
        ]);
    }
    /**
     * @return View
     */
    public function create(): View
    {
        \Assets::addCss('admin/plugins/select2/select2.min.css');
        \Assets::addJs('admin/plugins/select2/select2.full.min.js');
        \Assets::addJs('admin/plugins/input-mask/jquery.inputmask.js');
        \Assets::addJs('admin/plugins/input-mask/jquery.inputmask.date.extensions.js');
        \Assets::addJs('admin/plugins/input-mask/jquery.inputmask.extensions.js');
        \Assets::addJs('admin/plugins/ckeditor/ckeditor.js');
        view()->share('footer_js', <<<JS
$("select.select2").select2();
$("[data-mask]").inputmask();
JS
        );
        $all   = old($this->controllerName());
        $model = new Model();
        if ($all) {
            $model->locale = array_get($all, 'locale', 'ru');
            $model->setDefaultLocale($model->locale);
            $model->fill($all);
            if ($uuid = old('uuid')) {
                $model->setKeyType('string');
                $model->id = $uuid;
            }
        } else {
            $model->setKeyType('string');
            $model->id         = Uuid::uuid4();
        }
        return view('admin.' . $this->controllerName() . '.create', [
            'locales' => \Waavi\Translation\Models\Language::withTrashed()->get(),
            'model'   => $model
        ]);
    }
    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $model = Model::create($request->mutatorData());
        if ($uuid = $request->input('uuid')) {
            TmpDataModel::saveRelation($model->id, $uuid);
        }

        AuditLog::write(Model::getAuditLogData($model, 'Создан'));


        SEOService::authorSeo($model);
        if ($request->input('commit') == 1) {
            return redirect()->to(lang_route('admin.' . $this->controllerName() . '.index'));
        } else {
            return redirect()->to(lang_route('admin.' . $this->controllerName() . '.edit', $model));
        }
    }

    /**
     * @param Model $author
     *
     * @return View
     */
    public function edit(Model $author): View
    {
        \Assets::addCss('admin/plugins/select2/select2.min.css');
        \Assets::addJs('admin/plugins/select2/select2.full.min.js');
        \Assets::addJs('admin/plugins/input-mask/jquery.inputmask.js');
        \Assets::addJs('admin/plugins/input-mask/jquery.inputmask.date.extensions.js');
        \Assets::addJs('admin/plugins/input-mask/jquery.inputmask.extensions.js');
        \Assets::addJs('admin/plugins/ckeditor/ckeditor.js');
        view()->share('footer_js', <<<JS
$("select.select2").select2();
$("[data-mask]").inputmask();
JS
        );
        $all = old($this->controllerName());
        if ($all) {
            $author->locale = array_get($all, 'locale', $author->locale);
            $author->setDefaultLocale($author->locale);
            $author->fill($all);
        }
        return view('admin.' . $this->controllerName() . '.edit', [
            'locales' => \Waavi\Translation\Models\Language::withTrashed()->get(),
            'model'   => $author
        ]);
    }

    /**
     * @param Request $request
     * @param Model   $author
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Model $author): RedirectResponse
    {
        $all = $request->mutatorData();
        $author->setDefaultLocale(array_get($all, 'locale', $author->locale));
        $author->update($all);

        AuditLog::write(Model::getAuditLogData($author, 'Изменен'));

        if ($request->input('commit') == 1) {
            return redirect()->to(Session::get('redirect.' . $this->controllerName()));
        } else {
            return redirect()->to(lang_route('admin.' . $this->controllerName() . '.edit', $author));
        }
    }

    /**
     * @param Model $author
     *
     * @return RedirectResponse | \Response
     * @throws \Exception
     */
    public function destroy(Model $author)
    {
        AuditLog::write(Model::getAuditLogData($author, 'Удален'));
        $author->delete();
        if (\request()->ajax()) {
            return response()->json(['success' => 'OK']);
        } else {
            return redirect()->to(lang_route('admin.' . $this->controllerName() . '.index'));
        }
    }

}
