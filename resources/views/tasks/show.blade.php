@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Task Details</h5>
            <div>
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm">Edit</a>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
            </div>
        </div>
        <div class="card-body">
            <h2 class="card-title">{{ $task->title }}</h2>
            
            <div class="mb-3">
                <strong>Status:</strong>
                @if($task->status == 'pending')
                    <span class="badge bg-warning">Pending</span>
                @elseif($task->status == 'in_progress')
                    <span class="badge bg-primary">In Progress</span>
                @else
                    <span class="badge bg-success">Completed</span>
                @endif
            </div>
            
            <div class="mb-3">
                <strong>Created:</strong> {{ $task->created_at->format('M d, Y H:i') }}
            </div>
            
            @if($task->updated_at->ne($task->created_at))
                <div class="mb-3">
                    <strong>Last Updated:</strong> {{ $task->updated_at->format('M d, Y H:i') }}
                </div>
            @endif
            
            <div class="mb-3">
                <strong>Description:</strong>
                <p class="card-text">{{ $task->description ?? 'No description provided.' }}</p>
            </div>
        </div>
    </div>
@endsection