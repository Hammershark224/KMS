<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


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
        DB::table('users')->insert([
            'full_name' => 'parent3',
            'phone_num' => '01133633995',
            'email' => 'parent3@argon.com',
            'ic' => '5555444556666',
            'role' => 'parent',
            'gender' => 'female',
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
        DB::table('parent_details')->insert([
            'parent_ID' => '3',
            'user_ID' => '6',
            'created_at' => '2021-06-08 11:25:24'
        ]);

        DB::table('student_applications')->insert([
            'student_ID' => '1',
            'parent_ID' => '1',
            'full_name' => 'Ali',
            'ic' => '111111111111',
            'gender' => 'male',
            'date_birth' => '2000-01-01',
            'address' => 'No 1, Jalan 1, Taman 1',
            'status' => 'applied',
            'reason' => 'New student',
            'created_at' => '2021-05-06 11:25:24',
        ]);
        DB::table('student_applications')->insert([
            'student_ID' => '2',
            'parent_ID' => '1',
            'full_name' => 'Abu Bin Ali',
            'ic' => '222222222222',
            'gender' => 'male',
            'date_birth' => '2000-01-01',
            'address' => 'No 1, Jalan Besar, Taman 1',
            'status' => 'applied',
            'reason' => 'New student',
            'created_at' => '2021-05-07 11:25:24',
        ]);
        DB::table('student_applications')->insert([
            'student_ID' => '3',
            'parent_ID' => '2',
            'full_name' => 'Abdullah Bin Mat Sari',
            'ic' => '333333333333',
            'gender' => 'male',
            'date_birth' => '2000-01-01',
            'address' => 'No 2, Jalan 1, Taman 3',
            'status' => 'accepted',
            'reason' => 'New student',
            'created_at' => '2021-05-08 11:25:24',
        ]);
        DB::table('student_applications')->insert([
            'student_ID' => '4',
            'parent_ID' => '3',
            'full_name' => 'Ali Bin Mat',
            'ic' => '444444444444',
            'gender' => 'male',
            'date_birth' => '2001-12-25',
            'address' => 'No 2, Jalan 1, Taman 3',
            'status' => 'accepted',
            'reason' => 'New student',
            'created_at' => '2021-06-08 11:25:24',
        ]);
        DB::table('student_applications')->insert([
            'student_ID' => '5',
            'parent_ID' => '3',
            'full_name' => 'Wafi Bin Muhammad',
            'ic' => '555555555555',
            'gender' => 'male',
            'date_birth' => '2001-12-25',
            'address' => 'No 2, Jalan 1, Taman 3',
            'status' => 'accepted',
            'reason' => 'New student',
            'created_at' => '2021-06-08 11:25:24',
        ]);
        DB::table('results')->insert([
            'student_id' => '1',
            'stu_ic' => '111111111111',
            'exam_center_id' => '1',
            'year' => '2021',
            'grade_solat' => 'A',
            'grade_pchi' => 'A',
            'grade_quran' => 'C',
            'grade_jawi' => 'A',
            'grade_sirah' => 'B',
            'grade_syariah' => 'A',
            'grade_adab' => 'A',
            'grade_lughah' => 'A',
            'created_at' => '2021-05-06 11:25:24',
        ]);
        DB::table('results')->insert([
            'student_id' => '2',
            'stu_ic' => '222222222222',
            'exam_center_id' => '2',
            'year' => '2021',
            'grade_solat' => 'A',
            'grade_pchi' => 'A',
            'grade_quran' => 'C',
            'grade_jawi' => 'A',
            'grade_sirah' => 'B',
            'grade_syariah' => 'A',
            'grade_adab' => 'A',
            'grade_lughah' => 'A',
            'created_at' => '2021-05-06 11:25:24',
        ]);
        DB::table('results')->insert([
            'student_id' => '3',
            'stu_ic' => '333333333333',
            'exam_center_id' => '3',
            'year' => '2021',
            'grade_solat' => 'A',
            'grade_pchi' => 'B',
            'grade_quran' => 'A',
            'grade_jawi' => 'A',
            'grade_sirah' => 'A',
            'grade_syariah' => 'A',
            'grade_adab' => 'A',
            'grade_lughah' => 'A',
            'created_at' => '2021-05-06 11:25:24',
        ]);
        $this->registerResultReference();

                // Past activities
                DB::table('activity')->insert([
                    'activityID' => '1',
                    'activityName' => 'Past Writing Competition',
                    'activityDetails' => 'This is a past writing competition for KAFA students.',
                    'activityLocation' => 'School Hall',
                    'activityDate' => Carbon::parse('2024-06-07'),
                    'startTime' => '12:00:00',
                    'endTime' => '14:00:00',
                    'activityCapacity' => 10,
                    'availableSlot' => 8,
                    'created_at' => '2021-06-05 11:25:24',
                    'updated_at' => '2021-06-05 11:25:24',
                ]);
        
                DB::table('activity')->insert([
                    'activityID' => '2',
                    'activityName' => 'Past Singing Competition',
                    'activityDetails' => 'This is a past singing competition for KAFA students.',
                    'activityLocation' => 'School Hall',
                    'activityDate' => Carbon::parse('2024-06-06'),
                    'startTime' => '10:00:00',
                    'endTime' => '12:00:00',
                    'activityCapacity' => 5,
                    'availableSlot' => 2,
                    'created_at' => '2021-06-05 11:25:24',
                    'updated_at' => '2021-06-05 11:25:24',
                ]);
        
                // Future activities
                DB::table('activity')->insert([
                    'activityID' => '3',
                    'activityName' => 'Writing Competition',
                    'activityDetails' => 'This is an upcoming writing competition for KAFA students.',
                    'activityLocation' => 'School Hall',
                    'activityDate' => Carbon::parse('2024-06-14'),
                    'startTime' => '12:00:00',
                    'endTime' => '14:00:00',
                    'activityCapacity' => 10,
                    'availableSlot' => 8,
                    'created_at' => '2021-06-05 11:25:24',
                    'updated_at' => '2021-06-05 11:25:24',
                ]);
        
                DB::table('activity')->insert([
                    'activityID' => '4',
                    'activityName' => 'Singing Competition',
                    'activityDetails' => 'This is an upcoming singing competition for KAFA students.',
                    'activityLocation' => 'School Hall',
                    'activityDate' => Carbon::parse('2024-06-12'),
                    'startTime' => '10:00:00',
                    'endTime' => '12:00:00',
                    'activityCapacity' => 8,
                    'availableSlot' => 5,
                    'created_at' => '2021-06-05 11:25:24',
                    'updated_at' => '2021-06-05 11:25:24',
                ]);
        
                DB::table('activity')->insert([
                    'activityID' => '5',
                    'activityName' => 'Upcoming Dance Competition',
                    'activityDetails' => 'This is an upcoming dance competition for KAFA students.',
                    'activityLocation' => 'School Hall',
                    'activityDate' => Carbon::parse('2024-08-14'),
                    'startTime' => '14:00:00',
                    'endTime' => '16:00:00',
                    'activityCapacity' => 6,
                    'availableSlot' => 1,
                    'created_at' => '2021-06-05 11:25:24',
                    'updated_at' => '2021-06-05 11:25:24',
                ]);

                $this->participationReference();  


                // Seed bulletin table
                 DB::table('bulletin')->insert([
                 'bulletinId' => '1',
                 'bulletinTitle' => 'Perubahan Jadual Pengajaran Sempena Cuti Sekolah',
                 'publishDate' => Carbon::now(),
                 'bulletinDetails' => 'Salam sejahtera kepada semua warga KAFA,

    Diberitahu bahawa terdapat perubahan jadual pengajaran sempena cuti sekolah yang akan berlaku. Berikut adalah butiran perubahan tersebut:

    Tarikh: 20 Februari 2022 (Ahad)
    Tempat: Dewan KAFA Utama
    Masa: 8:00 pagi - 12:00 tengah hari

    Sila berikan perhatian kepada semua guru dan pelajar untuk hadir tepat pada masa yang ditetapkan. Terima kasih.

    Sekian, terima kasih.',
                 'createdBy' => 1,
                 'createdAt' => Carbon::now(),
                 'updatedAt' => Carbon::now(),
                ]);

                DB::table('bulletin')->insert([
                    'bulletinId' => '2',
                    'bulletinTitle' => 'Important Announcement: Upcoming School Event',
                    'publishDate' => Carbon::now(),
                    'bulletinDetails' => 'Assalamualaikum w.b.t. kepada warga KAFA,

    Berikut adalah panduan langkah demi langkah untuk memohon bantuan kelas KAFA oleh Majlis Ugama Islam dan Adat Resam Melayu Pahang (MUIP):

    1. Sila log masuk ke portal permohonan bantuan kelas KAFA di laman web rasmi MUIP.
    2. Isi borang permohonan dengan maklumat yang diperlukan seperti butiran sekolah, jumlah pelajar, dan sebagainya.
    3. Sertakan dokumen sokongan yang diperlukan seperti surat pengesahan dari pihak sekolah atau jawatankuasa pengurusan KAFA.
    4. Mohon semakan dokumen dan pastikan semua maklumat lengkap dan betul sebelum menghantar permohonan.
    5. Selepas penghantaran, tunggu notifikasi daripada MUIP mengenai status permohonan anda.

    Sekiranya terdapat sebarang pertanyaan atau bantuan tambahan, sila hubungi pejabat MUIP.

    Terima kasih.

    Wassalam,',
                    'createdBy' => 5,
                    'createdAt' => Carbon::now(),
                    'updatedAt' => Carbon::now(),
                   ]);

                   DB::table('publish')->insert([
                    'bulletinId' => 1, 
                    'publishTo' => 2, 
                    'createdAt' => Carbon::now(),
                    'updatedAt' => Carbon::now(),
                ]);
                   DB::table('publish')->insert([
                    'bulletinId' => 1, 
                    'publishTo' => 4, 
                    'createdAt' => Carbon::now(),
                    'updatedAt' => Carbon::now(),
                ]);

                  DB::table('publish')->insert([
                    'bulletinId' => 2, 
                    'publishTo' => 4, 
                    'createdAt' => Carbon::now(),
                    'updatedAt' => Carbon::now(),
                ]);
       
    }

    public function participationReference()
    {
        $datas = [
            [
                'activityID' => 1,
                'student_id' => 1,
                'created_at' => Carbon::parse('2022-06-09 12:00:00'),
            ],
            [
                'activityID' => 1,
                'student_id' => 2,
                'created_at' => Carbon::parse('2022-06-09 12:00:00'),
            ],
            [
                'activityID' => 2,
                'student_id' => 3,
                'created_at' => Carbon::parse('2022-06-09 10:00:00'),
            ],
            [
                'activityID' => 2,
                'student_id' => 1,
                'created_at' => Carbon::parse('2024-06-09 10:00:00'),
            ],
            [
                'activityID' => 2,
                'student_id' => 4,
                'created_at' => Carbon::parse('2024-06-09 10:00:00'),
            ],
            [
                'activityID' => 3,
                'student_id' => 1,
                'created_at' => Carbon::parse('2022-06-09 12:00:00'),
            ],
            [
                'activityID' => 3,
                'student_id' => 2,
                'created_at' => Carbon::parse('2022-06-09 12:00:00'),
            ],
            [
                'activityID' => 4,
                'student_id' => 1,
                'created_at' => Carbon::parse('2024-06-09 10:00:00'),
            ],
            [
                'activityID' => 4,
                'student_id' => 4,
                'created_at' => Carbon::parse('2024-06-09 10:00:00'),
            ],
            [
                'activityID' => 4,
                'student_id' => 5,
                'created_at' => Carbon::parse('2024-06-09 10:00:00'),
            ],
            [
                'activityID' => 5,
                'student_id' => 1,
                'created_at' => Carbon::parse('2024-06-09 14:00:00'),
            ],
            [
                'activityID' => 5,
                'student_id' => 2,
                'created_at' => Carbon::parse('2024-06-09 14:00:00'),
            ],
            [
                'activityID' => 5,
                'student_id' => 3,
                'created_at' => Carbon::parse('2024-06-09 14:00:00'),
            ],
            [
                'activityID' => 5,
                'student_id' => 4,
                'created_at' => Carbon::parse('2024-06-09 10:00:00'),
            ],
            [
                'activityID' => 5,
                'student_id' => 5,
                'created_at' => Carbon::parse('2024-06-09 14:00:00'),
            ]
            ];
            DB::table('participation')->insert($datas);
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
