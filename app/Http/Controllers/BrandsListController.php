<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BrandsListController extends Controller
{
   public function index(Request $request)
   {
       return view('brands.list');
   }

}
