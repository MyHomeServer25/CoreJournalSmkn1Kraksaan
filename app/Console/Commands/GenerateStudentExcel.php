<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Faker\Factory as Faker;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Storage;

class GenerateStudentExcel extends Command
{
    protected $signature = 'generate:student-excel {count=4}';
    protected $description = 'Generate a large Excel file with fake student data for testing import';

    public function handle()
    {
        $faker = Faker::create('id_ID');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Buat header sesuai format yang diharapkan
        $sheet->setCellValue('A1', 'nisn');
        $sheet->setCellValue('B1', 'name');
        $sheet->setCellValue('C1', 'email');

        // Ambil jumlah data dari argument command (default: 25)
        $count = (int) $this->argument('count');

        // Generate data faker sebanyak jumlah yang diinginkan
        for ($i = 2; $i <= $count + 1; $i++) {
            // Menghasilkan NISN acak (panjang 10 digit)
            $nisn = $faker->numerify('##########'); // Format 10 digit angka (contoh: 1234567890)
            
            // Pastikan bahwa data tidak mengandung karakter yang menyebabkan formula
            $name = $faker->name;
            $email = $faker->unique()->email;

            // Menyaring data agar tidak ada karakter yang salah seperti "=" yang memulai formula
            if (strpos($name, '=') === 0) {
                $name = "'" . $name; // Menambahkan tanda kutip agar Excel menganggapnya sebagai teks
            }
            if (strpos($email, '=') === 0) {
                $email = "'" . $email; // Menambahkan tanda kutip agar Excel menganggapnya sebagai teks
            }

            // Isi data pada setiap baris
            $sheet->setCellValue("A$i", $nisn);
            $sheet->setCellValue("B$i", $name);
            $sheet->setCellValue("C$i", $email);
        }

        // Simpan file Excel di storage Laravel
        $fileName = "fake_students_{$count}.xlsx";
        $filePath = storage_path("app/public/$fileName");

        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        $this->info("File Excel berhasil dibuat: storage/app/public/$fileName");
    }
}
