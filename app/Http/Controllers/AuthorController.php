<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Services\Course\CourseService;
use App\Services\Percentage\Percentage;

class AuthorController extends Controller
{
    /**
     * Ренднерит страницу всех авторов в системе
     *
     * @GET("/authors")
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        \SEO::init(false, null, trans('author.title'));

        $authors = Author::has('courses')
            ->visibleLocale()
            ->orderBy('name', 'ASC')
            ->paginate(Author::PAGINATE_AUTHOR_LENGTH);

        return view('author.index', compact('authors'));
    }

    /**
     * @GET(/author/{author}"")
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function show(string $slug)
	{
	    $author = Author::where(['slug' => $slug])->first();
        \SEO::init(Author::class, $author->id, $author->name);

        $userProgress = Percentage::getResultCourses($author->courses);
        list($courseRatings, $userCourses) = CourseService::getAdditions($author->courses);

		return view('author.show', compact('author', 'userProgress', 'courseRatings', 'userCourses'));
	}

    /**
     * Подгрузка авторов
     *
     * Принимает ajax запрос для подгрузки авторов. На странице всех авторов есть кнопка загрузить.
     * При нажатий на не идет запрс сюда. По умолчанию на странице всех авторов, загружается 9 автора
     * потом с помощью этого action-а, подгружается также по 6
     *
     * @GET("/authors/load")
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
	public function load(Request $request)
    {
        $result = array(
            'authors' => null,
            'current_count_multi' => Author::LOAD_PAGINATE_LENGTH,
            'end' => false
        );

        $skip = (int) $request['skip'];

        $authors = Author::visibleLocale()->orderBy('name', 'ASC')->skip($skip)->take(Author::LOAD_PAGINATE_LENGTH)->get();

        foreach ($authors as $author) {
            $result['authors'][] = \View::make('author._item', compact('author'))->render();
        }

        $result['end'] = ($authors->count() === Author::LOAD_PAGINATE_LENGTH) ? false : true;

        return response()->json($result);
    }
}
