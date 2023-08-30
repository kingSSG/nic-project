<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMReport</title>
 
    <style>
        table,
        th,
        td {
            border: 1px solid;
        }

        table {
            width: 100%;
        }

        td {
            padding: 8px;
        }

        th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: beige;
        }

    </style>
    <link href="{{ URL('css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
    <form action="{{ route('users.downloadCMReport') }}" method="POST">
        @csrf
        <input type="hidden" value="{{ $reportingYear }}" name="year">
        <input type="hidden" value="{{ $reportingMonth }}" name="month">
        <input type="submit" class="btn btn-success" value="Download excel report">
    </form>
    <br>
    <table>
        <thead>
            <tr>
                <th></th>
                <th  style="text-align: center" colspan="4"><h2>Kisan Credit Card</h2></th>
                <th  style="text-align: center" colspan="1"><h2>Kishan Mandi</h2></th>
                <th  style="text-align: center" colspan="4"><h2>MGNREGS</h2></th>
                <th  style="text-align: center" colspan="2"><h2>Anandadhara</h2></th>
            </tr>
            <tr>
                <th>Name of the Block/Muncipality</th>
                <th>Target</th>
                <th>No of KCC sponsored</th>
                <th>No of KCC sanctioned</th>
                <th>KCC spondored percentage</th>
                <th>No of kishan mandi sanctioned</th>
                <th>Number of days generated under MGNREGA</th>
                <th>Average number of person days generated under MGNREGA</th>
                <th>Expenditure made under MGNREGA</th>
                <th>% of labour budget achieved so far</th>
                <th>Total number of SHGS formed in the district</th>
                <th>Total number of SHGS got credit linkage</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($excelData as $data )
            <tr> 
                <td>{{ $data->blockmuni }}</td>
                <td>{{ $data->KCC_target }}</td>
                <td>{{ $data->KCC_sponsored }}</td>
                <td>{{ $data->KCC_sanctioned }}</td>
                <td>{{ number_format($data->Percentage_sponsored, 2) }}%</td>
                <td>{{ $data->KM_operational }}</td>
                <td>{{ $data->tot_person_days_generate }}</td>
                <td>{{ $data->avg_persondays_per_household }}</td>
                <td>{{ $data->expenditure_made_under_mgnrega}}</td>
                <td>{{ number_format($data->percentage_of_labour_budget_achieved, 2) }}%</td>
                <td>{{ $data->tot_SHGs_formed }}</td>
                <td>{{ $data->tot_SHGs_credit_linkage }}</td>
            </tr>
            @endforeach
          
            
        </tbody>
    </table>
</body>
</html>