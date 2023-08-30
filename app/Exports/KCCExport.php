<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KCCExport implements FromView,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View
    {
        $kccReport = DB::table('kishan_credit_card')
                    ->select('district.district', 'subdivision.subdivision', 'block_muni.blockmuni', 'month_tbl.month_name', 'kishan_credit_card.reporting_year', 'kishan_credit_card.KCC_target', 'kishan_credit_card.KCC_sponsored', 'kishan_credit_card.KCC_sanctioned', 'kishan_credit_card.Percentage_sponsored', 'kishan_credit_card.posted_date', 'users.name')
                    ->join('users', 'users.id', '=', 'kishan_credit_card.user_code')
                    ->join('district', 'district.districtcd', '=', 'kishan_credit_card.districtcd')
                    ->join('subdivision', 'subdivision.subdivisioncd', '=', 'kishan_credit_card.subdivisioncd')
                    ->join('block_muni', 'block_muni.blockminicd', '=', 'kishan_credit_card.blockminicd')
                    ->join('month_tbl', 'month_tbl.month', '=', 'kishan_credit_card.reporting_month')
                    //   ->where('reporting_month','=',$currentMonth)
                    ->where('user_code', '=', auth()->user()->id)
                    ->get();
          return view('users.report_downloads.kcc_pdf',compact('kccReport'));          
    }
}
