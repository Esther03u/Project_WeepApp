<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::withCount('registrations')->orderBy('activity_date')->get();
        return view('admin.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('admin.activities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'activity_date'    => 'required|date|after:now',
            'location'         => 'required|string|max:255',
            'max_participants' => 'required|integer|min:1',
        ], [
            'title.required'            => 'กรุณาใส่ชื่อกิจกรรม',
            'activity_date.required'    => 'กรุณาเลือกวันที่กิจกรรม',
            'activity_date.after'       => 'วันที่กิจกรรมต้องเป็นวันในอนาคต',
            'location.required'         => 'กรุณาใส่สถานที่จัดกิจกรรม',
            'max_participants.required' => 'กรุณาใส่จำนวนผู้เข้าร่วมสูงสุด',
            'max_participants.min'      => 'จำนวนผู้เข้าร่วมต้องมากกว่า 0',
        ]);

        Activity::create($request->all());
        return redirect()->route('admin.activities.index')->with('success', '✅ สร้างกิจกรรมสำเร็จ!');
    }

    public function edit(Activity $activity)
    {
        return view('admin.activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'activity_date'    => 'required|date',
            'location'         => 'required|string|max:255',
            'max_participants' => 'required|integer|min:1',
        ], [
            'title.required'            => 'กรุณาใส่ชื่อกิจกรรม',
            'activity_date.required'    => 'กรุณาเลือกวันที่กิจกรรม',
            'location.required'         => 'กรุณาใส่สถานที่จัดกิจกรรม',
            'max_participants.required' => 'กรุณาใส่จำนวนผู้เข้าร่วมสูงสุด',
        ]);

        $activity->update($request->all());
        return redirect()->route('admin.activities.index')->with('success', '✅ แก้ไขกิจกรรมสำเร็จ!');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('admin.activities.index')->with('success', '✅ ลบกิจกรรมสำเร็จ!');
    }
}
