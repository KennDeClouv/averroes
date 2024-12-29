@extends('components.app')

@section('title', 'Edit Ijin Santri')

@section('page-script')
    <script>
        $('.select2').select2();
    </script>
@endsection

@section('content')
    <form action="{{ route('administrationadmin.studentpermit.update', $studentPermit->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light"><a href="{{ route('administrationadmin.studentpermit.index') }}">Daftar Ijin Santri</a> / </span>
                Edit Ijin Santri
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
                                <select class="form-select select2 @error('student_id') is-invalid @enderror" id="student_id"
                                    name="student_id">
                                    <option value="">Pilih Santri</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}" {{ (old('student_id') ?? $studentPermit->student_id) == $student->id ? 'selected' : '' }}>{{ $student->name }}</option>
                                    @endforeach
                                </select>
                                @errorFeedback('student_id')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="teacher_id">Ustadz</label>
                                <select class="form-select select2 @error('teacher_id') is-invalid @enderror" id="teacher_id"
                                    name="teacher_id">
                                    <option value="">Pilih Ustadz</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ (old('teacher_id') ?? $studentPermit->teacher_id) == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                                @errorFeedback('teacher_id')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="from">Dari</label>
                                <input type="datetime-local" class="form-control @error('from') is-invalid @enderror" id="from"
                                    name="from" value="{{ old('from', \Carbon\Carbon::parse($studentPermit->from)->format('Y-m-d\TH:i')) }}">
                                @errorFeedback('from')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="to">Sampai</label>
                                <input type="datetime-local" class="form-control @error('to') is-invalid @enderror" id="to"
                                    name="to" value="{{ old('to', \Carbon\Carbon::parse($studentPermit->to)->format('Y-m-d\TH:i')) }}">
                                @errorFeedback('to')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="reason">Sebab</label>
                                <textarea class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason">{{ old('reason', $studentPermit->reason) }}</textarea>
                                @errorFeedback('reason')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">Keterangan</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $studentPermit->description) }}</textarea>
                                @errorFeedback('description')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="status">Status</label>
                                <select class="form-select select2 @error('status') is-invalid @enderror" id="status" name="status">
                                    <option value="">Pilih Status</option>
                                    <option value="pending" {{ (old('status') ?? $studentPermit->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ (old('status') ?? $studentPermit->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ (old('status') ?? $studentPermit->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                                @errorFeedback('status')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="note">Catatan</label>
                                <textarea class="form-control @error('note') is-invalid @enderror" id="note" name="note">{{ old('note', $studentPermit->note) }}</textarea>
                                @errorFeedback('note')
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
