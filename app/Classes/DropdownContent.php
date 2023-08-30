<?php
namespace App\Classes;

use Illuminate\Support\Facades\DB;


class DropdownContent{


    public static function getDropdownContent()
    {
        $districts = DB::table('district')
                    ->orderBy('district')
                    ->get();
        $months = DB::table('month_tbl')->get();
        $years = DB::table('years')->get();

         return ['districts' => $districts, 'months' => $months , 'years' => $years];
    } 



}

