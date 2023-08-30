<?php

namespace App\Http\Controllers\Anandadhara;



use Illuminate\Http\Request;
use App\Classes\DropdownContent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AnandadharaController extends Controller
{





    public function Anandadhara_Entry_Update()

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
        return view('users.entry_updates.Anandadhara_Entry_Update', compact('districts', 'months', 'years'));
    }





    //checking for available data
    public function checkAnandadharaData(Request $request)
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
        $data = DB::table('anandadhara')
            ->where($conditions)
            ->first();


        if ($data) {
            return response()->json($data);
        } else {
            return;
        }
    }



    //code for inserting data into tables
    public function insertAnandhara(Request $request)
    {
        $request->validate([
            'district' => 'exists:district,districtcd',
            'subdivision' => 'exists:subdivision,subdivisioncd',
            'month' => 'exists:month_tbl,month',
            'year' => 'exists:years,year',
            'municipality' => 'exists:block_muni,blockminicd',
            'tot_SHGs_formed' =>  ['required', 'integer', 'min:1'],
            'tot_SHGs_credit_linkage' => ['required', 'integer', 'min:1'],
        ]);



        $conditions = [
            "districtcd" => $request->post('district'),
            "subdivisioncd" => $request->post('subdivision'),
            "blockminicd" => $request->post('municipality'),
            "reporting_month" => $request->post('month'),
            "reporting_year" => $request->post('year'),
        ];



        $dataAlreadyExists = DB::table('anandadhara')
            ->where($conditions)
            ->first();


        if ($dataAlreadyExists) {

            if (
                $dataAlreadyExists->tot_SHGs_formed != $request->post('tot_SHGs_formed')
                || $dataAlreadyExists->tot_SHGs_credit_linkage != $request->post('tot_SHGs_credit_linkage')
            ) {
                $updated = DB::table('anandadhara')
                    ->where($conditions)
                    ->update([
                        "tot_SHGs_formed" => $request->post('tot_SHGs_formed'),
                        "tot_SHGs_credit_linkage" => $request->post('tot_SHGs_credit_linkage'),
                        "user_code" => auth()->user()->id,
                        "posted_date" => date("Y/m/d"),
                    ]);

                if ($updated) {

                    return redirect()->back()->with('success', 'Data updated successfully');
                }
            } else {
                return redirect()->back()->with('fail', 'No changes made to existing  data');
            }
        } else {
            $inserted =  DB::table('anandadhara')
                ->insert([
                    "districtcd" => $request->post('district'),
                    "subdivisioncd" => $request->post('subdivision'),
                    "blockminicd" => $request->post('municipality'),
                    "reporting_month" => $request->post('month'),
                    "reporting_year" => $request->post('year'),
                    "tot_SHGs_formed" => $request->post('tot_SHGs_formed'),
                    "tot_SHGs_credit_linkage" => $request->post('tot_SHGs_credit_linkage'),
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





    public function Anandadhara_report()
    {

        $anandadharaReport = DB::table('anandadhara')
            ->select('district.district', 'subdivision.subdivision', 'block_muni.blockmuni', 'month_tbl.month_name', 'anandadhara.reporting_year', 'anandadhara.tot_SHGs_formed', 'anandadhara.tot_SHGs_credit_linkage', 'anandadhara.posted_date', 'users.name')
            ->join('users', 'users.id', '=', 'anandadhara.user_code')
            ->join('district', 'district.districtcd', '=', 'anandadhara.districtcd')
            ->join('subdivision', 'subdivision.subdivisioncd', '=', 'anandadhara.subdivisioncd')
            ->join('block_muni', 'block_muni.blockminicd', '=', 'anandadhara.blockminicd')
            ->join('month_tbl', 'month_tbl.month', '=', 'anandadhara.reporting_month')
            //   ->where('reporting_month','=',$currentMonth)
            ->where('user_code', '=', auth()->user()->id)
            ->get();
        return view('users.reports.Anandadhara_report', compact('anandadharaReport'));
    }
}
