<?php

namespace App\Http\Controllers\KishanMandi;



use Illuminate\Http\Request;
use App\Classes\DropdownContent;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KishanMandiController extends Controller
{



    public function KM_entry_update()
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
        return view('users.entry_updates.KM_entry_update', compact('districts', 'months', 'years'));
    }

    public function checkKishanMandiData(Request $request)
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
        $data = DB::table('kishan_mandi')
            ->where($conditions)
            ->first();


        if ($data) {
            return response()->json($data);
        } else {
            return;
        }
    }


    public function insertKishanMandi(Request $request)
    {

        $request->validate([
            'district' => 'exists:district,districtcd',
            'subdivision' => 'exists:subdivision,subdivisioncd',
            'month' => 'exists:month_tbl,month',
            'year' => 'exists:years,year',
            'municipality' => 'exists:block_muni,blockminicd',
            'KM_operational' => 'required',
            'KM_sanctioned' => ['required', 'integer', 'min:1'],
        ]);

        $conditions = [
            "districtcd" => $request->post('district'),
            "subdivisioncd" => $request->post('subdivision'),
            "blockminicd" => $request->post('municipality'),
            "reporting_month" => $request->post('month'),
            "reporting_year" => $request->post('year'),

        ];

        $dataAlreadyExists = DB::table('kishan_mandi')
            ->where($conditions)
            ->first();

        if ($dataAlreadyExists) {

            if (
                $dataAlreadyExists->KM_operational != $request->post('KM_operational')
                || $dataAlreadyExists->KM_sanctioned != $request->post('KM_sanctioned')
            ) {

                $updated = DB::table('kishan_mandi')
                    ->where($conditions)
                    ->update([
                        "KM_operational" => $request->post('KM_operational'),
                        "KM_sanctioned" => $request->post('KM_sanctioned'),
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
            $inserted =  DB::table('kishan_mandi')
                ->insert([
                    "districtcd" => $request->post('district'),
                    "subdivisioncd" => $request->post('subdivision'),
                    "blockminicd" => $request->post('municipality'),
                    "reporting_month" => $request->post('month'),
                    "reporting_year" => $request->post('year'),
                    "KM_operational" => $request->post('KM_operational'),
                    "KM_sanctioned" => $request->post('KM_sanctioned'),
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




    public function KM_report()
    {
        $kmReport = DB::table('kishan_mandi')
            ->select('district.district', 'subdivision.subdivision', 'block_muni.blockmuni', 'month_tbl.month_name', 'kishan_mandi.reporting_year', 'kishan_mandi.KM_operational', 'kishan_mandi.KM_sanctioned', 'kishan_mandi.posted_date', 'users.name')
            ->join('users', 'users.id', '=', 'kishan_mandi.user_code')
            ->join('district', 'district.districtcd', '=', 'kishan_mandi.districtcd')
            ->join('subdivision', 'subdivision.subdivisioncd', '=', 'kishan_mandi.subdivisioncd')
            ->join('block_muni', 'block_muni.blockminicd', '=', 'kishan_mandi.blockminicd')
            ->join('month_tbl', 'month_tbl.month', '=', 'kishan_mandi.reporting_month')
            ->where('user_code', '=', auth()->user()->id)
            ->get();

        return view('users.reports.KM_report', compact('kmReport'));
    }
}
