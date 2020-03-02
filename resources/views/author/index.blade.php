@extends('layouts.app')
@section('headmeta')
    <link rel="alternate" hreflang="{{ Request::segment(1) == 'kz' ? 'ru' : 'kk' }}" href="{{Request::root() }}{{ alternate_route('authors') }}">
@endsection
@section('content')
    <div id="particles-js" class="jumbotron-block jumbotron-block_type_course jumbotron-block-about">
        <h1 class="jumbotron-block__title">{{ trans('author.title') }}</h1>
    </div>

    <div class="main-body__inner-wrapper">
        {{ Breadcrumbs::render('authors') }}
    </div>

    <div class="author-outer">

        <div class="author-inner">

            <div class="author-list">
                @foreach($authors as $author)

                    @include('author._item')

                @endforeach
            </div>

            @include('vendor.pagination.custom_pagination', ['model' => $authors])

        </div>
    </div>
@endsection

@push('footer_scripts')
    <script type="text/javascript">

        window.onload = function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ajaxStart(function() {
                loader_show();
            });

            $(document).ajaxComplete(function() {
                loader_hide();
            });


            function load_authors(e) {
                e.preventDefault();

                var $loadBtn = $(this);
                var $authorList = $(".author-list");
                var currentCount = parseInt($loadBtn.attr("data-current-count"), 10);
                var data = {
                    'skip': currentCount
                };

                $.ajax({
                    url: '/' + window.core_project.locale + '/authors/load',
                    type: 'GET',
                    data: data,
                    success: function (response) {

                        if (response.end) {
                            $loadBtn.hide();
                        }

                        $.each(response.authors, function(index, value) {
                            $authorList.append(value);
                        });

                        $loadBtn.attr("data-current-count", (currentCount + parseInt(response.current_count_multi, 10)));

                    },
                    error: function (data) {

                    }
                });
            }

            $("#load_more_authors").on("click", load_authors);
        }

    </script>
@endpush
