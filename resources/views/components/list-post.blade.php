<div class="articles-section">
    @forelse ($userPosts as $item)
        @php
            $blocks = $item->content; // already in array if casted in model
    $firstPara = collect($blocks)->firstWhere('type', 'paragraph');
    $firstImage = collect($blocks)->firstWhere('type', 'image');
@endphp
<div class="article-card" data-post-id="{{ $item->id }}">
    <header class="card-header">
        <p class="card-header-title">
        <img src="{{ $item->user->profile_pic }}" class="profile-avatar" style="width: 22px; height: 22px;" />
        <a href="{{ route('user.show', $item->user->id)}}" style="margin-left:5px;color:black;">{{ $item->user->name }}</a>
        </p>
        <div class="card-header-icon" aria-label="options">
            <div class="dropdown is-right dropdown-article-action">
                <div class="dropdown-trigger">
                    <button class="button is-white" aria-haspopup="true" aria-controls="dropdown-options">
                        <span class="icon is-small">⋮</span>
                    </button>
                </div>
                <div class="dropdown-menu" id="dropdown-options" role="menu">
                    <div class="dropdown-content">
                        @if (Auth::id() == $item->user->id)
                            <a href="{{route('posts.edit', $item->id)}}" class="dropdown-item update">Update Post</a>
                            <form action="{{ route('posts.destroy', $item->id) }}"
                                  method="POST"
                                  class="dropdown-delete-form"
                                  onsubmit="return confirm('Are you sure you want to delete this post?');">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="dropdown-item del dropdown-delete-btn">Delete Post</button>
                            </form>

                        @else
                            <a class="dropdown-item report">Report</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="columns">
        <div class="column">
            <div class="article-meta">
                @foreach ($item->tags as $tag)
                    <span class="tag is-light">{{ $tag->name }}</span>
                @endforeach
            </div>
            <h2 class="title is-4"><a class="has-text-black" href="{{ route('posts.show', ['slug' => $item->slug]) }}">{{ $item->title }}</a></h2>
            @if ($firstPara)
                <p class="subtitle is-6 has-text-grey truncate-2-lines">{{ $firstPara["data"]["text"] }}</p>
            @endif
            <div class="article-stats">
                <span><i style="margin-right:3px;" class="fa-solid fa-hands-clapping"></i>{{ $item->likes_count }}</span>
                <span><i style="margin-right:3px;" class="fas fa-comment"></i>{{ $item->comments_count }} </span>
            </div>
        </div>
        <div class="column is-narrow">
            @if ($firstImage)
                <img src="{{ $firstImage['data']['file']['url'] }}"
                     alt="Article image" class="article-image">
                 @endif
        </div>
    </div>
</div>
    @empty
        <div class="empty-state">
            <i class="fas fa-list"></i>
            <h3 class="title is-4">No lists yet</h3>
            <p>Create reading lists to organize your favorite posts</p>
        </div>

    @endforelse
</div>
