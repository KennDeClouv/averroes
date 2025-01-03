<?php

/**
 * Dokumentasi untuk Fungsi Pembantu
 *
 * File ini berisi berbagai fungsi pembantu yang dapat digunakan di seluruh aplikasi.
 *
 * 1. getGender($value)
 *    - Mengonversi nilai gender ('male' atau 'female') ke representasi string yang sesuai.
 *    - Penggunaan:
 *      $gender = getGender('male'); // Mengembalikan 'Laki-laki'
 *
 * 2. formatDate($date, $format = 'd F Y')
 *    - Memformat tanggal ke format yang ditentukan menggunakan Carbon.
 *    - Format default adalah 'd F Y'.
 *    - Penggunaan:
 *      $formattedDate = formatDate('2025-01-01'); // Mengembalikan '01 Januari 2025'
 *
 * 3. sendWhatsAppMessage($to, $message)
 *    - Mengirim pesan WhatsApp menggunakan API UltraMsg.
 *    - Memerlukan ULTRAMSG_INSTANCE_ID dan ULTRAMSG_TOKEN dalam environment.
 *    - Penggunaan:
 *      $response = sendWhatsAppMessage('628123456789', 'Halo!');
 *
 * 4. sendWhatsAppImage($to, $imageUrl, $caption = null)
 *    - Mengirim gambar ke WhatsApp menggunakan API UltraMsg.
 *    - Penggunaan:
 *      $response = sendWhatsAppImage('628123456789', 'http://image.jpg', 'Caption');
 *
 * 5. getStatus($value)
 *    - Mengonversi status ke representasi string.
 *    - Penggunaan:
 *      $status = getStatus('approved'); // Mengembalikan 'Disetujui'
 *
 * 6. uploadFile($file, $folder, $disk = 'public')
 *    - Mengunggah file ke folder yang ditentukan.
 *    - Penggunaan:
 *      $filePath = uploadFile($request->file('document'), 'uploads');
 *
 * 7. deleteFile($path)
 *    - Menghapus file berdasarkan jalur yang diberikan.
 *    - Penggunaan:
 *      deleteFile('uploads/image.jpg');
 *
 * 8. indonesianCurrency($number)
 *    - Memformat angka ke format mata uang Indonesia.
 *    - Penggunaan:
 *      $formatted = indonesianCurrency(1000000); // Mengembalikan 'Rp 1.000.000'
 *
 * 9. formatPhoneToInternational($phone)
 *    - Memformat nomor telepon ke format internasional.
 *    - Penggunaan:
 *      $formatted = formatPhoneToInternational('08123456789'); // Mengembalikan '628123456789'
 *
 * 10. teacherType($type)
 *     - Mengonversi tipe pengajar ke representasi string.
 *     - Penggunaan:
 *       $type = teacherType('teacher'); // Mengembalikan 'Pengajar'
 *
 */

use Illuminate\Support\Facades\Storage;

if (! function_exists('getGender')) {
    function getGender($value)
    {
        return $value === 'male' ? 'Laki-laki' : 'Perempuan';
    }
}
if (! function_exists('formatDate')) {
    function formatDate($date, $format = 'd F Y')
    {
        return \Carbon\Carbon::parse($date)->translatedFormat($format);
    }
}
if (! function_exists('sendWhatsAppMessage')) {
    function sendWhatsAppMessage($to, $message)
    {
        $url = "https://api.ultramsg.com/" . env('ULTRAMSG_INSTANCE_ID') . "/messages/chat";

        $data = [
            'token' => env('ULTRAMSG_TOKEN'),
            'to' => $to,
            'body' => $message,
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
if (! function_exists('sendWhatsAppImage')) {
    function sendWhatsAppImage($to, $imageUrl, $caption = null)
    {
        $url = "https://api.ultramsg.com/" . env('ULTRAMSG_INSTANCE_ID') . "/messages/image";

        $data = [
            'token' => env('ULTRAMSG_TOKEN'),
            'to' => $to,
            'image' => $imageUrl,
            'caption' => $caption,
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
if (!function_exists('getStatusOptions')) {
    function getStatusOptions(string $type): array
    {
        $statuses = [
            'approval' => ['pending', 'approved', 'rejected'],
            'activation' => ['active', 'inactive'],
        ];

        return $statuses[$type] ?? [];
    }
}

if (!function_exists('getStatusLabel')) {
    function getStatusLabel(string $status, string $type): string
    {
        $labels = [
            'approval' => [
                'pending' => 'Menunggu',
                'approved' => 'Disetujui',
                'rejected' => 'Ditolak',
            ],
            'activation' => [
                'active' => 'Aktif',
                'inactive' => 'Tidak Aktif',
            ],
        ];

        return $labels[$type][$status] ?? 'Unknown';
    }
}
if (! function_exists('uploadFile')) {
    function uploadFile($file, $folder, $disk = 'public')
    {
        $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '', $file->getClientOriginalName());
        $file->storeAs($folder, $filename, $disk);
        return $filename;
    }
}
if (! function_exists('deleteFile')) {
    function deleteFile($path)
    {
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}

if (! function_exists('indonesianCurrency')) {
    function indonesianCurrency($number)
    {
        return 'Rp ' . number_format($number, 0, ',', '.');
    }
}
if (! function_exists('formatPhoneToInternational')) {
    function formatPhoneToInternational($phone)
    {
        $phone = preg_replace('/\D/', '', $phone);
        if (substr($phone, 0, 1) === '0') {
            return '62' . substr($phone, 1);
        }
        return $phone;
    }
}
if (! function_exists('teacherType')) {
    function teacherType($type)
    {
        $types = [
            'teacher' => 'Pengajar',
            'companion' => 'Musrif',
            'headmaster' => 'Mudzir',
        ];

        return $types[$type] ?? '-';
    }
}

if (!function_exists('convertCase')) {
    function convertCase(string $input, string $targetCase): string
    {
        if (!preg_match('/[_\s-]|[a-z][A-Z]/', $input)) {
            throw new InvalidArgumentException("Input must have clear word boundaries (e.g., snake_case or camelCase).");
        }

        $normalized = preg_replace('/([a-z0-9])([A-Z])/', '$1 $2', $input); // camelCase -> camel Case
        $normalized = strtolower(preg_replace('/[_-]/', ' ', $normalized)); // snake_case/kebab-case -> snake case

        switch ($targetCase) {
            case 'camel':
                return lcfirst(str_replace(' ', '', ucwords($normalized)));
            case 'pascal':
                return str_replace(' ', '', ucwords($normalized));
            case 'snake':
                return strtolower(str_replace(' ', '_', $normalized));
            case 'kebab':
                return strtolower(str_replace(' ', '-', $normalized));
            case 'lowercase':
                return strtolower($normalized);
            case 'uppercase':
                return strtoupper($normalized);
            default:
                throw new InvalidArgumentException("Invalid target case: $targetCase");
        }
    }
}
