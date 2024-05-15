<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'full_name' => 'k_admin',
            'phone_num' => '0123456789',
            'ic' => '111122223333',
            'email' => 'admin@argon.com',
            'role' => 'k_admin',
            'gender' => 'male',
            'password' => bcrypt('1234')
        ]);
        DB::table('users')->insert([
            'full_name' => 'staff',
            'phone_num' => '0122233112',
            'ic' => '222233334444',
            'email' => 'staff@argon.com',
            'role' => 'staff',
            'gender' => 'male',
            'password' => bcrypt('1234')
        ]);
        DB::table('users')->insert([
            'full_name' => 'parent',
            'phone_num' => '0123456781',
            'email' => 'parent@argon.com',
            'ic' => '444455556666',
            'role' => 'parent',
            'gender' => 'male',
            'password' => bcrypt('1234')
        ]);
        DB::table('users')->insert([
            'full_name' => 'parent',
            'phone_num' => '0123456782',
            'email' => 'parent2@argon.com',
            'ic' => '555555556666',
            'role' => 'parent',
            'gender' => 'male',
            'password' => bcrypt('1234')
        ]);
        DB::table('users')->insert([
            'full_name' => 'MUIP',
            'phone_num' => '0124563779',
            'ic' => '777788889999',
            'email' => 'muip@argon.com',
            'role' => 'muip',
            'gender' => 'male',
            'password' => bcrypt('1234')
        ]);

        DB::table('parent_details')->insert([
            'parent_ID' => '1',
            'user_ID' => '3',
            'created_at' => '2021-05-06 11:25:24'
        ]);
        DB::table('parent_details')->insert([
            'parent_ID' => '2',
            'user_ID' => '4',
            'created_at' => '2021-05-07 11:25:24'
        ]);

        // DB::table('student_applications')->insert([
        //     'student_ID' => '1',
        //     'parent_ID' => '1',
        //     'full_name' => 'Ali',
        //     'ic' => '111111111111',
        //     'gender' => 'male',
        //     'date_birth' => '2000-01-01',
        //     'address' => 'No 1, Jalan 1, Taman 1',
        //     'status' => 'applied',
        //     'reason' => 'New student',
        //     'created_at' => '2021-05-06 11:25:24',
        // ]);
        // DB::table('student_applications')->insert([
        //     'student_ID' => '2',
        //     'parent_ID' => '1',
        //     'full_name' => 'Abu Bin Ali',
        //     'ic' => '222222222222',
        //     'gender' => 'male',
        //     'date_birth' => '2000-01-01',
        //     'address' => 'No 1, Jalan Besar, Taman 1',
        //     'status' => 'applied',
        //     'reason' => 'New student',
        //     'created_at' => '2021-05-07 11:25:24',
        // ]);
        // DB::table('student_applications')->insert([
        //     'student_ID' => '3',
        //     'parent_ID' => '2',
        //     'full_name' => 'Abdullah Bin Mat Sari',
        //     'ic' => '333333333333',
        //     'gender' => 'male',
        //     'date_birth' => '2000-01-01',
        //     'address' => 'No 2, Jalan 1, Taman 3',
        //     'status' => 'accepted',
        //     'reason' => 'New student',
        //     'created_at' => '2021-05-08 11:25:24',
        // ]);

        // DB::table('results')->insert([
        //     'student_id' => '1',
        //     'stu_ic' => '111111111111',
        //     'exam_center_id' => '1',
        //     'year' => '2021',
        //     'grade_solat' => 'A',
        //     'grade_pchi' => 'A',
        //     'grade_quran' => 'C',
        //     'grade_jawi' => 'A',
        //     'grade_sirah' => 'B',
        //     'grade_syariah' => 'A',
        //     'grade_adab' => 'A',
        //     'grade_lughah' => 'A',
        //     'created_at' => '2021-05-06 11:25:24',
        // ]);
        // DB::table('results')->insert([
        //     'student_id' => '2',
        //     'stu_ic' => '222222222222',
        //     'exam_center_id' => '2',
        //     'year' => '2021',
        //     'grade_solat' => 'A',
        //     'grade_pchi' => 'A',
        //     'grade_quran' => 'C',
        //     'grade_jawi' => 'A',
        //     'grade_sirah' => 'B',
        //     'grade_syariah' => 'A',
        //     'grade_adab' => 'A',
        //     'grade_lughah' => 'A',
        //     'created_at' => '2021-05-06 11:25:24',
        // ]);
        // DB::table('results')->insert([
        //     'student_id' => '3',
        //     'stu_ic' => '333333333333',
        //     'exam_center_id' => '3',
        //     'year' => '2021',
        //     'grade_solat' => 'A',
        //     'grade_pchi' => 'B',
        //     'grade_quran' => 'A',
        //     'grade_jawi' => 'A',
        //     'grade_sirah' => 'A',
        //     'grade_syariah' => 'A',
        //     'grade_adab' => 'A',
        //     'grade_lughah' => 'A',
        //     'created_at' => '2021-05-06 11:25:24',
        // ]);

        $this->registerResultReference();
    }

    public function registerResultReference()
    {
        $datas = [
            //course
            [
                'category' => 'course',
                'code' => 'UPKK01',
                'value' => 'Bidang Al Quran',
            ],
            [
                'category' => 'course',
                'code' => 'UPKK02',
                'value' => 'Ulum Syariah',
            ],
            [
                'category' => 'course',
                'code' => 'UPKK03',
                'value' => 'Sirah',
            ],
            [
                'category' => 'course',
                'code' => 'UPKK04',
                'value' => 'Adab',
            ],
            [
                'category' => 'course',
                'code' => 'UPKK05',
                'value' => 'Pelajaran Jawi dan Khat',
            ],
            [
                'category' => 'course',
                'code' => 'UPKK06',
                'value' => 'Lughah Al-Quran',
            ],
            [
                'category' => 'course',
                'code' => 'UPKK07',
                'value' => 'Penghayatan Cara Hidup Islam (PCHI)',
            ],
            [
                'category' => 'course',
                'code' => 'UPKK08',
                'value' => 'Amali Solat',
            ],
            //Exam Center
            [
                'category' => 'exam_center',
                'code' => '1',
                'value' => 'INTEGRATED ISLAMIC SCHOOL',
            ],
            [
                'category' => 'exam_center',
                'code' => '2',
                'value' => 'KAFA AKADEMI TAHFIZ ILHAM',
            ],
            [
                'category' => 'exam_center',
                'code' => '3',
                'value' => 'KAFA AT-TAUFIQIAH',
            ],
            [
                'category' => 'exam_center',
                'code' => '4',
                'value' => 'KAFA AL-HAFIZIN',
            ],
            [
                'category' => 'exam_center',
                'code' => '5',
                'value' => 'KAFA NUR AIN',
            ],
            [
                'category' => 'exam_center',
                'code' => '6',
                'value' => 'MADRASAH UMAMAH HALIMI',
            ],
            [
                'category' => 'exam_center',
                'code' => '7',
                'value' => 'SEKOLAH RENDAH TAHFIZ NEGERI PAHANG',
            ],
            [
                'category' => 'exam_center',
                'code' => '8',
                'value' => 'SEKOLAH MENENGAH AGAMA AL-IHSAN',
            ],
            [
                'category' => 'exam_center',
                'code' => '9',
                'value' => 'SEKOLAH MENENGAH AGAMA BUKIT IBAM',
            ],

        ];

        foreach ($datas as $data) {
            DB::table('result_references')->insert($data);
        }
    }
}
