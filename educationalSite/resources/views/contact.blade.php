<?php $pagetitle ='contact';?>
<!DOCTYPE html>
<html>
    <head>
        <title>Contact</title>
        <link rel="stylesheet" href="style.css">
</head>
<body>
    @include('header')

    <section class="hero">
        <div class="hero-container">
            <h1>Contact Us</h1>
            <p>Contact us for questions, support, and feedback.</p>
</div>
</section>

    <section  class="about-info">
            <h2>Contact Us</h2>
            <p>Do you have any questions regarding modules, enrollment, and account, feel free to contact us using the details below.</p>
            <ul class="core-values">
                <li><strong>Email:</strong>dsmriti23@tbc.edu.np</li>
                <li><strong>Phone:</strong>9876543210</li>
                <li><strong>Open:</strong>Mon-Fri, 9am-4pm</li>
</ul>
</div>

<div class="info-box">
    <h2>Send a Message</h2>
    <form action="{{route('contact.send')}}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Name" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <textarea  name="message" rows="5" placeholder="Message" required></textarea><br><br>
        <button type="submit" class="register-button">
            Send Message
</button>
</form>
</div>
</div>
</section>
@include('footer')
</body>
</html>
