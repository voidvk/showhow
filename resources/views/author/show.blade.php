@extends('layouts.app')
<?
/**
 * @var $author \App\Models\Author
 */
?>

@section('headmeta')
    <meta property="og:url"           content="{{ Request::url() }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="{{ $author->name }}" />
    <meta property="og:image"         content="" />
    <link rel="alternate" hreflang="{{ Request::segment(1) == 'kz' ? 'ru' : 'kk' }}" href="{{Request::root() }}{{ alternate_route('author', ['slug' => $author->slug]) }}">
@endsection

@section('content')
    <main class="main-body">

        <div id="particles-js" class="jumbotron-block jumbotron-block-about">
            <h1 class="jumbotron-block__title">{{ trans('author.about_author') }}</h1>
        </div>

        <div class="main-body__inner-wrapper">
            {{ Breadcrumbs::render('author', array('name' => $author->name, 'id' => $author->id)) }}
        </div>

        <div class="course">

            <div class="course-head">
                <div class="author-block">

                    @if ($author->img && file_exists(public_path($author->img)))
                        <div class="author-block__avatar" style="background-image: url({!! $author->img !!});"></div>
                    @else
                        <div class="author-block__avatar"></div>
                    @endif

                    <div class="author-block__content">
                        <div class="author-block__name">{{ $author->name }}</div>
                        <div class="author-block__desc">{!! $author->short_body !!}</div>
                    </div>
                </div>
            </div>

            @if ($author->partner_id)
                <div class="course__section-job">
                    <img src="{!! $author->partner->img_logo !!}" style="max-height:12rem">
                    <span>{!! $author->partner->name !!}</span>
                </div>
            @endif

            <div class="course-body">

                <div class="course__section">
                    <div class="course__section-title"></div>
                    <div class="course__section-description">
                        {!! $author->body !!}
                    </div>
                </div>

                @if(count($author->courses) > 0)
                <div class="hr-line"></div>

                <div class="course__section">
                    <div class="course__section-title">{{ trans('main.author_courses') }}</div>
                    <div class="course-list-wrapper">

                        @include ('partials._course', ['courses' => $author->courses, 'author_hide' => true])

                    </div>
                </div>
                @endif

            </div>

        </div>

    </main>
@endsection
