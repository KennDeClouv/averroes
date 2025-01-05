@extends('layouts.app')

@section('title', 'Tambah Santri')

@section('page-script')
    <script>
        $('.select2').select2();
    </script>
@endsection

@section('content')
    <form action="{{ route('administrationadmin.student.store') }}" method="POST" enctype="multipart/form-data">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light"> <a href="{{ route('administrationadmin.student.index') }}">Data Santri</a> /</span>
                Tambah Santri
            </h5>
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Akun Santri</h5>
                        </div>
                        <div class="card-body">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Nama Santri" value="{{ old('name') }}">
                                @errorFeedback('name')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="username">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" placeholder="Username Santri"
                                    value="{{ old('username') }}">
                                @errorFeedback('username')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Email Santri" value="{{ old('email') }}">
                                @errorFeedback('email')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Password Santri">
                                @errorFeedback('password')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" placeholder="Konfirmasi Password Santri">
                                @errorFeedback('password_confirmation')
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Data Santri</h5>
                        </div>
                        <div class="card-body">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">Nama Lengkap</label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                    id="full_name" name="full_name" placeholder="Nama Santri" value="{{ old('full_name') }}">
                                @errorFeedback('full_name')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="nisn">NISN</label>
                                <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                    id="nisn" name="nisn" placeholder="NISN Santri" value="{{ old('nisn') }}">
                                @errorFeedback('nisn')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="gender">Gender</label>
                                <select class="form-select select2 @error('gender') is-invalid @enderror" id="gender" name="gender">
                                    <option value="" disabled selected>Pilih Gender</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @errorFeedback('gender')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="phone">No Telepon</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" placeholder="No Telepon Santri" value="{{ old('phone') }}">
                                @errorFeedback('phone')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="birth_date">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                                    id="birth_date" name="birth_date" value="{{ old('birth_date') }}">
                                @errorFeedback('birth_date')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="birth_place">Tempat Lahir</label>
                                <input type="text" class="form-control @error('birth_place') is-invalid @enderror"
                                    id="birth_place" name="birth_place" placeholder="Tempat Lahir Santri" value="{{ old('birth_place') }}">
                                @errorFeedback('birth_place')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="address">Alamat</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Alamat Santri">{{ old('address') }}</textarea>
                                @errorFeedback('address')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="sibling_info">Informasi Saudara</label>
                                <input type="text" class="form-control @error('sibling_info') is-invalid @enderror"
                                    id="sibling_info" name="sibling_info" placeholder="Informasi Saudara" value="{{ old('sibling_info') }}">
                                @errorFeedback('sibling_info')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="quran_memorization">Jumlah Hafalan Quran</label>
                                <input type="number" class="form-control @error('quran_memorization') is-invalid @enderror"
                                    id="quran_memorization" name="quran_memorization" placeholder="Jumlah Hafalan Quran" value="{{ old('quran_memorization') }}">
                                @errorFeedback('quran_memorization')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="achievements">Prestasi</label>
                                <input type="text" class="form-control @error('achievements') is-invalid @enderror"
                                    id="achievements" name="achievements" placeholder="Prestasi Santri" value="{{ old('achievements') }}">
                                @errorFeedback('achievements')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="major">Jurusan</label>
                                <select class="form-select select2 @error('major') is-invalid @enderror" id="major" name="major">
                                    <option value="" disabled selected>Pilih Jurusan</option>
                                    <option value="RPL" {{ old('major') == 'RPL' ? 'selected' : '' }}>RPL</option>
                                    <option value="DKV" {{ old('major') == 'DKV' ? 'selected' : '' }}>DKV</option>
                                </select>
                                @errorFeedback('major')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="medical_history">Riwayat Kesehatan</label>
                                <input type="text" class="form-control @error('medical_history') is-invalid @enderror"
                                    id="medical_history" name="medical_history" placeholder="Riwayat Kesehatan" value="{{ old('medical_history') }}">
                                @errorFeedback('medical_history')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="father_name">Nama Ayah</label>
                                <input type="text" class="form-control @error('father_name') is-invalid @enderror"
                                    id="father_name" name="father_name" placeholder="Nama Ayah" value="{{ old('father_name') }}">
                                @errorFeedback('father_name')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="father_occupation">Pekerjaan Ayah</label>
                                <input type="text" class="form-control @error('father_occupation') is-invalid @enderror"
                                    id="father_occupation" name="father_occupation" placeholder="Pekerjaan Ayah" value="{{ old('father_occupation') }}">
                                @errorFeedback('father_occupation')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="father_income">Penghasilan Ayah</label>
                                <input type="number" class="form-control @error('father_income') is-invalid @enderror"
                                    id="father_income" name="father_income" placeholder="Penghasilan Ayah" value="{{ old('father_income') }}">
                                @errorFeedback('father_income')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="mother_name">Nama Ibu</label>
                                <input type="text" class="form-control @error('mother_name') is-invalid @enderror"
                                    id="mother_name" name="mother_name" placeholder="Nama Ibu" value="{{ old('mother_name') }}">
                                @errorFeedback('mother_name')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="mother_occupation">Pekerjaan Ibu</label>
                                <input type="text" class="form-control @error('mother_occupation') is-invalid @enderror"
                                    id="mother_occupation" name="mother_occupation" placeholder="Pekerjaan Ibu" value="{{ old('mother_occupation') }}">
                                @errorFeedback('mother_occupation')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="mother_income">Penghasilan Ibu</label>
                                <input type="number" class="form-control @error('mother_income') is-invalid @enderror"
                                    id="mother_income" name="mother_income" placeholder="Penghasilan Ibu" value="{{ old('mother_income') }}">
                                @errorFeedback('mother_income')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="parent_whatsapp">No Whatsapp Orang Tua</label>
                                <input type="text" class="form-control @error('parent_whatsapp') is-invalid @enderror"
                                    id="parent_whatsapp" name="parent_whatsapp" placeholder="No Whatsapp Orang Tua" value="{{ old('parent_whatsapp') }}">
                                @errorFeedback('parent_whatsapp')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="student_status">Status Santri</label>
                                <select class="form-select select2 @error('student_status') is-invalid @enderror" id="student_status" name="student_status">
                                    <option value="" disabled selected>Pilih Status Santri</option>
                                    <option value="Yatim Piatu" {{ old('student_status') == 'Yatim Piatu' ? 'selected' : '' }}>Yatim Piatu</option>
                                    <option value="Yatim" {{ old('student_status') == 'Yatim' ? 'selected' : '' }}>Yatim</option>
                                    <option value="Piatu" {{ old('student_status') == 'Piatu' ? 'selected' : '' }}>Piatu</option>
                                    <option value="Non Yatim Piatu" {{ old('student_status') == 'Non Yatim Piatu' ? 'selected' : '' }}>Non Yatim Piatu</option>
                                </select>
                                @errorFeedback('student_status')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="attachment_family_register">Lampiran Kartu Keluarga</label>
                                <input type="file" class="form-control @error('attachment_family_register') is-invalid @enderror"
                                    id="attachment_family_register" name="attachment_family_register">
                                @errorFeedback('attachment_family_register')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="attachment_birth_certificate">Lampiran Akta Kelahiran</label>
                                <input type="file" class="form-control @error('attachment_birth_certificate') is-invalid @enderror"
                                    id="attachment_birth_certificate" name="attachment_birth_certificate">
                                @errorFeedback('attachment_birth_certificate')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="attachment_diploma">Lampiran Ijazah</label>
                                <input type="file" class="form-control @error('attachment_diploma') is-invalid @enderror"
                                    id="attachment_diploma" name="attachment_diploma">
                                @errorFeedback('attachment_diploma')
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
@endsection
