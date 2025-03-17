@extends('layouts.app')

@section('content')
    <h1>Edit Task</h1>
    
    <form id="taskForm" action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $task->title) }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div id="titleError" class="text-danger d-none">Title is required</div>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $task->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Update Task</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#taskForm').on('submit', function(e) {
                if ($('#title').val().trim() === '') {
                    e.preventDefault();
                    $('#titleError').removeClass('d-none');
                    $('#title').addClass('is-invalid');
                } else {
                    $('#titleError').addClass('d-none');
                    $('#title').removeClass('is-invalid');
                }
            });

            $('#title').on('input', function() {
                if ($(this).val().trim() !== '') {
                    $('#titleError').addClass('d-none');
                    $(this).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection