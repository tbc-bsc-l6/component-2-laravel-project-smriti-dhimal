@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('dashboard.css') }}">
<div class="container">
    <div class="dashboard-header">
        <h1>Student Dashboard</h1>
        <p>Welcome, {{ auth()->user()->name }}!</p>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert-warning">
            {{ session('error') }}
        </div>
    @endif

    <!-- Active Modules -->
     <div class="section-card">
        <h2 class="section-title">
            Active Modules ({{ $activeModules->count() }}/4)
        </h2>

        @if($activeModules->count() > 0)
        <div class="module-grid">
            @foreach($activeModules as $module)
            <div class="module-card">
                <h3 class="module-title">{{ $module->module }}</h3>
                <p class="module-info">
                    Teacher: {{ $module->teacher ? $module->teacher->name : 'Not Assigned' }}
                </p>
                <p class="module-info">
                    Enrolled: {{ $module->pivot->start_date ? date('M d, Y', strtotime($module->pivot->start_date)) : 'N/A' }}
</p>
<p class="module-info">
    Progress: In Progress
</p>
<div class="module-stats">
    {{ $module->activeStudents()->count() }}/10 students enrolled
</div>
</div>
@endforeach
</div>
@else
<div class="empty-state">
    <h3>No Active Modules</h3>
    <p>You are not enrolled in any active modules.</p>
    <p>Enroll in modules below to get started!</p>
</div>
@endif
</div>

<!-- Available Modules for Enrollment -->
 @if($canEnroll)
 <div class="section-card">
    <h2 class="section-title">Available Modules for Enrollment</h2>
    @if($availableModules->count() > 0)
    <div class="enrollment-grid">
        @foreach($availableModules as $module)
        <div class="enrollment-card">
            <h3 class="module-title">{{ $module->module }}</h3>
            <p class="module-info">
                Teacher: {{ $module->teacher ? $module->teacher->name : 'Not Assigned' }}
</p>
<p class="module-info">
    {{ $module->activeStudents->count() }}/10 spots available
</p>
<form action="{{ route('student.enroll.module', $module->id) }}" method="POST">
    @csrf 
    <button type="submit" class="btn btn-primary">
        Enroll Now
</button>
</form>
</div>
@endforeach
</div>
@else
<div class="empty-state">
    <h3>No Available Modules</h3>
    <p>No modules available for enrollment at the moment.</p>
    <p>Check back later for new opportunities!</p>
</div>
@endif
</div>
@else
<div class="alert-warning">
    <h3>Maximum Enrollment Reached</h3>
    <p>You are enrolled in the maximum of 4 active modules. Complete or unenroll from current modules to enroll in new ones.</p>
</div>
@endif

<!-- Completed Modules History -->
 <div class="section-card">
    <h2 class="section-title">Completed Modules History</h2>
    @if($completedModules->count() > 0)
    <table class="data-table">
        <thead>
            <tr>
                <th>Module</th>
                <th>Teacher</th>
                <th>Result</th>
                <th>Completed Date</th>
</tr>
</thead>
<tbody>
    @foreach($completedModules as $module)
    <tr>
        <td>{{ $module->module }}</td>
        <td>{{ $module->teacher ? $module->teacher->name : 'N/A' }}</td>
        <td>
            <span class="status-badge {{ $module->pivot->result == 'PASS' ? 'status-pass' : 'status-fail' }}">
                {{ $module->pivot->result }}
</span>
</td>
<td>{{ $module->pivot->completed_at->format('M d, Y') }}</td>
</tr>
@endforeach
</tbody>
</table>
@else
<div class="empty-state">
    <h3>No Completed Modules</h3>
    <p>You haven't completed any modules yet.</p>
    <p>Your completed modules will appear here once teachers mark them as complete.</p>
</div>
@endif
</div>
</div>
@endsection
