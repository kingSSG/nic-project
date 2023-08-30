<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DropdownController extends Controller
{
    public function getSubdivision(Request $request)
    {  
        
        $districtcd = $request->post('districtId');
        $subdivisions = DB::table('subdivision')
                        ->where('districtcd', $districtcd)
                        ->orderBy('subdivision')
                        ->pluck('subdivision.subdivision', 'subdivision.subdivisioncd');
             
        return response()->json($subdivisions);
        

    }

    public function getMunicipality(Request $request)
    {
        $subdivisioncd = $request->post('subdivisionId');
        $municipalities = DB::table('block_muni')
            ->where('subdivisioncd', $subdivisioncd)
            ->orderBy('blockmuni')
            ->pluck('blockmuni', 'blockminicd');

        return response()->json($municipalities);
    }

}
