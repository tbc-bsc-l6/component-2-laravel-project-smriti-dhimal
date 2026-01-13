@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('dashboard.css') }}">

<div class="container">
    <div class="dashboard-header">
        <h1>Admin Dashboard</h1>
        <p>Welcome, {{ auth()->user()->name }}!</p>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!--MODULE MANAGEMENT-->
    <div class="section-card">
        <h2 class="section-title">Module Management</h2>

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
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($modules as $module)
                    <tr>
                        <td>{{ $module->module }}</td>
                        <td>{{ $module->teacher?->name ?? 'Not Assigned' }}</td>
                        <td>{{ $module->activeStudents->count() }} / 10</td>
                        <td>
                            <span class="status-badge {{ $module->available ? 'status-available' : 'status-unavailable' }}">
                                {{ $module->available ? 'Available' : 'Unavailable' }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('admin.toggle.module', $module->id) }}" method="POST">
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

    <!--STUDENT MODULE MANAGEMENT-->
    <div class="section-card">
        <h2 class="section-title">Student Module Management</h2>

        @foreach($modules as $module)
            @if($module->activeStudents->count() > 0)
                <div class="module-section">
                    <h3 class="module-title">
                        {{ $module->module }} — Active Students ({{ $module->activeStudents->count() }})
                    </h3>

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
                            @foreach($module->activeStudents as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>
                                        {{ $student->pivot->start_date
                                            ? date('M d, Y', strtotime($student->pivot->start_date))
                                            : 'N/A'
                                        }}
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.remove.student.module', [$module->id, $student->id]) }}"
                                              method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-danger"
                                                onclick="return confirm('Remove {{ $student->name }} from {{ $module->module }}?')">
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        @endforeach
    </div>

    <!--TEACHER MANAGEMENT-->
    <div class="section-card">
        <h2 class="section-title">Teacher Management</h2>

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
                    <h3>{{ $teacher->name }}</h3>
                    <p>{{ $teacher->email }}</p>
                    <p>Assigned modules: {{ $teacher->assignedModules->count() }}</p>

                    <form action="{{ route('admin.remove.teacher', $teacher->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure?')">
                            Remove Teacher
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    <!--ASSIGN TEACHER-->
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

    <!--USER MANAGEMENT-->
    <div class="section-card">
        <h2 class="section-title">User Management</h2>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
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
                            <form action="{{ route('admin.change.role', $student->id) }}" method="POST">
                                @csrf
                                <select name="user_role_id" class="form-input"
                                        onchange="this.form.submit()">
                                    @foreach($userRoles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ $student->user_role_id == $role->id ? 'selected' : '' }}>
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
