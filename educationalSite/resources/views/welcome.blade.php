<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>educationalSite</title>
        <style>
            body{
                margin:0;
                background:linear-gradient(120deg, #4facfe, #00f2fe);
                colour: white;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                text-align: center;
            }

            h1{
                font-size: 2.5rem;
                margin-bottom: 1rem:
            }

            p{
                font-size: 1.2rem;
                margin-bottom: 2rem;
            }

            a{
                color: white;
                margin: 0 10px;
                padding: 0.5rem 1rem;
                text-decoration: none;
                border: 1px solid white;
                border-radius: 5px;
                font-weight: bold;
                transition: 0.3s;
            }

            a:hover{
                background: white;
                color: #00f2fe;
            }
</style>
        </head>
        <body>
            <div>
                <h1>Welcome to educationalSite</h1>
                <p>An educational administrative site that has 4 User Types Admin, Teacher, Student, and Old Student.</p>
                <div>
                    <a href="{{url('/login')}}">Login</a>
                    <a href="{{url('/register')}}">Register</a>
        </div>
        </div>
        </body>
        </html>
        
                    
