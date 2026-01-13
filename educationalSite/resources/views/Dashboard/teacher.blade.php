@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('dashboard.css') }}">

<div class="container">
    <div class="dashboard-header">
        <h1>Teacher Dashboard</h1>
        <p>Welcome, {{ auth()->user()->name }}!</p>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Assigned Modules -->
     <div class="section-card">
        <h2 class="section-title">Your Assigned Modules</h2>

        @if($assignedModules->count() > 0)
        @foreach($assignedModules as $module)
        <div class="module-card">
            <div class="module-header">
                <div>
                    <h3 class="module-title">{{ $module->module }}</h3>
                        <span class="status-badge {{ $module->available ? 'status-available' : 'status-unavailable' }}">
                            {{ $module->available ? 'Available' : 'Unavailable' }}
                        </span>
                    </div>
                    <div class="module-stats">
                        <p>Active Students: {{ $module->activeStudents()->count() }}/10</p>
                        <p>Completed: {{ $module->completedStudents()->count() }}</p>
                    </div>
                </div>

                <!-- Active Students -->
                 @if($module->activeStudents->count() > 0)
                 <div class="student-section">
                    <h4 class="student-subtitle">Active Students ({{ $module->activeStudents()->count() }})</h4>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Email</th>
                                <th>Enrolled</th>
                                <th>Action</th>
</tr>
</thead>
<tbody>
@foreach($module->users as $student)
    @if(!$student->pivot->completed_at)
    <tr>
        <td>{{ $student->name }}</td>
        <td>{{ $student->email }}</td>
        <td>{{ $student->pivot->start_date ? date('M d, Y', strtotime($student->pivot->start_date)) : 'N/A' }}</td>
    <td>
        <form action="{{ route('teacher.set.result', [$module->id, $student->id]) }}" method="POST" class="form-row">
           @csrf
            <select name="result" class="form-select" required>
                <option value="">Set Result</option>
                <option value="PASS">PASS</option>
                <option value="FAIL">FAIL</option>
</select>
<button type="submit" class="btn btn-primary">Submit</button>
</form>
</td>
</tr>
@endif
@endforeach
</tbody>
</table>
</div>
@else
<div class="empty-state">
    <p>No active students in this module.</p>
</div>
@endif

<!-- Completed Students -->
 @if($module->completedStudents->count() > 0)
 <div class="student-section">
    <h4 class="student-subtitle">Completed Students ({{ $module->completedStudents->count() }})</h4>
    <table class="data-table">
        <thead>
            <tr>
                <th>Student</th>
                <th>Email</th>
                <th>Result</th>
                <th>Completed</th>
</tr>
</thead>
<tbody>
    @foreach($module->completedStudents as $student)
    <tr>
        <td>{{ $student->name }}</td>
        <td>{{ $student->email }}</td>
        <td>
            <span class="status-badge {{ $student->pivot->result == 'PASS' ? 'status-pass' : 'status-fail' }}">
                {{ $student->pivot->result }}
            </span>
</td>
<td>{{ $student->pivot->completed_at ? date('M d, Y', strtotime($student->pivot->completed_at)) : 'N/A' }}</td>
</tr>
@endforeach
</tbody>
</table>
</div>
@endif
</div>
@endforeach
@else
<div class="empty-state">
    <h3>No Assigned Modules</h3>
    <p>You haven't been assigned any modules yet.</p>
    <p>Contact an administrator to get modules assigned to you.</p>
</div>
@endif
</div>
</div>
@endsection
