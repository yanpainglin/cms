@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset($tag) ? "Edit tag" : 'Add New tag' }}
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class=" list-group-item">
                                {{$error}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{isset($tag) ? route('tags.update', $tag->id) : route('tags.store')}}">
                @csrf
                @if(isset($tag))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <input type="text" name="name" placeholder="tag Name" value="{{ isset($tag) ? $tag->name : '' }}" class="form-control">
                </div>
                @if(isset($tag))
                    <input type="submit" value="Update" class="btn btn-success">

                @else
                    <input type="submit"class="btn btn-success" value="Add">
                @endif
                <a href="{{route('tags.index')}}" class="btn btn-secondary"> Cancel </a>
            </form>
        </div>
    </div>
@endsection
