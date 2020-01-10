@extends('layouts.app')

@section('content')

    @foreach($discussions as $discussion)
      
      <div class="card">
    
        <div class="card-header">

          <div class="d-flex justify-content-between">
            
            <div>

              <img width="40px" height="40px" src="{{ Gravatar::src($discussion->author->email) }}" alt="">
              <strong class="ml-2">{{ $discussion->author->name }}</strong>
            
            </div>

            <div>

              <a href="{{ route('discussions.show', $discussion->slug  )}}" class="btn btn-sm btn-success">View</a>

            </div>

          </div>

        </div>

        <div class="card-body">
          <div class="text-center">
            <strong>
              {{ $discussion->title }} 
            </strong> 
          </div> 
        </div>

      </div>

    @endforeach  

    {{ $discussions->links() }}
        
@endsection

