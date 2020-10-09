@extends('layouts.app')



@section('content')



    <div class="card card-default">
        <div class="card-header">
            Category List
        </div>
        <div class="card-body">
            @if($category->count() > 0)
                <ul class="list-group">
                    @foreach($category as $category)
                        <li class="list-group-item">
                            {{$category->name}}
                            <a href="{{ route('categories.edit', $category->id) }}" class="  btn btn-info btn-sm float-right">Edit</a>
                            <button onclick="Delete({{$category->id}})" class="btn btn-danger btn-sm float-right mr-2">Delete</button>
                        </li>
                    @endforeach
                </ul>
            @else
                <h3 class="text-center">No Categories Yet.</h3>
            @endif
        </div>
    </div><br>
    <div class="d-flex justify-content-left">
        <a href="{{route('categories.create')}}" type="submit" class="btn btn-success">Add New Category</a>
    </div>
    <form method="POST" action="" id="deleteit">
        @method('DELETE')
        @csrf
        <div class="modal" id="deleteModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this category?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@section('script')
    <script>
        function Delete(id) {
            var form = document.getElementById('deleteit');
            form.action='categories/'+id;
            $('#deleteModal').modal('show')
        }
    </script>
@endsection
