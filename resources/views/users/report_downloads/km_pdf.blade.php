<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KM Report</title>
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
</head>

<body>
    <h1>KM Report</h1>
    
    <table>
        <tr>
            <th>District</th>
            <th>Subdivision</th>
            <th>Blockmuni</th>
            <th>Reporting Month</th>
            <th>Reporting year</th>
            <th>KM Operational</th>

            <th>KM Sanctioned</th>

            <th>User</th>
            <th>Posted Date</th>
        </tr>
        @foreach ($kmReport as $report)
            <tr>


                <td>{{ $report->district }}</td>
                <td>{{ $report->subdivision }}</td>
                <td>{{ $report->blockmuni }}</td>
                <td>{{ $report->month_name }}</td>
                <td>{{ $report->reporting_year }}</td>
                <td>{{ $report->KM_operational }}</td>
                <td>{{ $report->KM_sanctioned }}</td>


                <td>{{ $report->name }}</td>
                <td>{{ $report->posted_date }}</td>

            </tr>
        @endforeach
    </table>


</body>

</html>
