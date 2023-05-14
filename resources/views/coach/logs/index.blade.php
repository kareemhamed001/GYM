@extends('layouts.app-blog-create')

@section('content')

    <!-- Modal -->
    <div class="modal fade" id="deletelogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete log?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <span class="text-danger">
                        the log will be deleted forever!
                     </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="closeModal()">
                        Close
                    </button>
                    <button type="button" class="btn btn-danger" onclick="deletelog()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteArrayOflogsModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Selected logs?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <span class="text-danger">
                        these logs will be deleted forever !
                     </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="closeModal()">
                        Close
                    </button>
                    <button type="button" class="btn btn-danger" onclick="deleteSelected()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-3">
        <div class="d-flex justify-content-between">
            <h3>logs</h3>


        </div>
        <div class="row my-2">
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                    {{session('error')}}
                </div>
            @elseif(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                    {{session('success')}}
                </div>
            @endif


        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover  table-bordered">
            <thead>
            <tr>
                <th scope="col">Table Name</th>
                <th scope="col">Item Id</th>
                <th scope="col">Action</th>
                <th scope="col">User</th>
                <th scope="col" class="text-center">Created_At</th>

            </tr>
            </thead>
            <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>

                        {{$log->table_name}}

                    </td>
                    <td>
                        <a href="{{url('/coach/'.$log->table_name.'/'.$log->item_id)}}">{{$log->item_id}}</a>
                    </td>
                    <td>
                        {{$log->action}}
                    </td>
                    <td class="text-center">
                        <a href="{{url('/coach/users/'.$log->user_id)}}">{{$log->user_id}}</a>
                    </td>
                    <td class="text-center">
                        {{\Carbon\Carbon::make($log->created_at)->toDateTimeString()}}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        {{$logs->links()}}

    </div>

@endsection

