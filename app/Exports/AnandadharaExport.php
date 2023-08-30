<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class AnandadharaExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View
    {
        $anandadharaReport = DB::table('anandadhara')
                    ->select('district.district', 'subdivision.subdivision', 'block_muni.blockmuni', 'month_tbl.month_name', 'anandadhara.reporting_year', 'anandadhara.tot_SHGs_formed', 'anandadhara.tot_SHGs_credit_linkage','anandadhara.posted_date', 'users.name')
                    ->join('users', 'users.id', '=', 'anandadhara.user_code')
                    ->join('district', 'district.districtcd', '=', 'anandadhara.districtcd')
                    ->join('subdivision', 'subdivision.subdivisioncd', '=', 'anandadhara.subdivisioncd')
                    ->join('block_muni', 'block_muni.blockminicd', '=', 'anandadhara.blockminicd')
                    ->join('month_tbl', 'month_tbl.month', '=', 'anandadhara.reporting_month')
                    //   ->where('reporting_month','=',$currentMonth)
                    ->where('user_code', '=', auth()->user()->id)
                    ->get();
        return view('users.reports.Anandadhara_report',compact('anandadharaReport'));
    }
}
