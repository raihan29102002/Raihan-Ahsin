<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> event </title>
    <link rel="stylesheet" href="event.css" />
</head>

<body>

    <header>
        <div class="logo">
            <img src="logo.png">
        </div>
        <nav>
            <ul>
                <li> <a href="index.php"> Home</a></li>
                <li> <a href="#" id="agendaLink"> Agenda</a></li>
                <li> <a href="#" id="speakerLink"> Speaker</a></li>
                <li> <a href="#" id="sponsorLink"> Become Our Sponsor</a></li>
                <li> <a href="#" id="contactsLink">Contacts</a></li>
                <li> <a href="login/acara_tambah.php"> Tambah Acara</a></li>
            </ul>
        </nav>
        <div class="login">
            <a href="login/signupp.php">DAFTAR</a>
            <a href="login/loginn.php">LOGIN</a>

        </div>
    </header>

    <div class="event1">
        <img src="event1.png">
    </div>

    <div class="container">
        <div class="card">
            <img src="icon1.png" alt="Gambar 1">
            <div class="card-content">
                <h1>250</h1>
                <p>Participant</p>
            </div>
        </div>

        <div class="card">
            <img src="icon2.png" alt="Gambar 2">
            <div class="card-content">
                <h1>3</h1>
                <p>Speakers</p>
            </div>
        </div>

        <div class="card">
            <img src="icon3.png" alt="Gambar 3">
            <div class="card-content">
                <h1>15</h1>
                <p>Exhibitions</p>
            </div>
        </div>
    </div>

    <div class="kata">
        <h1>- Post Conference Highlights -
            <br> Transformational Sales Conference 2023
        </h1>
    </div>

    <div class="youtube-video">

        <iframe width="760" height="400" src="https://www.youtube.com/embed/Kgrumz_76RI?si=6h80nJk78g8kST8T"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

    </div>

    <div class="kata1">
        <h1>From Transaction to Transformation: The New Sales Paradigm</h1>
        <p>About the Conference</p>
    </div>

    <div class="grid-container">
        <div class="item">
            <h1>Introduction</h1>
            <p>Don't find customers for your products, find products for your customers." ~ Seth GodinIt's crucial to
                adapt to the changing sales landscape in the digital age, and Seth Godin's quote emphasizes the
                importance of customer-centricity. Digital transformation has indeed shift</p>
            <a href="#">Read More </a>
        </div>
        <div class="item">
            <h1>What We Offer</h1>
            <p>Dynamic Keynote Speakers: Join us for insightful keynote presentations from industry experts and thought
                leaders who have successfully embraced the new sales paradigm. Gain valuable knowledge and strategies
                directly from those who have navigated this transformation.</p>
            <a href="#">Read More</a>
        </div>
        <div class="item">
            <h1>Why it Matters</h1>
            <p>The shift from transactions to transformation is a critical development in the world of sales. Attending
                this conference will equip you with the knowledge and strategies needed to thrive in this evolving
                landscape, deepen customer relationships, and achieve sustainable growth </p>
        </div>
        <div class="item">
            <h1>Join Us</h1>
            <p>We invite you to be a part of this transformative experience. Register today and secure your spot at the
                "From Transaction to Transformation: The New Sales Paradigm" conference. Together, we'll explore the
                future of sales and discover how to adapt and thrive in this new era.</p>
        </div>
    </div>


    <div class="agenda">

        <h1>The Agenda </h1>
        <p>Don't Miss a Topic on the Conference</p>

    </div>

    <div class="container-agenda">
        <img src="1.png" alt="Gambar">
        <img src="2.png" alt="Gambar">
        <img src="3.png" alt="Gambar">
        <img src="4.png" alt="Gambar">
        <img src="5.png" alt="Gambar">
        <img src="6.png" alt="Gambar">
        <img src="7.png" alt="Gambar">
        <img src="8.png" alt="Gambar">
        <img src="9.png" alt="Gambar">
        <img src="10.png" alt="Gambar">
        <img src="11.png" alt="Gambar">
    </div>

    <div class="button-agenda">
        <a href="eventRSVP.php">Grab Your RSVP Now</a>
    </div>

    <div class="speaker">
        <h1>The Speakers</h1>
        <p>Listen, Learn, Get Connected</p>

        <img src="speaker1.png" alt="Gambar">
        <img src="speaker2.png" alt="Gambar">
        <img src="speaker3.png" alt="Gambar">
    </div>

    <div class="sponsor">

        <h1>Sponsor</h1>
        <p>They helping us make this event possible.</p>

        <img src="sponsor1.png" alt="Gambar">
    </div>

    <div class="button-sponsor">
        <a href="#">Become Our Sponsor</a>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {

        var agendaLink = document.getElementById("agendaLink");


        agendaLink.addEventListener("click", function(event) {
            event.preventDefault();


            var agendaElement = document.querySelector(".agenda");
            var offsetTop = agendaElement.offsetTop;


            window.scrollTo({
                top: offsetTop,
                behavior: "smooth"
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {

        var speakerLink = document.getElementById("speakerLink");


        speakerLink.addEventListener("click", function(event) {
            event.preventDefault();


            var speakerElement = document.querySelector(".speaker");
            var offsetTop = speakerElement.offsetTop;


            window.scrollTo({
                top: offsetTop,
                behavior: "smooth"
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {

        var sponsorLink = document.getElementById("sponsorLink");


        sponsorLink.addEventListener("click", function(event) {
            event.preventDefault();


            var sponsorElement = document.querySelector(".sponsor");
            var offsetTop = sponsorElement.offsetTop;


            window.scrollTo({
                top: offsetTop,
                behavior: "smooth"
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {

        var contactsLink = document.getElementById("contactsLink");


        contactsLink.addEventListener("click", function(event) {
            event.preventDefault();


            var contactsElement = document.querySelector(".footer-content");
            var offsetTop = contactsElement.offsetTop;


            window.scrollTo({
                top: offsetTop,
                behavior: "smooth"
            });
        });
    });
    </script>

</body>

<footer>

    <div class="footer-content">
        <div class="footer-section">
            <img src="logo.png">
            <p>Lippo Thamrin Lt.5 Jl. M.H.Thamrin No.20, <br>
                Menteng - Jakarta Pusat 10350,
                <br>Indonesia
            </p>


            <div class="footer-2">
                <ul>
                    <li> <a href="#"> Our Story</a></li>
                    <li> <a href="#"> FAQ</a></li>
                    <li> <a href="#"> Copyright</a></li>
                    <li> <a href="#"> Contact</a></li>
                </ul>
            </div>

            <div class="footer-3">
                <ul>
                    <li> <a href="#"> </a></li>
                    <li> <a href="#"> Email us</a></li>
                    <li> <a href="#"> Our linkedln</a></li>
                    <li> <a href="#"> Our Facebook</a></li>
                </ul>
            </div>


        </div>

        <div class="footer-akhir">
            <h1>Copyright © 2023 - Transformational Sales Conference. All Rights Reserved. Powered by TBN Indonesia</h1>
        </div>


</footer>

</html>