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
              @if($posts->count() > 0)
                    <table class="table">
                        <thead>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    <img src="{{asset('storage/'.$post->image)}}" width="75" height="75" alt="post-image">
                                </td>
                                <td>{{$post->title}}</td>
                                @if($post->category)
                                    <td>{{$post->category->name}}</td>
                                    @endif
                                    @if($post->trashed())
                                        <td>
                                            <form action="{{route('restore-posts', $post->id)}}" method="post">
                                                @csrf
                                                @method('PUT')

                                                <button type="submit" class="btn btn-info btn-sm">Restore</button>
                                            </form>
                                        </td>
                                        @else
                                        <td><a href="{{route('posts.edit', $post->id)}}" class="btn btn-info btn-sm">Edit</a></td>
                                    @endif
                                <td>
                                    <form action="{{route('posts.destroy', $post->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            @if($post->trashed())
                                                Delete
                                            @else
                                                Trash
                                            @endif
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                  @else
                    <h3 class="text-center">
                        No Posts Yet.
                    </h3>
                @endif
            </div>
        </div>


@endsection
