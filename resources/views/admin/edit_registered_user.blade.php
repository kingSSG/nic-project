@extends('admin.layouts.master')


@section('title')
    Edit registered person
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit role for approved user</h3>
                        <hr>
                        <h4>Edit role for {{ $usermanagement->name }}:</h4>

                    </div>
                    <div class="card-body">
                        
                       <div class="row">
                         @if (!$rolesForUser->isEmpty())
                         <h6>Current roles of the user</h6>
                            @foreach ( $rolesForUser as $role )
                                 <p style="margin-right: 20px; margin-left:15px;">{{ $role }}</p> 
                             @endforeach
                          @else
                             <p style="margin-left:5px;">No roles assigned to the user yet</p>
                        @endif
                       </div>
                        <div class="row">
                       
                            <div class="col-md-6">
                                
                          
                                <form action="{{ route('admin.updateRole', $usermanagement->id) }}" method="POST">
                                    
                                    @csrf
                               
                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Give role</label>
                                            <select name="role" class="form-select form-control">

                                                <option selected>Select user role</option>
                                              
                                                @foreach ($menus as $key=>$value )
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>
                                    <button class="btn btn-success" type="submit">Update</button>
                                    <a href="{{ route('admin.usermanagement.index') }}" class="btn btn-danger">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
