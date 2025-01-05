@extends('layouts.app')

@section('title', 'Tambah Ijin Santri')

@section('page-script')
    <script>
        $('.select2').select2();
    </script>
@endsection

@section('content')
    <form action="{{ route('teacher.studentpermit.store') }}" method="POST">
        @csrf
        <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light"><a href="{{ route('teacher.studentpermit.index') }}">Daftar Ijin Santri</a>
                    / </span>
                Tambah Ijin Santri
            </h5>
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Ijin Santri</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="student_id">Santri</label>
                                <select class="form-select select2 @error('student_id') is-invalid @enderror"
                                    id="student_id" name="student_id">
                                    <option value="">Pilih Santri</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}"
                                            {{ old('student_id') == $student->id ? 'selected' : '' }}>{{ $student->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @errorFeedback('student_id')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="from">Dari</label>
                                <input type="datetime-local" class="form-control @error('from') is-invalid @enderror"
                                    id="from" name="from" value="{{ old('from') }}">
                                @errorFeedback('from')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="to">Sampai</label>
                                <input type="datetime-local" class="form-control @error('to') is-invalid @enderror"
                                    id="to" name="to" value="{{ old('to') }}">
                                @errorFeedback('to')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="reason">Sebab</label>
                                <textarea class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason">{{ old('reason') }}</textarea>
                                @errorFeedback('reason')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">Keterangan</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                                @errorFeedback('description')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="status">Status</label>
                                <select class="form-select select2 @error('status') is-invalid @enderror" id="status"
                                    name="status">
                                    <option value="">Pilih Status</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved
                                    </option>
                                    <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected
                                    </option>
                                </select>
                                @errorFeedback('status')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="note">Catatan</label>
                                <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note">{{ old('note') }}</textarea>
                                @errorFeedback('note')
                            </div>
                            <input type="hidden" name="teacher_id" value="{{ Auth::user()->Teacher->id }}">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
