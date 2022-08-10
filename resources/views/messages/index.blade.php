@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="accordion" id="messages">
    @php for ($i = 0; $i < count($messages); $i++) { @endphp
        <div class="accordion-item">
          <h2 class="accordion-header" id="heading-{{$i}}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$i}}" aria-expanded="false" aria-controls="collapse-{{$i}}">
                {{ $messages[$i]->fullName}}
                <small class="text-muted ms-4">{{ $messages[$i]->created_at->diffForHumans()}}</small>
            </button>
          </h2>
          <div id="collapse-{{$i}}" class="accordion-collapse collapse" aria-labelledby="heading-{{$i}}" data-bs-parent="#messages">
            <div class="accordion-body">
                <p>{{ $messages[$i]->content}}</p>
                <span class="badge bg-primary">{{ $messages[$i]->email}}</span>
            </div>
          </div>
        </div>
    @php } @endphp
      </div>
</div>
@endsection