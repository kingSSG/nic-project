<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KMExport implements FromView,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View
    {
        $kmReport = DB::table('kishan_mandi')
                ->select('district.district', 'subdivision.subdivision', 'block_muni.blockmuni', 'month_tbl.month_name', 'kishan_mandi.reporting_year', 'kishan_mandi.KM_operational', 'kishan_mandi.KM_sanctioned','kishan_mandi.posted_date', 'users.name')
                ->join('users', 'users.id', '=', 'kishan_mandi.user_code')
                ->join('district', 'district.districtcd', '=', 'kishan_mandi.districtcd')
                ->join('subdivision', 'subdivision.subdivisioncd', '=', 'kishan_mandi.subdivisioncd')
                ->join('block_muni', 'block_muni.blockminicd', '=', 'kishan_mandi.blockminicd')
                ->join('month_tbl', 'month_tbl.month', '=', 'kishan_mandi.reporting_month')
                //   ->where('reporting_month','=',$currentMonth)
                ->where('user_code', '=', auth()->user()->id)
                ->get();

        return view('users.reports.KM_report',compact('kmReport'));
    }
}
