@extends('components.app')

@section('title', 'Tambah Santri')

@section('page-script')
    <script>
        $('.select2').select2();
    </script>
@endsection

@section('content')
    <form action="{{ route('administrationadmin.student.store') }}" method="POST">
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
                                <input type="text" class="form-control @error('fullname') is-invalid @enderror"
                                    id="fullname" name="fullname" placeholder="Nama Santri" value="{{ old('fullname') }}">
                                @errorFeedback('fullname')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="nisn">NISN</label>
                                <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                    id="nisn" name="nisn" placeholder="NISN Santri" value="{{ old('nisn') }}">
                                @errorFeedback('nisn')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="gender">Jenis Kelamin</label>
                                <select class="form-control select2 @error('gender') is-invalid @enderror" id="gender"
                                    name="gender">
                                    <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Pilih Jenis
                                        Kelamin</option>
                                    <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                                @errorFeedback('gender')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="class">Kelas</label>
                                <select class="form-control select2 @error('classes_id') is-invalid @enderror" id="class"
                                    name="classes_id">
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
                                <label class="form-label" for="room">Kamar</label>
                                <select class="form-control select2 @error('room_id') is-invalid @enderror" id="room"
                                    name="room_id">
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
                                <label class="form-label" for="phone">Nomor Telepon</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" placeholder="Nomor Telepon Santri"
                                    value="{{ old('phone') }}">
                                @errorFeedback('phone')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="birthdate">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('birthdate') is-invalid @enderror"
                                    id="birthdate" name="birthdate" value="{{ old('birthdate') }}">
                                @errorFeedback('birthdate')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="birthplace">Tempat Lahir</label>
                                <input type="text" class="form-control @error('birthplace') is-invalid @enderror"
                                    id="birthplace" name="birthplace" placeholder="Tempat Lahir Santri"
                                    value="{{ old('birthplace') }}">
                                @errorFeedback('birthplace')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="phone">Nomor Telepon</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" placeholder="Nomor Telepon Santri"
                                    value="{{ old('phone') }}">
                                @errorFeedback('phone')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="address">Alamat</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address"
                                    name="address" rows="3" placeholder="Alamat Santri">{{ old('address') }}</textarea>
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
