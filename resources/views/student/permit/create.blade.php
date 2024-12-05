@extends('components.app')

@section('title', 'Tambah Ijin Santri')

@section('page-script')
    <script>
        $('.select2').select2();
    </script>
@endsection

@section('content')
    <form action="{{ route('student.permit.store') }}" method="POST">
        @csrf
        <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light"><a href="{{ route('student.permit.index') }}">Daftar Ijin Kamu</a> / </span>
                Tambah Ijin Kamu
            </h5>
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Ijin Kamu</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="teacher_id">Ustadz</label>
                                <select class="form-select select2 @error('teacher_id') is-invalid @enderror" id="teacher_id"
                                    name="teacher_id">
                                    <option value="">Pilih Ustadz</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                                @errorFeedback('teacher_id')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="from">Dari</label>
                                <input type="datetime-local" class="form-control @error('from') is-invalid @enderror" id="from"
                                    name="from" value="{{ old('from') }}">
                                @errorFeedback('from')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="to">Sampai</label>
                                <input type="datetime-local" class="form-control @error('to') is-invalid @enderror" id="to"
                                    name="to" value="{{ old('to') }}">
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
                            <input type="hidden" name="student_id" value="{{ Auth::user()->Student->id }}">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
