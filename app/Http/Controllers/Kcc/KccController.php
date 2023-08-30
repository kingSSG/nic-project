<?php

namespace App\Http\Controllers\Kcc;


use Illuminate\Http\Request;
use App\Classes\DropdownContent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KccController extends Controller
{

    public function KCC_entry_update()
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
        return view('users.entry_updates.Kcc_entry_update', compact('districts', 'months', 'years'));
    }


    //checking for available data
    public function checkKccData(Request $request)
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
        $data = DB::table('kishan_credit_card')
            ->where($conditions)
            ->first();


        if ($data) {
            return response()->json($data);
        } else {
            return;
        }
    }



    //code for inserting data into tables
    public function insertToKccTable(Request $request)
    {


        $request->validate([
            'district' => 'exists:district,districtcd',
            'subdivision' => 'exists:subdivision,subdivisioncd',
            'month' => 'exists:month_tbl,month',
            'year' => 'exists:years,year',
            'municipality' => 'exists:block_muni,blockminicd',
            'target' => ['required', 'integer', 'min:1'],
            'kcc_sponsored' => ['required', 'numeric', 'min:1'],
            'kcc_sanctioned' => ['required', 'integer', 'min:1'],
        ]);

        $percentageSponsored = number_format(($request->post('kcc_sponsored') * 100) / $request->post('target'), 2);



        $conditions = [
            "districtcd" => $request->post('district'),
            "subdivisioncd" => $request->post('subdivision'),
            "blockminicd" => $request->post('municipality'),
            "reporting_month" => $request->post('month'),
            "reporting_year" => $request->post('year'),

        ];

        $percentageSponsored = number_format(($request->post('kcc_sponsored') * 100) / $request->post('target'), 4);

        $dataAlreadyExists = DB::table('kishan_credit_card')
            ->where($conditions)
            ->first();
        if ($dataAlreadyExists) {
            if (
                $dataAlreadyExists->KCC_target != $request->post('target')
                || $dataAlreadyExists->KCC_sponsored != $request->post('kcc_sponsored')
                || $dataAlreadyExists->KCC_sanctioned != $request->post('kcc_sanctioned')
                || $dataAlreadyExists->Percentage_sponsored != $percentageSponsored
            ) {

                $updated = DB::table('kishan_credit_card')
                    ->where($conditions)
                    ->update([
                        "KCC_target" => $request->post('target'),
                        "KCC_sponsored" => $request->post('kcc_sponsored'),
                        "KCC_sanctioned" => $request->post('kcc_sanctioned'),
                        "Percentage_sponsored" => $percentageSponsored,
                        "user_code" => auth()->user()->id,
                        "posted_date" => date("Y/m/d"),
                    ]);
                if ($updated) {
                    return redirect()->back()->with('success', 'Data updated successfully');
                } 
            } else {
                return redirect()->back()->with('fail', 'No changes  made to existing  data');
            }
        } else {


            $inserted =  DB::table('kishan_credit_card')
                ->insert([
                    "districtcd" => $request->post('district'),
                    "subdivisioncd" => $request->post('subdivision'),
                    "blockminicd" => $request->post('municipality'),
                    "reporting_month" => $request->post('month'),
                    "reporting_year" => $request->post('year'),
                    "KCC_target" => $request->post('target'),
                    "KCC_sponsored" => $request->post('kcc_sponsored'),
                    "KCC_sanctioned" => $request->post('kcc_sanctioned'),
                    "Percentage_sponsored" => $percentageSponsored,
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



    public function KCC_Report()
    {

        $kccReport = DB::table('kishan_credit_card')
            ->select('district.district', 'subdivision.subdivision', 'block_muni.blockmuni', 'month_tbl.month_name', 'kishan_credit_card.reporting_year', 'kishan_credit_card.KCC_target', 'kishan_credit_card.KCC_sponsored', 'kishan_credit_card.KCC_sanctioned', 'kishan_credit_card.Percentage_sponsored', 'kishan_credit_card.posted_date', 'users.name')
            ->join('users', 'users.id', '=', 'kishan_credit_card.user_code')
            ->join('district', 'district.districtcd', '=', 'kishan_credit_card.districtcd')
            ->join('subdivision', 'subdivision.subdivisioncd', '=', 'kishan_credit_card.subdivisioncd')
            ->join('block_muni', 'block_muni.blockminicd', '=', 'kishan_credit_card.blockminicd')
            ->join('month_tbl', 'month_tbl.month', '=', 'kishan_credit_card.reporting_month')
            ->where('user_code', '=', auth()->user()->id)
            ->get();




        //  dd($kccReport);
        return view('users.reports.KCC_Report', compact('kccReport'));
    }
}
