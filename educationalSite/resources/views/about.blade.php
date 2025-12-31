<?php $pagetitle ='about';?>
<!DOCTYPE html>
<html>
    <head>
        <title>About</title>
        <link rel="stylesheet" href="style.css">
</head>
<body>
    @include('header')

    <section class="hero">
        <div class="hero-container">
            <h1>About Us</h1>
            <p>Find out more about our educational site and how we support the achievement of both teachers and students.</p>
</div>
</section>

<section class="about-info">
    <div class="about-container">

    <div class="info-box">
        <img src="images/Mission.png" alt="Mission">
        <h2>Our Mission</h2>
        <p>Our goal is to give teachers, administrators, and students a smooth educational experience.</p>
</div>

<div class="info-box">
    <img src="images/Vision.jpg" alt="Vision">
    <h2>Our Vision</h2>
    <p>Our goal is to make educational material management and learning easy and efficient.</p>
</div>

<div class="info-box">
    <img src="images/Core.png" alt="Core">
    <h2>Our Core Values</h2>
    <ul class="core-values">
        <li><strong>Innovation:</strong>We make regular upgrades to our platform using the newest concepts and technology.</li>
        <li><strong>Integrity:</strong>We continue to be open and honest to all users.</li>
        <li><strong>Accessibility:</strong>Everyone should have access to education at any time and from any location.</li>
        <li><strong>Collaboration:</strong>We encourage collaboration among the teachers, administrators, and students.</li>
</ul>
</div>

<div class="info-box">
    <img src="images/Works.jpg" alt="How it works">
    <h2>How It Works</h2>
    <ol class="how-it-works">
        <li>Students register and view available modules for enrollment.</li>
        <li>Teachers are given modules and have the authority to watch over their students development.</li>
        <li>Administrators manage users, modules, and platform settings efficiently.</li>
        <li>Everyone can track progress and view completed modules.</li>
</ol>
</div>

</div>
</section>
@include('footer')
</body>
</html>




        

