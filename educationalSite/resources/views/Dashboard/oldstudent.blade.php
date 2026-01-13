@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('dashboard.css') }}">
<div class="container">
    <div class="dashboard-header">
        <h1>Old Student Dashboard</h1>
        <p>Welcome, {{ auth()->user()->name }}!</p>
</div>

<!-- Completed Modules History -->
 <div class="section-card">
    <h2 class="section-title">Completed Modules History</h2>

    @if($completedModules->count() > 0)
    <div class="stats-grid">
        <div class="stat-card">
            <p class="stat-number stat-total">{{ $completedModules->count() }}</p>
            <p class="stat-label">Total Modules</p>
</div>
<div class="stat-card">
    <p class="stat-number stat-pass">
        {{ $completedModules->where('pivot.result', 'PASS')->count() }}
</p>
<p class="stat-label">Passed</p>
</div>
<div class="stat-card">
    <p class="stat-number stat-fail">
        {{ $completedModules->where('pivot.result', 'FAIL')->count() }}
</p>
<p class="stat-label">Failed</p>
</div>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>Module</th>
            <th>Teacher</th>
            <th>Result</th>
            <th>Enrollment Date</th>
            <th>Completion Date</th>
</tr>
<thead>
    <tbody>
        @foreach($completedModules as $module)
        <tr>
            <td style="font-weight: 600;">{{ $module->module }}</td>
            <td>{{ $module->teacher ? $module->teacher->name : 'N/A' }}</td>
            <td>
                <span class="status-badge {{ $module->pivot->result == 'PASS' ? 'status-pass' : 'status-fail' }}">
                    {{ $module->pivot->result }}
</span>
</td>
<td>{{ $module->pivot->start_date ? $module->pivot->start_date->format('M d, Y') : 'N/A' }}</td>
<td>{{ $module->pivot->completed_at->format('M d, Y') }}</td>
</tr>
@endforeach
</tbody>
</table>
@else
<div class="empty-state">
    <h3>No Completed Modules</h3>
    <p>You haven't completed any modules yet. Your academic history will appear here once you complete modules as a current student.</p>
</div>
@endif
</div>
</div>
@endsection
