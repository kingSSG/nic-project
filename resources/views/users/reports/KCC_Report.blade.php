@extends('users.master')
@section('title', 'KCC report')

@section('style')
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
    <link rel="stylesheet" href="{{ URL('css/bootstrap.min.css') }}">
@endsection
@section('content')


    <h1>KCC_Report</h1>



    <form action="{{ route('users.kccDownload') }}" method="POST" id="kccDownload">
        @csrf

        <button type="submit" class="btn btn-success">Download pdf report</button>
    </form>
    <br>

    {{-- <a href="{{ route('users.KCCExcelReport') }}">Download Excel Report</a> --}}
    <table>
        <tr>
            <th>District</th>
            <th>Subdivision</th>
            <th>Blockmuni</th>
            <th>Reporting Month</th>
            <th>Reporting year</th>
            <th>KCC Target</th>
            <th>KCC Sponsored</th>
            <th>KCC Sanctioned</th>
            <th>Percentage Sponsored</th>
            <th>User</th>
            <th>Posted Date</th>
        </tr>
        @foreach ($kccReport as $report)
            <tr>
                <td>{{ $report->district }}</td>
                <td>{{ $report->subdivision }}</td>
                <td>{{ $report->blockmuni }}</td>
                <td>{{ $report->month_name }}</td>
                <td>{{ $report->reporting_year }}</td>
                <td>{{ $report->KCC_target }}</td>
                <td>{{ $report->KCC_sponsored }}</td>
                <td>{{ $report->KCC_sanctioned }}</td>
                <td>{{ number_format($report->Percentage_sponsored, 2) }}%</td>
                <td>{{ $report->name }}</td>
                <td>{{ $report->posted_date }}</td>

            </tr>
        @endforeach
    </table>


@endsection
