@extends('users.master')
@section('title', 'KM Entry update')
@section('style')

    <link rel="stylesheet" href="{{ URL('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL('css/entry_update/insert_form.css') }}">

@endsection

@section('content')


    <div class="container contact">
        <div class="row">
            <div class="col-md-3">
                <div class="contact-info">
                    <h2>Kisan Mandi Entry Update</h2>
                    <h4>Enter The following Details</h4>
                </div>
            </div>
            <div class="col-md-9">


                <div class="contact-form">
                    <form action="{{ route('users.insertKishanMandi') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                @include('users.commonInputs')
                                <div class="form-group">
                                    <label for="KM_operational">Kishan Mandi Operational:</label>

                                    <select name="KM_operational" id="KM_operational" required
                                        class="form-control selectpicker">

                                        <option value="">Select KM_operational</option>
                                        <option value="FO">Fully Operational</option>
                                        <option value="PO">Partially Operational</option>
                                        <option value="NA">Not available</option>

                                    </select>

                                    @error('KM_operational')
                                        <span>{{ $message }}</span><br>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label for="KM_sanctioned" class="form-group col-md-6">Enter KM sanctioned</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="1" step="1" name="KM_sanctioned" id="KM_sanctioned"
                                            class="form-control" placeholder="KM sanctioned">
                                    </div>
                                    @error('KM_sanctioned')
                                        <span>{{ $message }}</span><br>
                                    @enderror
                                </div>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" value="Submit" id="submit"
                                        style="float: right ; width:fit-content" class="btn btn-default">Insert</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
                <div class="" id="dataAlreadyExists">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ URL('js/jQuery.min.js') }}"></script>

    <script defer type="text/javascript" src="{{ URL('js/dropdown.js') }}"></script>

    <script defer type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            cache: false,
        });

        $(document).ready(function() {
            setTimeout(() => {
                $('div.alert').slideUp();
            }, 1800);

            $('#month,#year,#district,#subdivision,#municipality').on('change', function() {
                var monthDataExists = $('#month').val();
                var districtDataExists = $('#district').val();
                var subdivisionDataExists = $('#subdivision').val();
                var municipalityDataExists = $('#municipality').val();
                var yearDataExists = $('#year').val();

                if (monthDataExists && districtDataExists && subdivisionDataExists &&
                    municipalityDataExists && yearDataExists) {
                    $('#dataAlreadyExists').removeClass('alert alert-danger');
                    $('#dataAlreadyExists').empty();
                    $.ajax({
                        url: '/users/checkKishanMandiData',
                        type: "POST",
                        data: {
                            district: districtDataExists,
                            subdivision: subdivisionDataExists,
                            municipality: municipalityDataExists,
                            month: monthDataExists,
                            year: yearDataExists,
                        },
                        success: function(result) {

                            if (result) {
                                $('#dataAlreadyExists').addClass('alert alert-danger');

                                $('#dataAlreadyExists').append(
                                    '<span>Data for the entered district subdivision block already exists for this month</span>'
                                );
                                $('#dataAlreadyExists').show();

                                setTimeout(() => {
                                    $('#dataAlreadyExists').slideUp();
                                }, 5000);



                                $('#KM_operational').val(result['KM_operational']);
                                $('#KM_sanctioned').val(result['KM_sanctioned']);
                                $('#submit').html('Update');
                            } else {
                                $('#KM_sanctioned').val(null);
                                $('#KM_operational').val(null);
                                $('#Percentage_sponsored').val(null);
                                $('#submit').html('Insert');
                            }

                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            alert("Status: " + textStatus);
                            alert("Error: " + errorThrown);
                        },
                    });

                }

            });



        });
    </script>


@endsection
