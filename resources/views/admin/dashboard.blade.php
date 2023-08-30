@extends('admin.layouts.master')


@section('title')
    Admin Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Unapproved users</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                    Id
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    User Type
                                </th>
                                <th>
                                    Is approved status
                                </th>
                                <th>
                                    Action
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($unapprovedUsers as $unapprovedUser)
                                    <tr>
                                        <td>
                                            {{ $unapprovedUser->id }}
                                        </td>
                                        <td>
                                            {{ $unapprovedUser->name }}
                                        </td>
                                        <td>
                                            {{ $unapprovedUser->email }}
                                        </td>
                                        <td>
                                            {{ $unapprovedUser->usertype }}
                                        </td>
                                        <td>
                                            {{ $unapprovedUser->is_approved == 0 ? 'Not approved' : '' }}
                                        </td>

                                        <td>
                                            
                                            <form action="{{ route('admin.usermanagement.update', $unapprovedUser->id) }}"
                                                method="POST" id="approveForm">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-success">Approve user</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div style="width: 99%;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> Approved users</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            Id
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            User Type
                                        </th>
                                        <th>
                                            Is approved status
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($approvedUsers as $approvedUser)
                                            <tr>
                                                <td>
                                                    {{ $approvedUser->id }}
                                                </td>
                                                <td>
                                                    {{ $approvedUser->name }}
                                                </td>
                                                <td>
                                                    {{ $approvedUser->email }}
                                                </td>
                                                <td>
                                                    {{ $approvedUser->usertype }}
                                                </td>
                                                <td>
                                                    {{ $approvedUser->is_approved?'Approved':'' }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.usermanagement.edit',$approvedUser->id) }}">Give role to user</a>
                                            
                                                </td>
    
                                            </tr>
                                        @endforeach
    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
        </div>
        
            </div>
        @endsection

        @section('scripts')
      
            
       
        @endsection
