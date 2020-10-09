@extends('layouts.app')

@section('content')
   <div class="card card-default">
       <div class="card-header">
           {{ isset($category) ? "Edit category" : 'Add New category' }}
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

           <form method="POST" action="{{isset($category) ? route('categories.update', $category->id) : route('categories.store')}}">
               @csrf
               @if(isset($category))
                    @method('PUT')
                   @endif
               <div class="form-group">
                   <input type="text" name="name" placeholder="category Name" value="{{ isset($category) ? $category->name : '' }}" class="form-control">
               </div>
               @if(isset($category))
                   <input type="submit" value="Update" class="btn btn-success">

               @else
                   <input type="submit"class="btn btn-success" value="Add">
               @endif
               <a href="{{route('categories.index')}}" class="btn btn-secondary"> Cancel </a>
           </form>
       </div>
   </div>
    @endsection
