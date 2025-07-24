<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EmPowerAI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #fdfdfd;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* This ensures full height */
        }

        header {
            background: #facc15;
            padding: 1rem 2rem;
            text-align: center;
            font-weight: 600;
            font-size: 1.2rem;
        }

        footer {
            background: #fef9c3;
            padding: 1rem 2rem;
            text-align: center;
            font-size: 0.9rem;
            color: #555;
        }

        .container {
            flex: 1; /* pushes the footer down */
            padding: 20px;
        }

        .chatbot-float-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #f8b500;
            color: white;
            font-size: 28px;
            padding: 18px 20px;
            border-radius: 50%;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            z-index: 999;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }

        .chatbot-float-button:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 18px rgba(0,0,0,0.3);
            background-color: #ffbb00;
        }

        footer {
            background-color: #f8b500;
            text-align: center;
            padding: 15px;
            font-size: 0.9rem;
        }

    </style>
</head>
<body>
    <header style="display: flex; align-items: center; justify-content: space-between; padding: 10px;">
        <img src="{{ asset('images/logo-richworks.png') }}" alt="RichWorks Logo" style="height: 70px;">

        <!-- WhatsApp Contact + Hamburger Menu -->
        <div style="display: flex; align-items: center; gap: 20px;">
            <!-- WhatsApp Contact Text -->
            <a href="https://wa.me/60123456789" target="_blank" style="
                font-size: 14px;
                font-weight: 500;
                color: #047857;
                text-decoration: none;
                background-color: #ecfdf5;
                padding: 6px 12px;
                border-radius: 8px;
                border: 1px solid #d1fae5;
                transition: background 0.3s;
            " onmouseover="this.style.background='#d1fae5'" onmouseout="this.style.background='#ecfdf5'">
                📞 Need help? Contact us via WhatsApp
            </a>

        <!-- Hamburger icon -->
        <img src="{{ asset('images/Hamburger_icon.png') }}" alt="Menu" style="height: 40px; cursor: pointer;" onclick="openMenu()">
    </header>

    <!-- Sidebar Menu -->
    <div id="sidebarMenu" style="
        position: fixed;
        top: 0;
        right: -100%;
        width: 33.33%;
        max-width: 300px;
        height: 100%;
        background: linear-gradient(135deg, #f9f9f9, #ffffff);
        box-shadow: -4px 0 12px rgba(0, 0, 0, 0.2);
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        transition: right 0.3s ease-in-out;
        z-index: 9999;
        padding: 30px 25px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    ">

        <button onclick="closeMenu()" style="
            background: none;
            border: none;
            font-size: 26px;
            font-weight: bold;
            float: right;
            cursor: pointer;
            color: #888;
            transition: color 0.3s;
        " onmouseover="this.style.color='#000'" onmouseout="this.style.color='#888'">&times;</button>

        <h2 style="margin-top: 40px; font-size: 22px; font-weight: 600; color: #333;">Menu</h2>

        <ul style="list-style: none; padding: 0; margin-top: 30px;">
            <li style="margin: 15px 0;">
                <a href="https://richworks.com/" target="_blank" style="
                    text-decoration: none;
                    font-size: 18px;
                    color: #333;
                    padding: 10px 15px;
                    display: block;
                    border-radius: 8px;
                    transition: background 0.3s, color 0.3s;
                " onmouseover="this.style.background='#e0f2ff'; this.style.color='#0077cc';" onmouseout="this.style.background=''; this.style.color='#333';">
                    About
                </a>
            </li>

            <li style="margin: 15px 0;">
                <a href="https://richworks.com/" target="_blank" style="
                    text-decoration: none;
                    font-size: 18px;
                    color: #333;
                    padding: 10px 15px;
                    display: block;
                    border-radius: 8px;
                    transition: background 0.3s, color 0.3s;
                " onmouseover="this.style.background='#e0f2ff'; this.style.color='#0077cc';" onmouseout="this.style.background=''; this.style.color='#333';">
                    News
                </a>
            </li>

            <li style="margin: 15px 0;">
                <a href="#contactSection" style="
                    text-decoration: none;
                    font-size: 18px;
                    color: #333;
                    padding: 10px 15px;
                    display: block;
                    border-radius: 8px;
                    transition: background 0.3s, color 0.3s;
                " onmouseover="this.style.background='#e0f2ff'; this.style.color='#0077cc';" onmouseout="this.style.background=''; this.style.color='#333';">
                    Contact
                </a>
            </li>

        </ul>
    </div>




    <div class="container">
        @yield('content')
        @yield('styles')

    </div>

    <div id="contactSection" style="margin-top: 60px; text-align: center;">
        <h2>Contact Us</h2>
        <p>Have questions? Reach out to us on social media or send us an email.</p>

        <div style="margin-top: 20px; display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
            <a href="https://facebook.com" target="_blank">
                <img src="{{ asset('images/facebook.jpg') }}" alt="Facebook" style="height: 50px;">
            </a>
            <a href="https://instagram.com" target="_blank">
                <img src="{{ asset('images/istagram.avif') }}" alt="Instagram" style="height: 50px;">
            </a>
            <a href="https://linkedin.com" target="_blank">
                <img src="{{ asset('images/linkedIn.jpg') }}" alt="LinkedIn" style="height: 50px;">
            </a>
            <a href="https://twitter.com" target="_blank">
                <img src="{{ asset('images/twitter.png') }}" alt="Twitter" style="height: 50px;">
            </a>
            <a href="https://youtube.com" target="_blank">
                <img src="{{ asset('images/youtube.png') }}" alt="YouTube" style="height: 50px;">
            </a>
        </div>

        <p style="margin-top: 20px;">
            Or email us: <a href="mailto:info@richworks.com" style="color: #0077cc;">info@richworks.com</a>
        </p>
    </div>


    <footer>
        &copy; {{ date('Y') }} EmPowerAI. All rights reserved.
    </footer>

    <script>
        function openMenu() {
            document.getElementById("sidebarMenu").style.right = "0";
        }

        function closeMenu() {
            document.getElementById("sidebarMenu").style.right = "-100%";
        }
    </script>

</body>
</html>
