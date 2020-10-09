@extends('layouts.app')

@section('content')
    @if(session()->has('success'))


        <div class="col-md-6 alert alert-success">
            <ul class="list-group">
                <li class="list-group-item bg-dark text-white">
                    {{session()->get('success')}}
                </li>
            </ul>
        </div>

    @endif
    @if($errors -> any())
            <div class="alert alert-danger">
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                            <li class="list-group-item">
                                {{$error}}
                            </li>
                        @endforeach
                </ul>
            </div>
        @endif

    <div class="card card-default">
        <div class="card-header bg-secondary text-white">
            {{isset($posts)? "Edit Post" : "Add New Post"}}
        </div>

        <div class="card-body">
            <form enctype="multipart/form-data" action="{{isset($posts) ? route('posts.update', $posts->id) : route('posts.store')}}" method="POST">
                @if(isset($posts))
                        @method('PUT')
                    @endif
                @csrf

                <div class="form-group">
                    <input type="text" name="title" placeholder="Title" value="{{ isset($posts) ? $posts->title : "" }}" class="form-control mb-2">
                </div>
                    <div class="form-group">
                        <textarea name="description" placeholder="Description"  cols="10" rows="3" class="form-control">{{ isset($posts) ? $posts->description : "" }}</textarea>
                    </div>

                    <div class="form-group">
                        <input id="content" type="hidden" name="cont" >
                        <trix-editor input="content" cols="30" rows="30" placeholder="Write Your Contents Here . . ." >{{isset($posts) ? $posts->content : ""}}</trix-editor>
                    </div>

                <div class="form-group">
                    <input type="date" name="publish_at" id="publish_at" placeholder="Publish-at" value="{{ isset($posts) ? $posts->publish_at : "" }}" class="form-control">
                </div>

                    <div class="form-group">
                        <select name="category_id"   class="form-control">
                            @foreach($category as $category)
                                <option value="{{$category->id}}"
                                        @if(isset($posts))
                                            @if($posts->category_id == $category->id)
                                                selected
                                             @endif
                                        @endif
                                    >{{$category->name}}
                                </option>
                            @endforeach


                        </select>
                    </div>



                        @if(count($tag) > 0)
                            <label for="tag_id"> <h6>Select Your Programming Laguage</h6></label>
                            <div class="form-group">
                                <select name="tags[]" id="tag-selector" class="tag-selector form-control" multiple>
                                    @foreach($tag as $tag)
                                        <option value="{{$tag->id}}"
                                                @if(isset($posts))
                                                    @if(in_array($tag->id, $posts->tags->pluck('id')->toArray()))
                                                    selected
                                                @endif
                                            @endif
                                        >{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                    @if(isset($posts))
                        <div class="form-group">
                            <img src="{{asset('storage/'.$posts->image)}}" width="100" height="100" alt="image">
                        </div>
                     @endif

                <div class="form-group">
                    <label for="image">{{isset($posts)? "Add New Image" : "Add image"}}</label>
                    <input type="file" name="image"  class=" form-control">
                </div>

                <input type="submit" value="{{isset($posts) ? 'Update Post' : 'Create Post'}}" class="btn btn-success btn-sm">

            </form>
        </div>
        <div class="card-footer">
        </div>
    </div>

@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script >
        flatpickr('#publish_at', {
            enableTime:true,

        });
        $(document).ready(function() {
            $('.tag-selector').select2();
        })
    </script>

@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

@endsection
