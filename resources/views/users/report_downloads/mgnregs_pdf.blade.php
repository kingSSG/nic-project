<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mgnregs Report</title>
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
    <h1>Mgnregs_Report</h1>
  
    <table>
        <tr>
            <th>District</th>
            <th>Subdivision</th>
            <th>Blockmuni</th>
            <th>Reporting Month</th>
            <th>Reporting year</th>
            <th>Kcc Target</th>
            <th>Kcc Sponsored</th>
            <th>Kcc Sanctioned</th>
            <th>Precentage Sponsored</th>
            <th>User</th>
            <th>Posted Date</th>
        </tr>
        @foreach ($mgnregsReport as $report)
            <tr>


                <td>{{ $report->district }}</td>
                <td>{{ $report->subdivision }}</td>
                <td>{{ $report->blockmuni }}</td>
                <td>{{ $report->month_name }}</td>
                <td>{{ $report->reporting_year }}</td>
                <td>{{ $report->tot_person_days_generate }}</td>
                <td>{{ $report->KCC_sponsored }}</td>
                <td>{{ $report->avg_persondays_per_household }}</td>
                <td>{{ number_format($report->percentage_of_labour_budget_achieved, 2) }}%</td>
                <td>{{ $report->name }}</td>
                <td>{{ $report->posted_date }}</td>

            </tr>
        @endforeach
    </table>


</body>

</html>
