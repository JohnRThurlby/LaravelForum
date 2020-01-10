@extends('layouts.app')

@section('content')

      <div class="card">

        <div class="card-header">

          <div class="d-flex justify-content-between">

            <div>

              <img width="40px" height="40px" src="{{ Gravatar::src($discussion->author->email) }}" alt="">
              <strong class="ml-2">{{ $discussion->author->name }}</strong>

            </div>

          </div>

        </div>

        <div class="card-body">

            <div class="text-center">
                <strong>
                  {{ $discussion->title }}
                </strong>
              </div>

          <hr>

          {!! $discussion->content !!}

          @if ($discussion->bestReply)

            <div class="card bg-success my-5" style="color: #fff">

              <div class="card-header">

                <div class="d-flex justify-content-between">

                  <img width="40px" height="40px" src="{{ Gravatar::src($discussion->bestReply->owner->email) }}" alt="">

                  <strong>

                    {{ $discussion->bestReply->owner->name }}

                  </strong>

                </div>

                <div>

                    <strong>

                      Best Reply

                    </strong>

                </div>

              </div>

              <div class="card-body">

                {!! $discussion->bestReply->content!!}

              </div>

            </div>

          @endif

        </div>

      </div>

      @foreach ($discussion->replies()->paginate(3) as $reply)

        <div class="card my-5">

          <div class="card-header">

            <div class="d-flex justify-content-between">

              <div>

                <img width="40px" height="40px" src="{{ Gravatar::src($reply->owner->email) }}" alt="">
                <strong class="ml-2">{{ $reply->owner->name }} replied:</strong>

              </div>

              <div>

                @auth

                  @if(auth()->user()->id == $discussion->user_id)

                    <form action="{{ route('discussions.best-reply', [ 'discussion' => $discussion->slug, 'reply' => $reply->id ]) }}" method="POST">

                      @csrf

                      <button type="submit" class="btn btn-sm btn-primary">Mark as the best Reply</button>

                    </form>

                  @endif

                @endauth

              </div>

            </div>

          </div>

          <div class="card-body">

            {!! $reply->content !!}

          </div>

        </div>

      @endforeach

      {{ $discussion->replies()->paginate(3)->links() }}

      <div class="card my-5">

          <div class="card-header">

            Add a reply

          </div>

          <div class="card-body">

              @auth

                <form action="{{ route('replies.store', $discussion->slug) }}" method="POST">

                    @csrf

                    <div class="form-group">

                            <label for="content">Reply</label>

                            <input id="content" type="hidden" name="content">
                            <trix-editor input="content"></trix-editor>

                    </div>

                    <button type="submit" class="d-flex my-2 btn btn-success btn-small">Add reply</button>

                </form>

              @else

                <a href="{{ route('login') }}" style="width: 100%; color: #fff;" class="btn btn-info my-2">Sign in to add a reply</a>

              @endauth

          </div>

        </div>

@endsection

@section('css')

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">

@endsection

@section('js')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>

  @endsection
