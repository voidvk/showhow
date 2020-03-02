<div class="course-block" data-id="{{ $course->id }}">

    <div class="course-block__status-bar">

        <div class="course-block__status-free">{{ trans('course.free') }}</div>

        @if ($course->is_new)
            <div class="course-block__status-new">{{ trans('course.new') }}</div>
        @endif

    </div>

    <a href="{{ lang_route('course.show', ['slug' => $course->slug]) }}" class="course-block__image" style="background-image: url({{ isset($course->img_preview) ? $course->img_preview : 'images/default_course_img.png' }});"></a>

    <div class="course-block__content-wrapper">
        <div class="course-block__title mrgn_b10">
            <span><a class="course_name" href="{{ '/' .$course->locale . '/courses/' . $course->slug }}">{{ $course->name }}</a></span>
        </div>

        @include('common.course.user_progress', ['progress' => $userProgress, 'course' => $course])

        <div class="course-block__bottom-wrapper">
            @include('common.course.rating.index', ['ratings' => $courseRatings, 'course' => $course])

            @include('common.course.favorite', ['userCourses' => $userCourses, 'course' => $course])
        </div>

    </div>

</div>