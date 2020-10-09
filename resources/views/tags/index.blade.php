@extends('layouts.app')



@section('content')



    <div class="card card-default">
        <div class="card-header">
            tags List
        </div>
        <table class="table">

                 <th>Name</th>
                 <th>Post Count</th>
        </table>
        <div class="card-body">
            @if($tag->count() > 0)
                <ul class="list-group">
                    @foreach($tag as $tag)
                        <li class="list-group-item">
                            {{$tag->name}}
                            <center >
                                {{$tag->posts->count()}}
                            </center>

                            <a href="{{ route('tags.edit', $tag->id) }}" class="  btn btn-info btn-sm float-right">Edit</a>
                            <button onclick="Delete({{$tag->id}})" class="btn btn-danger btn-sm float-right mr-2">Delete</button>
                        </li>
                    @endforeach
                </ul>
            @else
                <h3 class="text-center">No Tags Yet.</h3>
            @endif
        </div>
    </div><br>
    <div class="d-flex justify-content-left">
        <a href="{{route('tags.create')}}" type="submit" class="btn btn-success">Add New tag</a>
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
                        <p>Are you sure you want to delete this tag?</p>
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
            form.action='tags/'+id;
            $('#deleteModal').modal('show')
        }
    </script>
@endsection
