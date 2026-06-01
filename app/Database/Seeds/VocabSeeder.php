<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class VocabSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'word'        => 'Framework',
                'type'        => 'n',
                'definition'  => 'Khung phần mềm, cấu trúc hỗ trợ phát triển ứng dụng',
                'example'     => 'CodeIgniter is a powerful PHP framework.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'word'        => 'Decoupled',
                'type'        => 'adj',
                'definition'  => 'Tách rời, không phụ thuộc vào nhau (kiến trúc hệ thống)',
                'example'     => 'We are using a decoupled architecture with CI4 and Next.js.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'word'        => 'Repository',
                'type'        => 'n',
                'definition'  => 'Kho chứa dữ liệu, nơi lưu trữ mã nguồn (Git)',
                'example'     => 'Don\'t forget to push your code to the remote repository.',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('vocabularies')->insertBatch($data);
    }
}
