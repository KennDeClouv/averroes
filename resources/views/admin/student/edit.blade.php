@extends('components.app')

@section('title', 'Edit Santri')

@section('page-script')
    <script>
        $('.select2').select2();
    </script>
@endsection

@section('content')
    <form action="{{ route('admin.student.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light"> <a href="{{ route('admin.student.index') }}">Daftar Santri</a> /</span>
                Edit Santri
            </h5>
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Akun Santri</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="name">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $student->user->name) }}"
                                    placeholder="Nama Santri">
                                @errorFeedback('name')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="username">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" value="{{ old('username', $student->user->username) }}"
                                    placeholder="Username Santri">
                                @errorFeedback('username')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $student->user->email) }}"
                                    placeholder="Email Santri">
                                @errorFeedback('email')
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
                            <div class="mb-3">
                                <label class="form-label" for="fullname">Nama Lengkap</label>
                                <input type="text" class="form-control @error('fullname') is-invalid @enderror"
                                    id="fullname" name="fullname" value="{{ old('fullname', $student->name) }}"
                                    placeholder="Nama Santri">
                                @errorFeedback('fullname')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="nisn">NISN</label>
                                <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                    id="nisn" name="nisn" value="{{ old('nisn', $student->nisn) }}"
                                    placeholder="NISN Santri">
                                @errorFeedback('nisn')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="gender">Jenis Kelamin</label>
                                <select class="form-control select2 @error('gender') is-invalid @enderror" id="gender"
                                    name="gender" required>
                                    <option value="" disabled>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki"
                                        {{ old('gender', $student->gender) == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="Perempuan"
                                        {{ old('gender', $student->gender) == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @errorFeedback('gender')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="class">Kelas</label>
                                <select class="form-control select2 @error('classes_id') is-invalid @enderror" id="class"
                                    name="classes_id">
                                    <option value="" disabled>Pilih Kelas</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}"
                                            {{ old('classes_id', $student->classes_id) == $class->id ? 'selected' : '' }}>
                                            {{ $class->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @errorFeedback('classes_id')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="room">Kamar</label>
                                <select class="form-control select2 @error('room_id') is-invalid @enderror" id="room"
                                    name="room_id">
                                    <option value="" disabled>Pilih Kamar</option>
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}"
                                            {{ old('room_id', $student->room_id) == $room->id ? 'selected' : '' }}>
                                            {{ $room->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @errorFeedback('room_id')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="phone">Nomor Telepon</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone', $student->phone) }}"
                                    placeholder="Nomor Telepon Santri">
                                @errorFeedback('phone')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="birthdate">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('birthdate') is-invalid @enderror"
                                    id="birthdate" name="birthdate" value="{{ old('birthdate', $student->birthdate) }}">
                                @errorFeedback('birthdate')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="birthplace">Tempat Lahir</label>
                                <input type="text" class="form-control @error('birthplace') is-invalid @enderror"
                                    id="birthplace" name="birthplace"
                                    value="{{ old('birthplace', $student->birthplace) }}"
                                    placeholder="Tempat Lahir Santri">
                                @errorFeedback('birthplace')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="address">Alamat</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3"
                                    placeholder="Alamat Santri">{{ old('address', $student->address) }}</textarea>
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
