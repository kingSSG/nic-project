@extends('users.master')
@section('title', 'Anandadhara Entry update')

@section('style')

    <link rel="stylesheet" href="{{ URL('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL('css/entry_update/insert_form.css') }}">

@endsection

@section('content')

    <div class="container contact">
        <div class="row">
            <div class="col-md-3">
                <div class="contact-info">
                    <h2>Anandadhara Entry Update</h2>
                    <h4>Enter The following Details</h4>
                </div>
            </div>
            <div class="col-md-9">


                <div class="contact-form">
                    <form action="{{ route('users.insertAnandhara') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                @include('users.commonInputs')
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label for="tot_SHGs_formed" class="form-group col-md-6">Enter tot SHGs formed</label>
                                    <div class="col-sm-10">
                                        <input type="number" placeholder="tot SHGs formed" min="1" step="1"
                                            name="tot_SHGs_formed" id="tot_SHGs" class="form-control">
                                    </div>
                                    @error('tot_SHGs_formed')
                                        <span>{{ $message }}</span><br>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tot_SHGs_credit_linkage" class="form-group col-md-6">Enter tot SHGs Credit
                                        Linkage</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="1" step="1" name="tot_SHGs_credit_linkage"
                                            id="tot_SHGs_Credit_Linkage" class="form-control"
                                            placeholder="tot SHGs Credit Linkage">
                                    </div>
                                    @error('tot_SHGs_credit_linkage')
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
                            {{ session()->pull('success') }}
                        </span>
                    </div>
                @endif
                @if (session()->has('fail'))
                    <div class="alert alert-danger">
                        <span>
                            {{ session()->pull('fail') }}

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
            }, 5000);

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
                        url: '/users/checkAnandadharaData',
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


                                $('#tot_SHGs').val(result['tot_SHGs_formed']);
                                $('#tot_SHGs_Credit_Linkage').val(result[
                                    'tot_SHGs_credit_linkage']);
                                $('#submit').html('Update');
                            } else {
                                $('#tot_SHGs').val(null);
                                $('#tot_SHGs_Credit_Linkage').val(null);
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
