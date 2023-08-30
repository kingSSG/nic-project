@extends('users.master')
@section('title', 'Anandadhara Entry update')

@section('style')

<link rel="stylesheet" href="{{ URL('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ URL('css/entry_update/insert_form.css') }}">

@endsection

@section('content')
    
 
    <!------ Include the above in your HEAD tag ---------->

    <div class="container contact">
        <div class="row">
            <div class="col-md-3">
                <div class="contact-info">
                    <h2>Select Criteria for excel report</h2>
                    
                </div>
            </div>
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
                    <form action="{{ route('users.showExceldata') }}" method="GET">
                      
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
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" value="Submit" id="submit"
                                        style="float: right ; width:fit-content" class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
<script  type="text/javascript" src="{{ URL('js/jQuery.min.js') }}"></script>

<script defer type="text/javascript" src="{{ URL('js/dropdown.js') }}"> </script>

@endsection
