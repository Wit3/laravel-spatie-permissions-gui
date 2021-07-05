<?php
namespace Wit3\LaravelSpatiePermissionsGui\Http\Controllers;

use Illuminate\Routing\Controller;

class PermissionController extends Controller
{
    public function index()
    {
        return view('spatie-permissions-gui::permissions.index');
    }
}
