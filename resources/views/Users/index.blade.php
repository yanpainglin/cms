@extends('layouts.app')

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{session()->get('success')}}
        </div>
    @endif
    <a href="{{route('posts.create')}}" class="btn btn-success mb-2 btn-sm"> Create New Post</a>
    <div class="card card-default ">
        <div class="card-header">
            Posts
        </div>

        <div class="card-body">
            @if($users->count() > 0)
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                     {{$user->name}}
                                </td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if(!($user->role =='admin'))
                                        <a href="{{route('makeadmin', $user->id)}}" class="btn btn-success">
                                            Make Admin
                                        </a>
                                    @else
                                        <a href="{{route('makewriter', $user->id)}}" class="btn btn-primary">
                                            Admin
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            @else
                <h3 class="text-center">
                    No Users Yet.
                </h3>
            @endif
        </div>
    </div>


@endsection
