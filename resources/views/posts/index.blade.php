@extends('layouts.app')
@section('style')
    .carousel .carousel-item {
        height: 497px;
    } 
    .carousel-item img {
        position: absolute;
        object-fit: cover;
        top: 0;
        left: 0;
        min-height: 497px;
    }
    .img-container {
        height: 202px;
    }
    .most-post-commented h4 {
        z-index: 2;
    }
    .most-post-commented h4::before, .last-posts::before {
        content: '';
        position: absolute;
        background-color: #cde3fd;
        height: 11px;
        width: 235px;
        border-radius: 6px;
        bottom: 5px;
        z-index: -1; 
    }
    .last-posts::before {
        width: 72px;
    }
    .post-title {
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }
    .truncate {
        width: 924px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        text-align: center;
      }
      {{-- media query --}}
      @media only screen and (min-width:576px ) and (max-width: 750px) {
        .img-container {
            height: 149px;
        }
      }
@endsection
{{-- {{ dd(substr($postsForSlider[0]->images[0]->path, 0, 5)) }} --}}
@section('slider')
<div id="carouselExampleDark" class="carousel carousel-dark slide mb-3" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active" data-bs-interval="10000">
        <img src="
        @if(substr($postsForSlider[0]->images[0]->path, 0, 5) == 'http:' || substr($postsForSlider[0]->images[0]->path, 0, 6) == 'https:')
            {{ $postsForSlider[0]->images[0]->path  ?? null }}
        @else 
            {{ Storage::url($postsForSlider[0]->images[0]->path ?? null)  }}
        @endif
        " class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5 class="h2">{{ $postsForSlider[0]->title }}</h5>
          <p class="truncate">{{ $postsForSlider[0]->body }}</p>
        </div>
      </div>
      @php for ($i = 1; $i < count($postsForSlider); $i++)  { @endphp
        <div class="carousel-item">
            <img src="
            @if(substr($postsForSlider[$i]->images[0]->path, 0, 5) == 'http:' || substr($postsForSlider[0]->images[0]->path, 0, 6) == 'https:')
                {{ $postsForSlider[$i]->images[0]->path  ?? null }}
            @else 
                {{ Storage::url($postsForSlider[$i]->images[0]->path ?? null)  }}
            @endif
            " class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
            <h5 class="h2">{{ $postsForSlider[$i]->title }}</h5>
            <p class="truncate">{{ $postsForSlider[$i]->body }}</p>
            </div>
        </div>
      @php } @endphp
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
@endsection

@section('content')
<section class="container">
    <section class="row justify-content-between">
        {{-- latest posts --}}
        <article class="col-lg-8">
            <div class="row">
                <h2 class="last-posts position-relative mb-4 text-capitalize last-posts h4">latest</h2>
                @forelse($posts as $post)
                <div class="col-sm-6 mb-4">
                    <a class="text-start card text-decoration-none" href="{{ route('post', $post->id) }}">
                        <div class="img-container">
                            <img class="card-img-top w-100 h-100" src=" {{ $post->images[0]->path }}" alt="Title" >
                        </div>
                      <div class="card-body">
                        <h4 class="card-title post-title">{{ $post->title }}</h4>
                            <span class="card-text badge bg-light text-primary">{{ $post->created_at->diffForHumans() }}</span>
                            @if ($post->comments_count == 1)
                            <span class="card-text badge bg-light text-primary">{{ $post->comments_count }} comment</span>
                            @elseif($post->comments_count > 1)
                            <span class="card-text badge bg-light text-primary">{{ $post->comments_count }} comments</span>
                            @else
                            <span class="card-text badge bg-light text-primary">No Comment Yet</span>
                            @endif
                        </div>
                </a>
                @if(in_array(session()->get('loginRole'), ['admin', 'owner']) && session()->get('loginEmail'))
                    <div>
                        <a class="btn btn-secondary btn-sm mt-2 px-3" href="{{ route('post.edit', $post->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('post.destroy', $post->id) }}" class="d-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-warning btn-sm mt-2 px-3"><i class="fa-solid fa-xmark"></i></button>
                        </form>
                    </div>
                @endif
                </div>
                @empty
                    <p>No Post Yet</p> 
                @endforelse
            </div>
        </article>
        {{-- most commented posts --}}
        <aside class="col-lg-3 bg-light rounded most-post-commented align-self-baseline pb-3 mb-3">
            <h4 class="mt-3 position-relative">Most Post Commented</h4>
            @forelse($mostPostCommented as $post)
            <a href="{{ route('post', $post->id) }}" class="text-dark text-decoration-none">
            <div class="border-bottom py-3">
                <h5>{{ $post->title }}</h5>
                <span class="badge bg-primary">{{ $post->comments_count }}</span>
            </div>
            @empty 
            @endforelse
            </a>
        </aside>
    </section>  
</section>
@endsection