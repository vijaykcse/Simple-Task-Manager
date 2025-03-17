@extends('layouts.app')

@section('content')
    <div class="row mb-3">
        <div class="col">
            <h1>Task List</h1>
        </div>
        <div class="col text-end">
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add New Task</a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>
                            @if($task->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($task->status == 'in_progress')
                                <span class="badge bg-primary">In Progress</span>
                            @else
                                <span class="badge bg-success">Completed</span>
                            @endif
                        </td>
                        <td>{{ $task->created_at->format('M d, Y') }}</td>
                        <td class="d-flex">
                            <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-info me-2">View</a>
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No tasks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.delete-form').on('submit', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to delete this task?')) {
                    this.submit();
                }
            });
        });
    </script>
@endsection