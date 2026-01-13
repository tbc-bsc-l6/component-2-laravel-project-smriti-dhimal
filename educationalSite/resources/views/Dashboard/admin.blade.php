@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('dashboard.css') }}">
<div class="container">
    <div class="dashboard-header">
        <h1>Admin Dashboard</h1>
        <p>Welcome, {{auth()->user()->name}}!</p>
</div>

@if(session('success'))
<div class="alert-success">
    {{session('successs')}}
</div>
@endif

<!--Module management-->
<div class="section-card">
    <h2 class="section-title">Module Management</h2>
    <!--Module form-->
    <form action="{{ route('admin.add.module') }}" method="POST" class="form-row">
            @csrf
            <input type="text" name="module" placeholder="New module name" class="form-input" required>
            <button type="submit" class="btn btn-primary">Add Module</button>
        </form>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Module</th>
                    <th>Teacher</th>
                    <th>Students</th>
                    <th>Available</th>
                    <th>Actions</th>
</tr>
</thead>
<tbody>
    @foreach($modules as $module)
    <tr>
        <td>{{$module->module}}</td>
        <td>{{$module->teacher ? $module->teacher->name : 'Not Assigned'}}</td>
        <td>{{ $module->activeStudents()->count() }} / 10</td>
        <td>
            <span class="status-badge {{ $module->available ? 'status-available' : 'status-unavailable' }}">
                {{ $module->available ? 'Available' : 'Unavailable' }}
</span>
</td>
<td>
    <form action="{{ route('admin.toggle.module', $module->id) }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-warning">
            {{ $module->available ? 'Archive' : 'Activate' }}
        </button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>

<!--Teacher management-->
<div class="section-card">
    <h2 class="section-title">Teacher Management</h2>

    <!--create teacher form-->
    <form action="{{ route('admin.create.teacher') }}" method="POST" class="form-row">
        @csrf
        <input type="text" name="name" placeholder="Teacher name" class="form-input" required>
            <input type="email" name="email" placeholder="Email" class="form-input" required>
            <input type="password" name="password" placeholder="Password" class="form-input" required>
            <input type="password" name="password_confirmation" placeholder="Confirm password" class="form-input" required>
            <button type="submit" class="btn btn-success">Create Teacher</button>
        </form>

        <div class="grid-2">
            @foreach($teachers as $teacher)
            <div class="teacher-card">
                <h3 style="color: #2563eb; margin-bottom: 0.5rem;">{{ $teacher->name }}</h3>
                <p style="color: #6b7280; margin-bottom: 0.5rem;">{{ $teacher->email }}</p>
                <p style="margin-bottom: 1rem;">Assigned modules: {{ $teacher->assignedModules()->count() }}</p>
                <form action="{{ route('admin.remove.teacher', $teacher->id) }}" method="POST" style="display: inline;">
                    @csrf
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                        Remove Teacher
                    </button>
</form>
</div>
@endforeach
</div>
</div>

<!-- Assign Teacher to Module -->
 <div class="section-card">
    <h2 class="section-title">Assign Teacher to Module</h2>
        <form action="{{ route('admin.assign.teacher') }}" method="POST" class="form-row">
            @csrf
            <select name="module_id" class="form-input" required>
                <option value="">Select Module</option>
                @foreach($modules as $module)
                <option value="{{ $module->id }}">{{ $module->module }}</option>
                @endforeach
</select>
<select name="teacher_id" class="form-input" required>
    <option value="">Select Teacher</option>
    @foreach($teachers as $teacher)
    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
    @endforeach
</select>
<button type="submit" class="btn btn-primary">Assign</button>
</form>
</div>

<!-- User Management -->
 <div class="section-card">
    <h2 class="section-title">User Management</h2>
    <table class="data-table">
        <thead>
            <tr>
               <th>Name</th>
                    <th>Email</th>
                    <th>Current Role</th>
                    <th>Change Role</th>
                </tr>
</thead>
<tbody>
     @foreach($students as $student)
     <tr>
        <td>{{ $student->name }}</td>
        <td>{{ $student->email }}</td>
        <td>{{ $student->role->role }}</td>
        <td>
            <form action="{{ route('admin.change.role', $student->id) }}" method="POST" style="display: inline;">
                @csrf 
                <select name="user_role_id" class="form-input" onchange="this.form.submit()">
                    <option value="">Change Role</option>
                    @foreach($userRoles as $role)
                    <option value="{{ $role->id }}" {{ $student->user_role_id == $role->id ? 'selected' : '' }}>
                        {{ $role->role }}
                        </option>
                        @endforeach
</select>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
@endsection









