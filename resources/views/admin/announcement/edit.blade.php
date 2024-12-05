@extends('components.app')

@section('title', 'Edit Pengumuman')

@section('page-script')
    <script>
        $('.select2').select2();
    </script>
@endsection

@section('content')
    <form action="{{ route('admin.announcement.update', $announcement->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="container-xxl flex-grow-1 container-p-y">
            <h5 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light"><a href="{{ route('admin.announcement.index') }}">Daftar Pengumuman</a> /
                </span>
                Edit Pengumuman
            </h5>
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Pengumuman</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="target_id">Tujuan</label>
                                <select class="form-select select2 @error('target_id') is-invalid @enderror" id="target_id"
                                    name="target_id">
                                    <option value="">Pilih Tujuan</option>
                                    @foreach ($targets as $target)
                                        <option value="{{ $target->id }}"
                                            {{ old('target_id', $announcement->target_id) == $target->id ? 'selected' : '' }}>{{ $target->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @errorFeedback('target_id')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="title">Judul</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title', $announcement->title) }}">
                                @errorFeedback('title')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="content">Konten</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="3">{{ old('content', $announcement->content) }}</textarea>
                                @errorFeedback('content')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="date">Tanggal</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror"
                                    id="date" name="date" value="{{ old('date', $announcement->date) }}">
                                @errorFeedback('date')
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="status">Status</label>
                                <select class="form-select select2 @error('status') is-invalid @enderror" id="status"
                                    name="status">
                                    <option value="active" {{ old('status', $announcement->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ old('status', $announcement->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif
                                    </option>
                                </select>
                                @errorFeedback('status')
                            </div>
                            <button type="submit" class="btn btn-warning">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
