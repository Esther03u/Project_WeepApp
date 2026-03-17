<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. สร้าง Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@email.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. สร้าง User ทั่วไป
        User::create([
            'name' => 'Test User',
            'email' => 'user@email.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // 3. สร้างตัวอย่างกิจกรรม
        Activity::create([
            'title' => 'สัมมนาวิชาการ Introduction to Laravel 11',
            'description' => "การบรรยายพื้นฐานการใช้งาน Laravel 11 เฟรมเวิร์ก PHP ยอดนิยม\nเหมาะสำหรับผู้เริ่มต้นเขียนโปรแกรมเว็บแอปพลิเคชัน\n- เรียนรู้ Routing, Controller, Blade\n- การใช้งาน Laravel Breeze\n- พื้นฐาน Eloquent ORM",
            'activity_date' => now()->addDays(5)->setHour(9)->setMinute(0),
            'location' => 'ห้องปฏิบัติการคอมพิวเตอร์ CS-101',
            'max_participants' => 30,
        ]);

        Activity::create([
            'title' => 'อบรมเชิงปฏิบัติการ (Workshop) React + Next.js',
            'description' => "เวิร์กชอปสร้างเว็บด้วย Next.js เบื้องต้นสำหรับนักศึกษาชั้นปีที่ 3-4",
            'activity_date' => now()->addDays(10)->setHour(13)->setMinute(30),
            'location' => 'ห้องประชุมใหญ่ อาคาร IT',
            'max_participants' => 50,
        ]);

        Activity::create([
            'title' => 'กิจกรรมพบปะรุ่นพี่ศิษย์เก่า (Alumni Meetup)',
            'description' => "รับฟังประสบการณ์และแนวทางการทำงานในสายอาชีพ Developer จากรุ่นพี่ที่จบไปแล้ว",
            'activity_date' => now()->addDays(14)->setHour(16)->setMinute(0),
            'location' => 'ลานกิจกรรมหน้าคณะ',
            'max_participants' => 100,
        ]);

        // กิจกรรมที่ที่นั่งเต็มแล้ว (ทดสอบ Edge Case)
        $fullActivity = Activity::create([
            'title' => 'พี่สอนน้อง: ติวโจทย์ Algorithm',
            'description' => 'ติวพิเศษก่อนสอบกลางภาควิชา Data Structures and Algorithms',
            'activity_date' => now()->addDays(2)->setHour(17)->setMinute(0),
            'location' => 'ห้องสมุด โซน Study Room',
            'max_participants' => 5,
        ]);

        // สร้าง user จำนวนหนึ่งและให้ลงทะเบียนกิจกรรมที่เต็มแล้วเต็มโควต้า
        for ($i = 1; $i <= 5; $i++) {
            $student = User::create([
                'name' => "Student $i",
                'email' => "student$i@email.com",
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);
            
            \App\Models\Registration::create([
                'user_id' => $student->id,
                'activity_id' => $fullActivity->id,
                'registered_at' => now(),
            ]);
        }
    }
}
