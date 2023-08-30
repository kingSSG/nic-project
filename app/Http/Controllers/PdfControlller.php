<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Classes\DropdownContent;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\PDF as DomPDFPDF;

class PdfControlller extends Controller
{   

    private $pdf;
    
   
    public function __construct(DomPDFPDF $pdf)
    {
        $this->pdf=$pdf;
       
    }
    

    public  function  kccDownload()
    {  
      
        // dd($kccReport);
       
        $kccReport = DB::table('kishan_credit_card')
                    ->select('district.district', 'subdivision.subdivision', 'block_muni.blockmuni', 'month_tbl.month_name', 'kishan_credit_card.reporting_year', 'kishan_credit_card.KCC_target', 'kishan_credit_card.KCC_sponsored', 'kishan_credit_card.KCC_sanctioned', 'kishan_credit_card.Percentage_sponsored', 'kishan_credit_card.posted_date', 'users.name')
                    ->join('users', 'users.id', '=', 'kishan_credit_card.user_code')
                    ->join('district', 'district.districtcd', '=', 'kishan_credit_card.districtcd')
                    ->join('subdivision', 'subdivision.subdivisioncd', '=', 'kishan_credit_card.subdivisioncd')
                    ->join('block_muni', 'block_muni.blockminicd', '=', 'kishan_credit_card.blockminicd')
                    ->join('month_tbl', 'month_tbl.month', '=', 'kishan_credit_card.reporting_month')
                    ->where('user_code', '=', auth()->user()->id)
                    ->get();
    
        $this->pdf->loadView('users.report_downloads.kcc_pdf', compact('kccReport'))
                 ->setPaper('a4', 'landscape');
        
        return $this->pdf->stream('KccReport.pdf');
    }
    public function kmDownload(){
     
        $kmReport = DB::table('kishan_mandi')
                        ->select('district.district', 'subdivision.subdivision', 'block_muni.blockmuni', 'month_tbl.month_name', 'kishan_mandi.reporting_year', 'kishan_mandi.KM_operational', 'kishan_mandi.KM_sanctioned', 'kishan_mandi.posted_date', 'users.name')
                        ->join('users', 'users.id', '=', 'kishan_mandi.user_code')
                        ->join('district', 'district.districtcd', '=', 'kishan_mandi.districtcd')
                        ->join('subdivision', 'subdivision.subdivisioncd', '=', 'kishan_mandi.subdivisioncd')
                        ->join('block_muni', 'block_muni.blockminicd', '=', 'kishan_mandi.blockminicd')
                        ->join('month_tbl', 'month_tbl.month', '=', 'kishan_mandi.reporting_month')
                        
                        ->where('user_code', '=', auth()->user()->id)
                        ->get();
   
        $this->pdf->loadView('users.report_downloads.km_pdf', compact('kmReport'))
                  ->setPaper('a4', 'landscape');   
        return $this->pdf->stream('KmReport.pdf');                 
    }
    public function mgnregsDownload(){
        
        $mgnregsReport = DB::table('mgnregs')
                            ->select('district.district', 'subdivision.subdivision', 'block_muni.blockmuni', 'month_tbl.month_name', 'mgnregs.reporting_year', 'mgnregs.tot_person_days_generate', 'mgnregs.KCC_sponsored', 'mgnregs.avg_persondays_per_household', 'mgnregs.percentage_of_labour_budget_achieved', 'mgnregs.posted_date', 'users.name')
                            ->join('users', 'users.id', '=', 'mgnregs.user_code')
                            ->join('district', 'district.districtcd', '=', 'mgnregs.districtcd')
                            ->join('subdivision', 'subdivision.subdivisioncd', '=', 'mgnregs.subdivisioncd')
                            ->join('block_muni', 'block_muni.blockminicd', '=', 'mgnregs.blockminicd')
                            ->join('month_tbl', 'month_tbl.month', '=', 'mgnregs.reporting_month')
                            ->where('user_code', '=', auth()->user()->id)
                            ->get();

        $this->pdf->loadView('users.report_downloads.mgnregs_pdf', compact('mgnregsReport'))
                   ->setPaper('a4', 'landscape');
        return $this->pdf->stream('MgnregsReport.pdf');
    }
    public function anandadharaDownload(){
       
        $anandadharaReport = DB::table('anandadhara')
                                ->select('district.district', 'subdivision.subdivision', 'block_muni.blockmuni', 'month_tbl.month_name', 'anandadhara.reporting_year', 'anandadhara.tot_SHGs_formed', 'anandadhara.tot_SHGs_credit_linkage', 'anandadhara.posted_date', 'users.name')
                                ->join('users', 'users.id', '=', 'anandadhara.user_code')
                                ->join('district', 'district.districtcd', '=', 'anandadhara.districtcd')
                                ->join('subdivision', 'subdivision.subdivisioncd', '=', 'anandadhara.subdivisioncd')
                                ->join('block_muni', 'block_muni.blockminicd', '=', 'anandadhara.blockminicd')
                                ->join('month_tbl', 'month_tbl.month', '=', 'anandadhara.reporting_month')
                                ->where('user_code', '=', auth()->user()->id)
                                ->get();
        $this->pdf->loadView('users.report_downloads.anandadhara_pdf', compact('anandadharaReport'))
                  ->setPaper('a4', 'landscape');
        return $this->pdf->stream('AnandharaReport.pdf');
    }

    public function showExceldata(Request $request){
        
       $reportingMonth=$request->month;
       $reportingYear=$request->year;

       $excelData=DB::table('block_muni')
                     ->select(
                            'block_muni.blockmuni', 
                            'kishan_credit_card.KCC_target', 
                            'kishan_credit_card.KCC_sponsored', 
                            'kishan_credit_card.KCC_sanctioned', 
                            'kishan_credit_card.Percentage_sponsored',
                            'kishan_mandi.KM_operational',
                            'mgnregs.tot_person_days_generate', 
                            'mgnregs.avg_persondays_per_household', 
                            'mgnregs.expenditure_made_under_mgnrega',
                            'mgnregs.percentage_of_labour_budget_achieved',
                            'anandadhara.tot_SHGs_formed', 
                            'anandadhara.tot_SHGs_credit_linkage',
                            )
                    ->leftJoin('kishan_credit_card',function($query)use($reportingMonth,$reportingYear){
                        $query->on('block_muni.blockminicd','=','kishan_credit_card.blockminicd');
                        $query->where('kishan_credit_card.reporting_month','=',$reportingMonth);
                        $query->where('kishan_credit_card.reporting_year','=',$reportingYear);
                    })
                    ->leftJoin('kishan_mandi',function($query)use($reportingMonth,$reportingYear){
                        $query->on('block_muni.blockminicd','=','kishan_mandi.blockminicd');
                        $query->where('kishan_mandi.reporting_month','=',$reportingMonth);
                        $query->where('kishan_mandi.reporting_year','=',$reportingYear);
                    })
                    ->leftJoin('mgnregs',function($query)use($reportingMonth,$reportingYear){
                        $query->on('block_muni.blockminicd','=','mgnregs.blockminicd');
                        $query->where('mgnregs.reporting_month','=',$reportingMonth);
                        $query->where('mgnregs.reporting_year','=',$reportingYear);
                    })
                    ->leftJoin('anandadhara',function($query)use($reportingMonth,$reportingYear){
                        $query->on('block_muni.blockminicd','=','anandadhara.blockminicd');
                        $query->where('anandadhara.reporting_month','=',$reportingMonth);
                        $query->where('anandadhara.reporting_year','=',$reportingYear);
                    })
                    ->get();
        return view('users.excel_downloads.cm_excel',compact('excelData','reportingMonth','reportingYear'));
    }
    public function showExcelReportCritera(){
        $data=DropdownContent::getDropdownContent();
        $districts = $data['districts'];
        $months = $data['months'];
        $years = $data['years'];
        return view('users.excel_report.criteria_excel_report',compact('districts','months','years'));
    }
}
