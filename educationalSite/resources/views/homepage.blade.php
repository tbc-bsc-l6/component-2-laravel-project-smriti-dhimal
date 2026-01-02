<?php $pagetitle ='home';?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home Page</title>
        <link rel="stylesheet" href="style.css">
</head>
<body>
    @include('header')

    <section class="hero">
        <div class="hero-container">
            <h1>This is the Home Page</h1>
            <p>This is an educational administrative site that has four user types:</p>
            <ul class="user-types">
                 <li>Admin</li>
                <li>Teacher</li>
                <li>Current Student</li>
                <li>Old Student</li>
            </ul>
            <a href="/register" class="register-button">Get Started</a>
        </div>
    </section>

    <section class="features">
        <h2>Site Functionalities</h2>
        <div class="feature-cards">
            <div class="card">
                <img src="images/admin.webp" alt="Admin">
                <h3>Administrators</h3>
                <ul>
                    <li>Admin accounts are created via seeder</li>
                    <li>Add or remove modules</li>
                    <li>Create or remove teachers</li>
                    <li>Remove students from modules</li>
                    <li>Attach teachers to modules</li>
                    <li>Change user roles</li>
                    <li>Toggle module availability</li>
</ul>
</div>

<div class="card">
    <img src="images/teacher.webp" alt="Teacher">
    <h3>Teachers</h3>
    <ul>
        <li>Accounts created by admin</li>
        <li>View assigned modules</li>
        <li>View students in their modules</li>
        <li>Set PASS / FAIL for students (timestamps completion)</li>
</ul>
</div>

<div class="card">
    <img src="images/currentstudent.jpg" alt="Current Student">
    <h3>Current Students</h3>
    <ul>
        <li>Enroll in max 4 modules</li>
        <li>View completed modules with PASS / FAIL</li>
        <li>See modules available for enrollment</li>
        <li>Sign up to the site</li>
</ul>
</div>

<div class="card">
    <img src="images/oldstudent.jpg" alt="Old Student">
    <h3>Old Students</h3>
    <ul>
        <li>View history of completed modules</li>
        <li>See PASS / FAIL status only</li>
</ul>
</div>

</div>
</section>

<section class="modules-info">
    <h2>Module Rules</h2>
    <ul>
        <li>Each module can have max 10 students</li>
            <li>Full modules cannot accept new students until a spot is free</li>
            <li>Archiving a module keeps history visible to students</li>
            <li>Modules show enrollment date, pass/fail, and completion date</li>
</ul>
</section>
@include('footer')
</body>
</html>
