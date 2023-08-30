@extends('users.master')
@section('title', 'Mgnregs report')
    
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
    <h1>Mgnregs Report</h1>
    <form action="{{ route('users.mgnregsDownload') }}" method="POST" id="mgnregsDownload">
        @csrf
    
        <button type="submit" class="btn btn-success">Download pdf report</button>
    </form> 
    <br>
    {{-- <a href="{{ route('users.MGNREGSExcelReport') }}">Download Excel Report</a> --}}
    <table>
        <tr>
            <th>District</th>
            <th>Subdivision</th>
            <th>Blockmuni</th>
            <th>Reporting Month</th>
            <th>Reporting year</th>
            <th>ToT person days generate</th>
            <th>Kcc Sponsored</th>
            <th>Avg persondays per household</th>
            <th>Expenditure made under mgnrega</th>
            <th>Percentage of labour budget achieved</th>
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
                <td>{{ $report->expenditure_made_under_mgnrega }}</td>
                <td>{{ number_format($report->percentage_of_labour_budget_achieved, 4) }}%</td>
                <td>{{ $report->name }}</td>
                <td>{{ $report->posted_date }}</td>

            </tr>
        @endforeach
    </table>

@endsection

