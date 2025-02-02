<?php
// app/Http/Controllers/GetController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetController extends Controller
{
    public function apply() {
        return view('apply_to');
    }
}