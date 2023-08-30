@extends('admin.layouts.master')


@section('title')
    Registererd roles
@endsection

{{-- CURRENTLY THIS PAGE IS NOT IN USE --}}

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Registered roles</h4>
                    <h4>
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <tr>
                                    <th scope="col">
                                        User id
                                    </th>
                                    <th scope="col">
                                        Name
                                    </th>
                                    <th scope="col">
                                        Phone
                                    </th>
                                    <th scope="col">
                                        Email
                                    </th>
                                    <th scope="col">
                                        User Type
                                    </th>
                                    <th scope="col">
                                        Edit
                                    </th>
                                    <th scope="col">
                                        Delete
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">
                                            {{ $user->id }}
                                        </th>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $user->phone }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            {{-- {{ $user->usertype ?? 'No role assigned' }} --}}
                                        </td>
                                        <td>
                                            {{-- <a href="{{ route('admin.editRoles', $user->id) }}"
                                                class="btn btn-success">Edit user</a> --}}
                                        </td>
                                        <td>
                                            {{-- <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger">Delete user</button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
    @endsection
