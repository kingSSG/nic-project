@extends('admin.layouts.master')


@section('title')
    Admin Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Select Criteria for excel report</h4>
                </div>
                <div class="card-body">
                    <div class="container contact">
                        <div class="row">
                         
                            <div class="col-md-9">
                                @if (session()->has('success'))
                                    <div class="alert alert-success">
                                        <span>
                                            {{ session()->get('success') }}
                                        </span>
                                    </div>
                                @endif
                                @if (session()->has('fail'))
                                    <div class="alert alert-danger">
                                        <span>
                                            {{ session()->get('fail') }}
                                        </span>
                                    </div>
                                @endif
                                <div class="contact-form">
                                    <form action="{{ route('admin.showExceldata') }}" method="GET">
                                      
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                {{-- <div class="form-group">
                                                    <label for="District">District:</label>
                                                    <select name="district" id="district" required class="form-control selectpicker">
                                                        <option value=""> Select District </option>
                                                        @foreach ($districts as $district)
                                                            <option value="{{ $district->districtcd }}">{{ $district->district }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('district')
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div> --}}
                                                <div class="form-group">
                                                    <label for="Months">Reporting Year</label>
                                                    <select name="year" id="year" required class="form-control selectpicker">
                                                        <option value="">Select Year</option>
                                                        @foreach ($years as $year)
                                                            <option value="{{ $year->year }}">{{ $year->year }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('year')
                                                        <span>{{ $message }}</span><br>
                                                    @enderror
                                                
                                                </div>
                                                <div class="form-group">
                                                    <label for="Months">Reporting Month</label>
                                                    <select name="month" id="month" required class="form-control selectpicker">
                                                        <option value="">Select Month</option>
                                                        @foreach ($months as $month)
                                                            <option value="{{ $month->month }}">{{ $month->month_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('month')
                                                        <span>{{ $message }}</span><br>
                                                    @enderror
                                                
                                                </div>
                                             
                                            </div>
                                                <div class="col-sm-offset-2 col-sm-10 ">
                                                    <button type="submit" value="Submit" id="submit"
                                                        style="float: left; width:fit-content" class="btn btn-success">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
