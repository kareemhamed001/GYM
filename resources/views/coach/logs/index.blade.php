@extends('layouts.app-blog-create')

@section('content')

    <div class="row my-3">
        <div class="">

            <h3> <i class="fa-light fa-gear"></i> logs</h3>


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
                        {{$log->item_id}}
                    </td>
                    <td>
                        {{$log->action}}
                    </td>
                    <td class="text-center">
                        <a href="{{url('/coach/users/'.$log->user_id)}}">{{\App\Models\User::find($log->user_id)->name??$log->user_id??'User not entered'}}</a>
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

