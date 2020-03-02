<a href="{{ lang_route('author', ['author' => $author->slug]) }}" class="author-block">
    <div class="author-item">
            @if ($author->img && file_exists(public_path($author->img)))
                <div class="speaker-block__photo" style="background-image: url({!! $author->img !!});"></div>
            @else
                <div class="speaker-block__photo" style="background-image: url('/uploads/author/user.svg');"></div>
            @endif

            <div class="speaker-block__name">{!! $author->name !!}</div>
            <div class="speaker-block__description">{!! $author->short_body !!}</div>
    </div>
</a>
