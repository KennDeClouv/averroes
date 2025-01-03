<?php

namespace App\Providers;

use Carbon\Carbon;
use App\Models\Role;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Mengubah bahasa Carbon menjadi bahasa yang sesuai dengan APP_LOCALE di env
         */
        Carbon::setLocale(env('APP_LOCALE', 'id'));
        /**
         * Dokumentasi Penggunaan Direktif Blade @errorFeedback
         *
         * Direktif ini digunakan untuk menampilkan umpan balik kesalahan
         * pada form input. Jika ada kesalahan validasi untuk field tertentu,
         * direktif ini akan menampilkan pesan kesalahan di bawah input.
         *
         * Cara menggunakan:
         * 1. Pastikan Anda telah menambahkan validasi pada controller
         *    sebelum mengembalikan tampilan.
         * 2. Di dalam file Blade Anda, gunakan direktif ini dengan
         *    menyertakan nama field yang ingin Anda periksa.
         *
         * Contoh penggunaan:
         *
         * <input type="text" name="username" class="form-control @error('username') is-invalid @enderror">
         * @errorFeedback('username')
         *
         * Dalam contoh di atas, jika ada kesalahan validasi untuk field
         * 'username', maka pesan kesalahan akan ditampilkan di bawah input
         * dengan kelas 'invalid-feedback'.
         */
        Blade::directive('errorFeedback', function ($field) {
            return "<?php if(\$errors->has($field)): ?>
                <div class='invalid-feedback'>{{ \$errors->first($field) }}</div>
            <?php endif; ?>";
        });
        /**
         * Dokumentasi Gate Otomatis
         *
         * Bagian kode ini mendefinisikan gate otomatis untuk setiap peran yang ada dalam aplikasi.
         * Gate digunakan untuk mengelola izin akses pengguna berdasarkan peran mereka.
         *
         * Setiap gate dinamai dengan format 'is' diikuti oleh nama peran yang ditulis dalam format CamelCase.
         * Contoh: untuk peran 'administration_admin', gate akan dinamai 'isAdministrationAdmin'.
         * Pastikan penulisan code role menggunakan snake case
         *
         * Fungsi gate ini memeriksa apakah pengguna yang terautentikasi memiliki peran yang sesuai
         * dengan gate yang sedang diperiksa. Jika kode peran pengguna sama dengan kode peran yang
         * didefinisikan dalam gate, maka akses akan diberikan.
         *
         * Penggunaan gate ini memungkinkan pengembang untuk dengan mudah mengelola izin akses
         * di seluruh aplikasi dengan cara yang terstruktur dan terorganisir.
         */
        if (!App::runningInConsole() && Schema::hasTable('roles')) {
            foreach (Role::all() as $role) {
                $gateName = 'is' . str_replace(' ', '', ucwords(str_replace('_', ' ', $role->code)));
                Gate::define($gateName, function ($user) use ($role) {
                    return $user->role->code === $role->code;
                });
            }
        }
    }
}
