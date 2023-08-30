<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class MenuController extends Controller
{

    public function getMenusAndSubmenus()
    {

        $userMenus = DB::table('user_permission')
                        ->select('menu.menu_cd', 'menu.menu')
                        ->distinct()
                        ->join('menu', 'menu.menu_cd', '=', 'user_permission.menu_cd')
                        ->where('user_permission.user_cd', '=', auth()->user()->id)
                        ->get();

        $submenus = array();
        foreach ($userMenus as $menu) {
            $submenus[$menu->menu_cd] = DB::table('user_permission')
                                            ->select('user_permission.submenu_cd', 'submenu.submenu', 'submenu.link')
                                            ->distinct()
                                            ->join('submenu', 'submenu.submenu_cd', '=', 'user_permission.submenu_cd')
                                            ->where('user_permission.menu_cd', '=', $menu->menu_cd)
                                            ->where('user_permission.user_cd', '=', auth()->user()->id)
                                            ->get();
        }
        return ['userMenus' => $userMenus, 'submenus' => $submenus];
    }
    
    



    public function show()
    {

        $data = $this->getMenusAndSubmenus();

        $userMenus = $data['userMenus'];
        $submenus = $data['submenus'];

        return view('users.userdashboard', compact('userMenus', 'submenus'));
    }





   


   

   

   

   
   
   
    
}
