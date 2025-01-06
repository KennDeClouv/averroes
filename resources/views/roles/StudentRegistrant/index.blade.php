@extends('layouts.appwithoutmenu')

@section('title', 'Student Registrant Form')

@section('page-script')
    <script>
        $('.select2').select2();
    </script>
    <script>
        document.getElementById('editButton').addEventListener('click', function() {
            const inputs = document.querySelectorAll('input, select');
            inputs.forEach(input => {
                input.disabled = false;
            });
            this.classList.add("d-none");
            const submitButton = document.createElement('button');
            submitButton.type = 'submit';
            submitButton.className = 'btn btn-primary';
            submitButton.textContent = 'Submit';
            document.querySelector('#button-wrapper').appendChild(submitButton);
        });
    </script>
@endsection

@section('content')
    <div class="container mt-5 pt-5" style="max-width: 800px">
        @if (!Auth::user()->StudentRegistrant)
            <div class="card card-border-shadow-primary">
                <div class="card-body">
                    <div class="text-center"><i class="icon-averroes text-primary" style="font-size: 100px !important"></i>
                        <h3 class="mt-4">Formulir PPDB Santri Averroes
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                        </h3>
                    </div>
                    <p>Asalamualaykum wr.wb
                        Bismillah, sebelum mengisi pastikan <b>sudah membuat video rekaman bacaan qur'an dan diupload di
                            sosial
                            media / youtube.</b></p>
                    <p>Mohon bisa mengisi data dengan <b>lengkap dan teliti.</b> Semoga dimudahkan</p>
                </div>
            </div>
            <div class="card card-border-shadow-primary mt-3">
                <div class="card-body">
                    <form action="{{ route('studentregistrant.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', Auth::user()->name) }}">
                            @errorFeedback('name')
                        </div>
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                id="full_name" name="full_name" value="{{ old('full_name') }}">
                            @errorFeedback('full_name')
                        </div>
                        <div class="mb-3">
                            <label for="birth_date" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                                id="birth_date" name="birth_date" value="{{ old('birth_date') }}">
                            @errorFeedback('birth_date')
                        </div>
                        <div class="mb-3">
                            <label for="birth_place" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control @error('birth_place') is-invalid @enderror"
                                id="birth_place" name="birth_place" value="{{ old('birth_place') }}">
                            @errorFeedback('birth_place')
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                name="address" value="{{ old('address') }}">
                            @errorFeedback('address')
                        </div>
                        <div class="mb-3">
                            <label for="education_sd" class="form-label">Riwayat Pendidikan - Sekolah Dasar (SD/MI)</label>
                            <input type="text" class="form-control @error('education_sd') is-invalid @enderror"
                                id="education_sd" name="education_sd" value="{{ old('education_sd') }}">
                            @errorFeedback('education_sd')
                        </div>
                        <div class="mb-3">
                            <label for="education_smp" class="form-label">Riwayat Pendidikan - Sekolah Menengah Pertama
                                (SMP/MTS)</label>
                            <input type="text" class="form-control @error('education_smp') is-invalid @enderror"
                                id="education_smp" name="education_smp" value="{{ old('education_smp') }}">
                            @errorFeedback('education_smp')
                        </div>
                        <div class="mb-3">
                            <label for="nisn" class="form-label">NISN (Nomor Induk Siswa Nasional)</label>
                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn"
                                name="nisn" value="{{ old('nisn') }}">
                            @errorFeedback('nisn')
                        </div>
                        <div class="mb-3">
                            <label for="sibling_info" class="form-label">Keterangan Saudara (contoh: Anak ke 2 dari 3
                                bersaudara)</label>
                            <input type="text" class="form-control @error('sibling_info') is-invalid @enderror"
                                id="sibling_info" name="sibling_info" value="{{ old('sibling_info') }}">
                            @errorFeedback('sibling_info')
                        </div>
                        <div class="mb-3">
                            <label for="quran_memorization" class="form-label">Jumlah Hafalan Qur'an (Juz) </label>
                            <input type="number" class="form-control @error('quran_memorization') is-invalid @enderror"
                                id="quran_memorization" name="quran_memorization" value="{{ old('quran_memorization') }}">
                            @errorFeedback('quran_memorization')
                        </div>
                        <div class="mb-3">
                            <label for="achievements" class="form-label">Prestasi</label>
                            <input type="text" class="form-control @error('achievements') is-invalid @enderror"
                                id="achievements" name="achievements" value="{{ old('achievements') }}">
                            @errorFeedback('achievements')
                        </div>
                        <div class="mb-3">
                            <label for="school_motivation" class="form-label">Motivasi Sekolah Di Averroes</label>
                            <input type="text" class="form-control @error('school_motivation') is-invalid @enderror"
                                id="school_motivation" name="school_motivation" value="{{ old('school_motivation') }}">
                            @errorFeedback('school_motivation')
                        </div>
                        <div class="mb-3">
                            <label for="major" class="form-label">Jurusan yang diminati</label>
                            <select class="form-control select2 @error('major') is-invalid @enderror" id="major"
                                name="major">
                                <option value="RPL" {{ old('major') == 'RPL' ? 'selected' : '' }}>RPL</option>
                                <option value="DKV" {{ old('major') == 'DKV' ? 'selected' : '' }}>DKV</option>
                            </select>
                            @errorFeedback('major')
                        </div>
                        <div class="mb-3">
                            <label for="medical_history" class="form-label">Riwayat Penyakit (jika ada)</label>
                            <input type="text" class="form-control @error('medical_history') is-invalid @enderror"
                                id="medical_history" name="medical_history" value="{{ old('medical_history') }}">
                            @errorFeedback('medical_history')
                        </div>
                        <div class="mb-3">
                            <label for="father_name" class="form-label">Nama Ayah</label>
                            <input type="text" class="form-control @error('father_name') is-invalid @enderror"
                                id="father_name" name="father_name" value="{{ old('father_name') }}">
                            @errorFeedback('father_name')
                        </div>
                        <div class="mb-3">
                            <label for="father_occupation" class="form-label">Pekerjaan Ayah</label>
                            <input type="text" class="form-control @error('father_occupation') is-invalid @enderror"
                                id="father_occupation" name="father_occupation" value="{{ old('father_occupation') }}">
                            @errorFeedback('father_occupation')
                        </div>
                        <div class="mb-3">
                            <label for="father_income" class="form-label">Penghasilan Ayah</label>
                            <input type="number" class="form-control @error('father_income') is-invalid @enderror"
                                id="father_income" name="father_income" value="{{ old('father_income') }}">
                            @errorFeedback('father_income')
                        </div>
                        <div class="mb-3">
                            <label for="mother_name" class="form-label">Nama Ibu</label>
                            <input type="text" class="form-control @error('mother_name') is-invalid @enderror"
                                id="mother_name" name="mother_name" value="{{ old('mother_name') }}">
                            @errorFeedback('mother_name')
                        </div>
                        <div class="mb-3">
                            <label for="mother_occupation" class="form-label">Pekerjaan Ibu</label>
                            <input type="text" class="form-control @error('mother_occupation') is-invalid @enderror"
                                id="mother_occupation" name="mother_occupation" value="{{ old('mother_occupation') }}">
                            @errorFeedback('mother_occupation')
                        </div>
                        <div class="mb-3">
                            <label for="mother_income" class="form-label">Penghasilan Ibu</label>
                            <input type="number" class="form-control @error('mother_income') is-invalid @enderror"
                                id="mother_income" name="mother_income" value="{{ old('mother_income') }}">
                            @errorFeedback('mother_income')
                        </div>
                        <div class="mb-3">
                            <label for="parent_whatsapp" class="form-label">WhatsApp Orang Tua</label>
                            <input type="text" class="form-control @error('parent_whatsapp') is-invalid @enderror"
                                id="parent_whatsapp" name="parent_whatsapp" value="{{ old('parent_whatsapp') }}">
                            @errorFeedback('parent_whatsapp')
                        </div>
                        <div class="mb-3">
                            <label for="student_status" class="form-label">Status Siswa</label>
                            <select class="form-control select2 @error('student_status') is-invalid @enderror"
                                id="student_status" name="student_status">
                                <option value="Non Yatim Piatu"
                                    {{ old('student_status') == 'Non Yatim Piatu' ? 'selected' : '' }}>Non Yatim Piatu
                                </option>
                                <option value="Yatim Piatu"
                                    {{ old('student_status') == 'Yatim Piatu' ? 'selected' : '' }}>
                                    Yatim Piatu</option>
                                <option value="Yatim" {{ old('student_status') == 'Yatim' ? 'selected' : '' }}>Yatim
                                </option>
                                <option value="Piatu" {{ old('student_status') == 'Piatu' ? 'selected' : '' }}>Piatu
                                </option>
                            </select>
                            @errorFeedback('student_status')
                        </div>
                        <div class="mb-3">
                            <label for="quran_record_link" class="form-label">Rekaman Bacaan Al-Qur'an (Copy Link Youtube
                                /
                                Sosial Media) </label>
                            <input type="url" class="form-control @error('quran_record_link') is-invalid @enderror"
                                id="quran_record_link" name="quran_record_link" value="{{ old('quran_record_link') }}">
                            @errorFeedback('quran_record_link')
                        </div>
                        <div class="mb-3">
                            <label for="attachment_family_register" class="form-label">Lampiran Kartu Keluarga</label>
                            <input type="file"
                                class="form-control @error('attachment_family_register') is-invalid @enderror"
                                id="attachment_family_register" name="attachment_family_register">
                            @errorFeedback('attachment_family_register')
                        </div>
                        <div class="mb-3">
                            <label for="attachment_birth_certificate" class="form-label">Lampiran Akta Kelahiran</label>
                            <input type="file"
                                class="form-control @error('attachment_birth_certificate') is-invalid @enderror"
                                id="attachment_birth_certificate" name="attachment_birth_certificate">
                            @errorFeedback('attachment_birth_certificate')
                        </div>
                        <div class="mb-3">
                            <label for="attachment_diploma" class="form-label">Lampiran Ijazah / SKL</label>
                            <input type="file" class="form-control @error('attachment_diploma') is-invalid @enderror"
                                id="attachment_diploma" name="attachment_diploma">
                            @errorFeedback('attachment_diploma')
                        </div>
                        <div class="mb-3">
                            <label for="attachment_father_identity_card" class="form-label">Lampiran KTP Ayah</label>
                            <input type="file"
                                class="form-control @error('attachment_father_identity_card') is-invalid @enderror"
                                id="attachment_father_identity_card" name="attachment_father_identity_card">
                            @errorFeedback('attachment_father_identity_card')
                        </div>
                        <div class="mb-3">
                            <label for="attachment_mother_identity_card" class="form-label">Lampiran KTP Ibu</label>
                            <input type="file"
                                class="form-control @error('attachment_mother_identity_card') is-invalid @enderror"
                                id="attachment_mother_identity_card" name="attachment_mother_identity_card">
                            @errorFeedback('attachment_mother_identity_card')
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        @else
            @php
                $data = Auth::user()->StudentRegistrant;
            @endphp
            @if ($data->status === 'pending')
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading d-flex align-items-center">
                        <span class="alert-icon rounded-circle"><i class="fas fa-clock fs-5"></i></span>Pendaftaran
                        Berhasil :)
                    </h4>
                    <p class="mb-0">Anda telah berhasil melakukan pendaftaran, silakan menunggu konfirmasi lebih lanjut
                        dari
                        pihak sekolah Averroes.</p>
                    </button>
                </div>
            @elseif ($data->status === 'rejected')
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading d-flex align-items-center">
                        <span class="alert-icon rounded-circle"><i class="fas fa-times fs-5"></i></span>Pendaftaran
                        Ditolak
                    </h4>
                    <p class="mb-0">Maaf, pendaftaran Anda telah ditolak. Untuk informasi lebih lanjut silakan hubungi
                        admin.</p>
                </div>
            @else
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading d-flex align-items-center">
                        <span class="alert-icon rounded-circle"><i class="fas fa-check fs-5"></i></span>Pendaftaran
                        Diterima
                    </h4>
                    <p class="mb-0">Selamat! Pendaftaran Anda telah diterima. Silakan menunggu informasi lebih lanjut
                        dari pihak sekolah. anda bisa logout dan login lagi untuk menerima fitur yang sudah disediakan.</p>
                </div>
            @endif
            <div class="card card-border-shadow-primary mt-3">
                <form action="{{ route('studentregistrant.update', $data->id ) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $data->name }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                id="full_name" name="full_name" value="{{ $data->full_name }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="birth_date" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                                id="birth_date" name="birth_date" value="{{ $data->birth_date }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="birth_place" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control @error('birth_place') is-invalid @enderror"
                                id="birth_place" name="birth_place" value="{{ $data->birth_place }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror"
                                id="address" name="address" value="{{ $data->address }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="education_sd" class="form-label">Riwayat Pendidikan - Sekolah Dasar
                                (SD/MI)</label>
                            <input type="text" class="form-control @error('education_sd') is-invalid @enderror"
                                id="education_sd" name="education_sd" value="{{ $data->education_sd }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="education_smp" class="form-label">Riwayat Pendidikan - Sekolah Menengah Pertama
                                (SMP/MTS)</label>
                            <input type="text" class="form-control @error('education_smp') is-invalid @enderror"
                                id="education_smp" name="education_smp" value="{{ $data->education_smp }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="nisn" class="form-label">NISN (Nomor Induk Siswa Nasional)</label>
                            <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                id="nisn" name="nisn" value="{{ $data->nisn }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="sibling_info" class="form-label">Keterangan Saudara (contoh: Anak ke 2 dari 3
                                bersaudara)</label>
                            <input type="text" class="form-control @error('sibling_info') is-invalid @enderror"
                                id="sibling_info" name="sibling_info" value="{{ $data->sibling_info }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="quran_memorization" class="form-label">Jumlah Hafalan Qur'an (Juz) </label>
                            <input type="number" class="form-control @error('quran_memorization') is-invalid @enderror"
                                id="quran_memorization" name="quran_memorization"
                                value="{{ $data->quran_memorization }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="achievements" class="form-label">Prestasi</label>
                            <input type="text" class="form-control @error('achievements') is-invalid @enderror"
                                id="achievements" name="achievements" value="{{ $data->achievements }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="school_motivation" class="form-label">Motivasi Sekolah Di Averroes</label>
                            <input type="text" class="form-control @error('school_motivation') is-invalid @enderror"
                                id="school_motivation" name="school_motivation" value="{{ $data->school_motivation }}"
                                disabled>
                        </div>
                        <div class="mb-3">
                            <label for="major" class="form-label">Jurusan yang diminati</label>
                            <select class="form-control select2 @error('major') is-invalid @enderror" id="major"
                                name="major" disabled>
                                <option value="RPL" {{ $data->major == 'RPL' ? 'selected' : '' }}>RPL</option>
                                <option value="DKV" {{ $data->major == 'DKV' ? 'selected' : '' }}>DKV</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="medical_history" class="form-label">Riwayat Penyakit (jika ada)</label>
                            <input type="text" class="form-control @error('medical_history') is-invalid @enderror"
                                id="medical_history" name="medical_history" value="{{ $data->medical_history }}"
                                disabled>
                        </div>
                        <div class="mb-3">
                            <label for="father_name" class="form-label">Nama Ayah</label>
                            <input type="text" class="form-control @error('father_name') is-invalid @enderror"
                                id="father_name" name="father_name" value="{{ $data->father_name }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="father_occupation" class="form-label">Pekerjaan Ayah</label>
                            <input type="text" class="form-control @error('father_occupation') is-invalid @enderror"
                                id="father_occupation" name="father_occupation" value="{{ $data->father_occupation }}"
                                disabled>
                        </div>
                        <div class="mb-3">
                            <label for="father_income" class="form-label">Penghasilan Ayah</label>
                            <input type="number" class="form-control @error('father_income') is-invalid @enderror"
                                id="father_income" name="father_income" value="{{ $data->father_income }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="mother_name" class="form-label">Nama Ibu</label>
                            <input type="text" class="form-control @error('mother_name') is-invalid @enderror"
                                id="mother_name" name="mother_name" value="{{ $data->mother_name }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="mother_occupation" class="form-label">Pekerjaan Ibu</label>
                            <input type="text" class="form-control @error('mother_occupation') is-invalid @enderror"
                                id="mother_occupation" name="mother_occupation" value="{{ $data->mother_occupation }}"
                                disabled>
                        </div>
                        <div class="mb-3">
                            <label for="mother_income" class="form-label">Penghasilan Ibu</label>
                            <input type="number" class="form-control @error('mother_income') is-invalid @enderror"
                                id="mother_income" name="mother_income" value="{{ $data->mother_income }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="parent_whatsapp" class="form-label">WhatsApp Orang Tua</label>
                            <input type="text" class="form-control @error('parent_whatsapp') is-invalid @enderror"
                                id="parent_whatsapp" name="parent_whatsapp" value="{{ $data->parent_whatsapp }}"
                                disabled>
                        </div>
                        <div class="mb-3">
                            <label for="student_status" class="form-label">Status Siswa</label>
                            <select class="form-control select2 @error('student_status') is-invalid @enderror"
                                id="student_status" name="student_status" disabled>
                                <option value="Non Yatim Piatu"
                                    {{ $data->student_status == 'Non Yatim Piatu' ? 'selected' : '' }}>Non Yatim Piatu
                                </option>
                                <option value="Yatim Piatu"
                                    {{ $data->student_status == 'Yatim Piatu' ? 'selected' : '' }}>
                                    Yatim Piatu</option>
                                <option value="Yatim" {{ $data->student_status == 'Yatim' ? 'selected' : '' }}>Yatim
                                </option>
                                <option value="Piatu" {{ $data->student_status == 'Piatu' ? 'selected' : '' }}>Piatu
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quran_record_link" class="form-label">Rekaman Bacaan Al-Qur'an (Copy Link Youtube
                                /
                                Sosial Media) </label>
                            <input type="url" class="form-control @error('quran_record_link') is-invalid @enderror"
                                id="quran_record_link" name="quran_record_link" value="{{ $data->quran_record_link }}"
                                disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="attachment_family_register">Lampiran Kartu Keluarga</label>
                            <input type="file"
                                class="form-control @error('attachment_family_register') is-invalid @enderror"
                                id="attachment_family_register" name="attachment_family_register" disabled>
                            @errorFeedback('attachment_family_register')
                            @if ($data->attachment_family_register)
                                <a href="{{ $data->attachment_family_register }}" target="_blank">klik untuk
                                    melihat gambar</a>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="attachment_birth_certificate">Lampiran Akta
                                Kelahiran</label>
                            <input type="file"
                                class="form-control @error('attachment_birth_certificate') is-invalid @enderror"
                                id="attachment_birth_certificate" name="attachment_birth_certificate" disabled>
                            @errorFeedback('attachment_birth_certificate')
                            @if ($data->attachment_birth_certificate)
                                <a href="{{ $data->attachment_birth_certificate }}" target="_blank">klik untuk
                                    melihat gambar</a>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="attachment_diploma">Lampiran Ijazah / SKL</label>
                            <input type="file"
                                class="form-control @error('attachment_diploma') is-invalid @enderror"
                                id="attachment_diploma" name="attachment_diploma" disabled>
                            @errorFeedback('attachment_diploma')
                            @if ($data->attachment_diploma)
                                <a href="{{ $data->attachment_diploma }}" target="_blank">klik untuk melihat
                                    gambar</a>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="attachment_father_identity_card">Lampiran KTP Ayah</label>
                            <input type="file"
                                class="form-control @error('attachment_father_identity_card') is-invalid @enderror"
                                id="attachment_father_identity_card" name="attachment_father_identity_card" disabled>
                            @errorFeedback('attachment_father_identity_card')
                            @if ($data->attachment_father_identity_card)
                                <a href="{{ $data->attachment_father_identity_card }}" target="_blank">klik untuk melihat gambar</a>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="attachment_mother_identity_card">Lampiran KTP Ibu</label>
                            <input type="file"
                                class="form-control @error('attachment_mother_identity_card') is-invalid @enderror"
                                id="attachment_mother_identity_card" name="attachment_mother_identity_card" disabled>
                            @errorFeedback('attachment_mother_identity_card')
                            @if ($data->attachment_mother_identity_card)
                                <a href="{{ $data->attachment_mother_identity_card }}" target="_blank">klik untuk melihat gambar</a>
                            @endif
                        </div>
                        <div id="button-wrapper">
                            <button type="button" class="btn btn-warning" id="editButton">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        @endif
    </div>
@endsection
