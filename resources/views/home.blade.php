@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($users as $user)
                            <li class="list-group-item d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold">
                                        {{$user->name}} 
                                    </span>
                                    @if(auth()->user()->id !== $user->id)
                                        @if(auth()->user()->followings->contains($user->id))
                                            <a href="{{route('unfollow',['follower_id' => auth()->user()->id, 'following_id' => $user->id])}}" class="btn btn-sm btn-danger">unfollow</a>
                                        @else
                                            <a href="{{route('follow',['follower_id' => auth()->user()->id, 'following_id' => $user->id])}}" class="btn btn-sm btn-primary">follow</a>
                                        @endif
                                    @endif
                                </div>
                                <div class="my-2">
                                    <span class="badge rounded-pill bg-light text-dark">
                                        Followings: {{$user->followings()->count()}}
                                    </span>
                                    <span class="badge rounded-pill bg-light text-dark">
                                        Followers: {{$user->followers()->count()}}
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection