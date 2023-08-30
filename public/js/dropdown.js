
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    cache: false,
});

$(document).ready(function () {

    $('#district').on('click change', function (e) {

        $('#municipality').empty();
        $('#municipality').append(
            '<option value="">Select Municipality</option>');

        $('#subdivision').empty();
        $('#subdivision').append('<option value="">Select Subdivision</option>');

        let districtId = $(this).val();

        if (districtId) {

            $.ajax({
                url: '/users/getSubdivision',
                type: "POST",
                data: {
                    districtId: districtId,
                },
                success: function (result) {

                    if (result) {

                        $('#subdivision').empty();
                        $('#subdivision').append('<option value="">Select Subdivision</option>');

                        $.each(result, function (key, value) {

                            $('#subdivision').append("<option value=" +
                                key +
                                ">" + value + "</option>");
                        });
                    } else {
                        $('#subdivision').empty();
                        $('#subdivision').append('<option value="">Select Subdivision</option>');
                        $('#municipality').empty();
                        $('#municipality').append(
                            '<option value="">Select Municipality</option>');

                    }

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                },
            });

        } else {
            $('#subdivision').empty();
            $('#subdivision').append('<option value="">Select Subdivision</option>');
            $('#municipality').empty();
            $('#municipality').append(
                '<option value="">Select Municipality</option>');
        }


    });

    $('#subdivision').on('change click', function (e) {

        let subdivisionId = $(this).val();

        if (subdivisionId) {
            $.ajax({
                url: '/users/getMunicipality',
                type: "POST",
                data: {
                    subdivisionId: subdivisionId,
                },
                success: function (result) {

                    if (result) {

                        $('#municipality').empty();
                        $('#municipality').append(
                            '<option value="">Select Municipality</option>');

                        $.each(result, function (key, value) {
                            $('#municipality').append("<option value=" +
                                key +
                                ">" + value + "</option>");
                        });
                    } else {
                        $('#municipality').empty();
                        $('#municipality').append(
                            '<option value="">Select Municipality</option>');
                    }

                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                },
            });
        } else {
            $('#municipality').empty();
            $('#municipality').append(
                '<option value="">Select Municipality</option>');

        }

    });

});