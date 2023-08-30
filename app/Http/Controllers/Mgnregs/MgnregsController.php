<?php

namespace App\Http\Controllers\Mgnregs;




use Illuminate\Http\Request;
use App\Classes\DropdownContent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MgnregsController extends Controller
{





    public function MGNREGS_Entry_update()
    {
        $data = DropdownContent::getDropdownContent();
        $districts = $data['districts'];
        $months = $data['months'];
        $years = $data['years'];
        header('Cache-Control: no-store, private, no-cache, must-revalidate');
        header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);
        header('Pragma: public');
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        header('Expires: 0', false);
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Pragma: no-cache');
        return view('users.entry_updates.MGNREGS_Entry_update', compact('districts', 'months', 'years'));
    }





    public function checkMgnregsData(Request $request)
    {


        $request->validate([
            'district' => 'exists:district,districtcd',
            'subdivision' => 'exists:subdivision,subdivisioncd',
            'municipality' => 'exists:block_muni,blockminicd',
            'month' => 'exists:month_tbl,month',
            'year' => 'exists:years,year',

        ]);


        $conditions = [
            "districtcd" => $request->post('district'),
            "subdivisioncd" => $request->post('subdivision'),
            "blockminicd" => $request->post('municipality'),
            "reporting_month" => $request->post('month'),
            "reporting_year" => $request->post('year'),

        ];
        $data = DB::table('mgnregs')
            ->where($conditions)
            ->first();


        if ($data) {
            return response()->json($data);
        } else {
            return;
        }
    }

    public function insertMgnregs(Request $request)
    {
       
        $request->validate([
            'district' => 'exists:district,districtcd',
            'subdivision' => 'exists:subdivision,subdivisioncd',
            'month' => 'exists:month_tbl,month',
            'year' => 'exists:years,year',
            'municipality' => 'exists:block_muni,blockminicd',
            'tot_person_days_generate' =>  ['required', 'integer', 'min:1'],
            'KCC_sponsored' => ['required', 'integer', 'min:1'],
        ]);

        $conditions = [
            "districtcd" => $request->post('district'),
            "subdivisioncd" => $request->post('subdivision'),
            "blockminicd" => $request->post('municipality'),
            "reporting_month" => $request->post('month'),
            "reporting_year" => $request->post('year'),
        ];

        $dataAlreadyExists = DB::table('mgnregs')
                            ->where($conditions)
                            ->first();

        if ($dataAlreadyExists) {

            if($dataAlreadyExists->tot_person_days_generate!=$request->post('tot_person_days_generate')
            ||$dataAlreadyExists->KCC_sponsored!=$request->post('KCC_sponsored')
            ||$dataAlreadyExists->avg_persondays_per_household!=$request->post('avg_persondays_per_household')
            ||$dataAlreadyExists->expenditure_made_under_mgnrega!=$request->post('expenditure_made_under_mgnrega')
            ||$dataAlreadyExists->percentage_of_labour_budget_achieved!=$request->post('percentage_of_labour_budget_achieved')
            ){
                $updated = DB::table('mgnregs')
                    ->where($conditions)
                    ->update([
                        "tot_person_days_generate" => $request->post('tot_person_days_generate'),
                        "KCC_sponsored" => $request->post('KCC_sponsored'),
                        "avg_persondays_per_household" => $request->post('avg_persondays_per_household'),
                        "expenditure_made_under_mgnrega" => $request->post('expenditure_made_under_mgnrega'),
                        "percentage_of_labour_budget_achieved" => $request->post('percentage_of_labour_budget_achieved'),
                        "user_code" => auth()->user()->id,
                        "posted_date" => date("Y/m/d"),
                ]);
                if($updated){
                    return redirect()->back()->with('success', 'Data updated successfully');
                }
            }else{
                return redirect()->back()->with('fail', 'No changes  made to existing  data');
            }



           
        } else {
            $inserted =  DB::table('mgnregs')
                ->insert([
                    "districtcd" => $request->post('district'),
                    "subdivisioncd" => $request->post('subdivision'),
                    "blockminicd" => $request->post('municipality'),
                    "reporting_month" => $request->post('month'),
                    "reporting_year" => $request->post('year'),
                    "tot_person_days_generate" => $request->post('tot_person_days_generate'),
                    "KCC_sponsored" => $request->post('KCC_sponsored'),
                    "avg_persondays_per_household" => $request->post('avg_persondays_per_household'),
                    "expenditure_made_under_mgnrega" => $request->post('expenditure_made_under_mgnrega'),
                    "percentage_of_labour_budget_achieved" => $request->post('percentage_of_labour_budget_achieved'),
                    "user_code" => auth()->user()->id,
                    "posted_date" => date("Y/m/d"),
                ]);
            if ($inserted) {
                return redirect()->back()->with('success', 'Data inserted successfully');
            } else {
                return redirect()->back()->with('fail', 'Failed to insert data');
            }
        }
    }





    public function MGNREGS_report()
    {
        $mgnregsReport = DB::table('mgnregs')
            ->select('district.district', 'subdivision.subdivision', 'block_muni.blockmuni', 'month_tbl.month_name', 'mgnregs.reporting_year', 'mgnregs.tot_person_days_generate', 'mgnregs.KCC_sponsored','mgnregs.expenditure_made_under_mgnrega', 'mgnregs.avg_persondays_per_household', 'mgnregs.percentage_of_labour_budget_achieved', 'mgnregs.posted_date', 'users.name')
            ->join('users', 'users.id', '=', 'mgnregs.user_code')
            ->join('district', 'district.districtcd', '=', 'mgnregs.districtcd')
            ->join('subdivision', 'subdivision.subdivisioncd', '=', 'mgnregs.subdivisioncd')
            ->join('block_muni', 'block_muni.blockminicd', '=', 'mgnregs.blockminicd')
            ->join('month_tbl', 'month_tbl.month', '=', 'mgnregs.reporting_month')
            ->where('user_code', '=', auth()->user()->id)
            ->get();

        return view('users.reports.MGNREGS_report', compact('mgnregsReport'));
    }
}
