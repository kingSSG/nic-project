<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Classes\DropdownContent;
use RealRashid\SweetAlert\Facades\Alert;

class AdminDashboardController extends Controller
{
  
    public function index()
    {
        $approvedUsers = User::where('is_approved', '!=', 0)
            ->where('usertype', '!=', 'admin')
            ->get();
        $unapprovedUsers = User::where('is_approved', '=', 0)
            ->get();
        if (session()->has('success')) {
            Alert::success('Success!', session()->pull('success'));
        }
        if (session()->has('error')) {
            Alert::warning('Warning!', session()->pull('error'));
        }
        header('Cache-Control: no-store, private, no-cache, must-revalidate');
        header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);
        header('Pragma: public');
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        header('Expires: 0', false);
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Pragma: no-cache');
        return view('admin.dashboard', compact('approvedUsers', 'unapprovedUsers'));
    }

  
    public function edit(User $usermanagement)
    {
        $menus = DB::table('menu')
            ->orderBy('menu')
            ->pluck('menu', 'menu_cd');
        $rolesForUser = DB::table('user_permission')
            ->distinct()
            ->join('menu', 'menu.menu_cd', '=', 'user_permission.menu_cd')
            ->where('user_permission.user_cd', '=', $usermanagement->id)
            ->pluck('menu.menu');


        return view('admin.edit_registered_user', compact('usermanagement', 'menus', 'rolesForUser'));
    }


    public function update(Request $request, User $usermanagement)
    {

        $usermanagement->is_approved = true;
        $usermanagement->update();

        return redirect()->route('admin.usermanagement.index')->with('success', 'user approved');
    }


    public function destroy(User $usermanagement)
    {
    
    }
    public function updateRole(Request $request, User $user)
    {

        $menuCd = $request->post('role');

        $submenusWithReceivedMenuCd = DB::table('submenu')
                                        ->where('menu_cd', '=', $menuCd)
                                        ->first();

        if ($submenusWithReceivedMenuCd == null) {
            return redirect()->route('admin.usermanagement.index')->with('error', 'No submenus for selected menu');
        }


        $roleAlreadyGiven = DB::table('user_permission')
                                ->where('user_permission.user_cd', '=', $user->id)
                                ->where('user_permission.menu_cd', '=', $menuCd)
                                ->first();

        if ($roleAlreadyGiven) {
            return redirect()->route('admin.usermanagement.index')->with('error', 'Selected role already exists for the user');
        } else {

            $submenusWithReceivedMenuCd = DB::table('submenu')
                ->where('menu_cd', '=', $menuCd)
                ->pluck('submenu_cd');

            if ($submenusWithReceivedMenuCd) {

                $inserted = false;
                for ($i = 0; $i < count($submenusWithReceivedMenuCd); $i++) {

                    $inserted = DB::table('user_permission')
                        ->insert([
                            'user_cd' => $user->id,
                            'menu_cd' => $menuCd,
                            'submenu_cd' => $submenusWithReceivedMenuCd[$i],
                        ]);
                }
                if ($inserted) {

                    return redirect()->route('admin.usermanagement.index')->with('success', 'Role updated');
                } else {
                    return redirect()->route('admin.usermanagement.index')->with('error', 'Failed to update role');
                }
            }
        }
    }
    public function showExcelReportCritera(){
        $data=DropdownContent::getDropdownContent();
        $districts = $data['districts'];
        $months = $data['months'];
        $years = $data['years'];
        return view('admin.excel_report',compact('districts','months','years'));
    }
}
