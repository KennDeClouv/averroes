@extends('layouts.app')

@section('title', 'Tambah Ustadz')

@section('page-script')
    <script>
        $('.select2').select2();
    </script>
@endsection

@section('content')
    <form action="{{ route('administrationadmin.teacher.store') }}" method="POST">
        @csrf
        <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light"> <a href="{{ route('administrationadmin.teacher.index') }}">Daftar
                        Ustadz</a> /</span>
                Tambah Ustadz
            </h5>
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Akun Ustadz</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="name">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Nama Ustadz" value="{{ old('name') }}">
                                @errorFeedback('name')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="username">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" placeholder="Username Ustadz"
                                    value="{{ old('username') }}">
                                @errorFeedback('username')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="Email Ustadz" value="{{ old('email') }}">
                                @errorFeedback('email')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" placeholder="Password Ustadz">
                                @errorFeedback('password')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation" name="password_confirmation"
                                    placeholder="Konfirmasi Password Ustadz">
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
                            <h5 class="mb-0">Data Ustadz</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="full_name">Nama Lengkap</label>
                                <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                    id="full_name" name="full_name" placeholder="Nama Lengkap Ustadz"
                                    value="{{ old('full_name') }}">
                                @errorFeedback('full_name')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="ktp">KTP</label>
                                <input type="number" class="form-control @error('ktp') is-invalid @enderror" id="ktp"
                                    name="ktp" placeholder="KTP Ustadz" value="{{ old('ktp') }}">
                                @errorFeedback('ktp')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="gender">Jenis Kelamin</label>
                                <select class="form-control select2 @error('gender') is-invalid @enderror" id="gender"
                                    name="gender">
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                                @errorFeedback('gender')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="room">Kamar</label>
                                <select class="form-control select2" id="room" name="room_id">
                                    <option value="" disabled {{ old('room_id') ? '' : 'selected' }}>Pilih Kamar
                                    </option>
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}"
                                            {{ old('room_id') == $room->id ? 'selected' : '' }}>{{ $room->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @errorFeedback('room_id')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="classes">Kelas</label>
                                <select class="form-control select2" id="classes" name="classes_id">
                                    <option value="" disabled {{ old('classes_id') ? '' : 'selected' }}>Pilih Kelas
                                    </option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}"
                                            {{ old('classes_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @errorFeedback('classes_id')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="phone">Nomor Telepon</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" placeholder="Nomor Telepon Ustadz"
                                    value="{{ old('phone') }}">
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
                                    id="birth_place" name="birth_place" placeholder="Tempat Lahir Ustadz"
                                    value="{{ old('birth_place') }}">
                                @errorFeedback('birth_place')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="type">Tipe</label>
                                <select class="form-control select2 @error('type') is-invalid @enderror" id="type"
                                    name="type">
                                    <option value="" disabled {{ old('type') ? '' : 'selected' }}>Pilih Tipe
                                    </option>
                                    <option value="teacher" {{ old('type') == 'teacher' ? 'selected' : '' }}>Pengajar
                                    </option>
                                    <option value="companion" {{ old('type') == 'companion' ? 'selected' : '' }}>Musrif
                                    </option>
                                    <option value="headmaster" {{ old('type') == 'headmaster' ? 'selected' : '' }}>Mudzir
                                    </option>
                                </select>
                                @errorFeedback('type')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="secondary_type">Tipe Sekunder</label>
                                <select class="form-control select2 @error('secondary_type') is-invalid @enderror"
                                    id="secondary_type" name="secondary_type">
                                    <option value="" disabled {{ old('secondary_type') ? '' : 'selected' }}>Pilih
                                        Tipe Sekunder</option>
                                    <option value="teacher" {{ old('secondary_type') == 'teacher' ? 'selected' : '' }}>
                                        Pengajar</option>
                                    <option value="companion"
                                        {{ old('secondary_type') == 'companion' ? 'selected' : '' }}>
                                        Musrif</option>
                                    <option value="headmaster"
                                        {{ old('secondary_type') == 'headmaster' ? 'selected' : '' }}>
                                        Mudzir</option>
                                </select>
                                @errorFeedback('secondary_type')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="address">Alamat</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3"
                                    placeholder="Alamat Ustadz">{{ old('address') }}</textarea>
                                @errorFeedback('address')
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
