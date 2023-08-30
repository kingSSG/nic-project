<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class MGNREGSExport implements FromView,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View
    {
        $mgnregsReport = DB::table('mgnregs')
                    ->select('district.district', 'subdivision.subdivision', 'block_muni.blockmuni', 'month_tbl.month_name', 'mgnregs.reporting_year', 'mgnregs.tot_person_days_generate', 'mgnregs.KCC_sponsored', 'mgnregs.avg_persondays_per_household', 'mgnregs.percentage_of_labour_budget_achieved', 'mgnregs.posted_date', 'users.name')
                    ->join('users', 'users.id', '=', 'mgnregs.user_code')
                    ->join('district', 'district.districtcd', '=', 'mgnregs.districtcd')
                    ->join('subdivision', 'subdivision.subdivisioncd', '=', 'mgnregs.subdivisioncd')
                    ->join('block_muni', 'block_muni.blockminicd', '=', 'mgnregs.blockminicd')
                    ->join('month_tbl', 'month_tbl.month', '=', 'mgnregs.reporting_month')
                    //   ->where('reporting_month','=',$currentMonth)
                    ->where('user_code', '=', auth()->user()->id)
                    ->get();

        return view('users.reports.MGNREGS_report',compact('mgnregsReport'));
    }
}
