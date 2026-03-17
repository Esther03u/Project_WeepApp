<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;

class RegistrationController extends Controller
{
    public function index(Activity $activity)
    {
        $registrations = $activity->registrations()->with('user')->latest()->get();
        return view('admin.registrations.index', compact('activity', 'registrations'));
    }
}
