<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    // รายการกิจกรรมทั้งหมด
    public function index()
    {
        $activities = Activity::withCount('registrations')
            ->orderBy('activity_date')
            ->get();

        return view('activities.index', compact('activities'));
    }

    // รายละเอียดกิจกรรม
    public function show(Activity $activity)
    {
        $isRegistered = false;
        if (Auth::check()) {
            $isRegistered = Registration::where('user_id', Auth::id())
                ->where('activity_id', $activity->id)
                ->exists();
        }

        return view('activities.show', compact('activity', 'isRegistered'));
    }

    // ลงทะเบียนกิจกรรม
    public function register(Activity $activity)
    {
        // ตรวจสอบว่าลงทะเบียนซ้ำหรือไม่
        $alreadyRegistered = Registration::where('user_id', Auth::id())
            ->where('activity_id', $activity->id)
            ->exists();

        if ($alreadyRegistered) {
            return back()->with('error', '❌ คุณลงทะเบียนกิจกรรมนี้ไปแล้ว');
        }

        // ตรวจสอบที่นั่ง
        if ($activity->isFullyBooked()) {
            return back()->with('error', '❌ กิจกรรมนี้เต็มแล้ว ไม่สามารถลงทะเบียนได้');
        }

        Registration::create([
            'user_id' => Auth::id(),
            'activity_id' => $activity->id,
            'registered_at' => now(),
        ]);

        return back()->with('success', '✅ ลงทะเบียนกิจกรรมสำเร็จ!');
    }

    // ยกเลิกการลงทะเบียน
    public function cancel(Activity $activity)
    {
        Registration::where('user_id', Auth::id())
            ->where('activity_id', $activity->id)
            ->delete();

        return back()->with('success', '✅ ยกเลิกการลงทะเบียนสำเร็จ');
    }
}
