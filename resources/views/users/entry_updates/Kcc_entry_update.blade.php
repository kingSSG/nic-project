@extends('users.master')
@section('title', 'KCC Entry update')
@section('style')

    <link rel="stylesheet" href="{{ URL('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL('css/entry_update/insert_form.css') }}">

@endsection

@section('content')


    <div class="container contact">
        <div class="row">
            <div class="col-md-3">
                <div class="contact-info">
                    <h2>Kisan Credit Card Entry Update</h2>
                    <h4>Enter The following Details </h4>
                </div>
            </div>
            <div class="col-md-9">



                <div class="contact-form">
                    <form action="{{ route('users.insertKcc') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                @include('users.commonInputs')
                            </div>
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label class="form-group col-md-6">Target</label>
                                    <div class="col-sm-10">
                                        <input type="number" placeholder="Enter Target" min="1" step="1" name="target"
                                            id="target" class="form-control">
                                    </div>
                                    @error('target')
                                        <span>{{ $message }}</span><br>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-group col-md-6">No. of Kcc Sponsored</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="1" step="0.0001" name="kcc_sponsored" id="kcc_sponsored"
                                            class="form-control" placeholder="Kcc Sponsored">
                                    </div>
                                    @error('kcc_sponsored')
                                        <span>{{ $message }}</span><br>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-group col-md-6">No. of Kcc Sanctioned</label>
                                    <div class="col-sm-10">
                                        <input type="number" min="1" step="1" name="kcc_sanctioned" id="kcc_sanctioned"
                                            class="form-control" placeholder="Kcc Sanctioned">
                                    </div>
                                    @error('kcc_sanctioned')
                                        <span>{{ $message }}</span><br>
                                    @enderror
                                </div>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" value="Insert" id="submit"
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
                        url: '/users/checkkccData',
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


                                $('#target').val(result['KCC_target']);
                                $('#kcc_sanctioned').val(result['KCC_sanctioned']);
                                $('#kcc_sponsored').val(result['KCC_sponsored']);
                                $('#submit').html('Update');
                            } else {
                                $('#target').val(null);
                                $('#kcc_sanctioned').val(null);
                                $('#kcc_sponsored').val(null);
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
