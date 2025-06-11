<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Stefanie Riewoldt</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    

    <!--Icons-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


</head>


<body>

    
    <?php include('header.php'); ?>

    <main>
        <section class="portfolio">
            <div class="portfoliocontainer">
                <div class="portfoliobox">
                    <div class="portfoliodetail active">
                        <p class="number">01</p>
                        <h3>Web Projekt</h3>
                        <p>Dieses Projekt ist für mich eine praktische Lernplattform, auf der ich Schritt für Schritt meine Fähigkeiten in Webentwicklung ausbaue. Bevor ich damit angefangen habe, hatte ich keinerlei Vorkenntnisse – selbst in meiner Umschulung steht das Modul zu HTML und CSS erst später an. Deshalb habe ich mir alles komplett selbst beigebracht und experimentiere hier aktiv mit HTML, CSS und JavaScript.
                        <br><br>Ein wichtiger Bestandteil ist auch der eingerichtete Server mit Datenbankanbindung, über die ich beispielsweise meinen Lebenslauf zum Download bereitstelle.
                        Da ich mich ständig weiterentwickeln möchte, plane ich, zukünftig weitere Webentwicklungstools kennenzulernen. Meine Website wird sich deshalb immer wieder verändern und weiterentwickeln – als lebendiger Beweis meines Lernfortschritts.</p>
                        <div class="tech">
                            <h3></h3>
                            <p>HTML, CSS, JavaScript</p>
                        </div>
                        <div class="github">
                            <a href="https://github.com/Penny1990/website-portfolio"><i class='bx bxl-github'></i><span>Github Repository</span></a>
                        </div>
                    </div>

                    <div class="portfoliodetail">
                        <p class="number">02</p>
                        <h3>Tetris</h3>
                        <p>PennysTetris ist mein aktuelles Lernprojekt und gleichzeitig mein Einstieg in Python und Pygame. Dabei setze ich die klassische Tetris-Mechanik auf einem 20x10-Gitter um, auf dem Tetrominos – die typischen vier-Block-Formationen – 
                        dynamisch generiert und grafisch dargestellt werden. <br> <br>Die grundlegende Rendering-Pipeline läuft bereits, inklusive einer Sidebar für die Vorschau des nächsten 
                        Steins und die Punkteanzeige. Der Fokus liegt aktuell auf der Implementierung von Bewegung, Rotation sowie präziser Kollisions- und Kantenprüfung. Dabei baue ich das Spiel in meinem eigenen Stil mit einer individuellen Farbpalette, 
                        die dem klassischen Design eine persönliche Note verleiht. <br> <br>Das Projekt dient mir als praxisnahes Experiment, um Konzepte wie Event-Handling, zeitgesteuerte 
                        Aktionen und modulare Softwarearchitektur zu vertiefen.</p>
                        <div class="tech">
                            <p>Python, Pygame</p>
                        </div>
                        <div class="github">
                            <a href="https://github.com/Penny1990/tetris"><i class='bx bxl-github'></i><span>Github Repository</span></a>
                        </div>
                    </div>
                <!-- Placeholder               
                    <div class="portfoliodetail">
                        <p class="number">03</p>
                        <h3>Python Projekt</h3>
                        <p>Tetris..... In Arbeit .. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, nemo.</p>
                        <div class="tech">
                            <p>Python, Pygame</p>
                        </div>
                        <div class="github">
                            <a href="#"><i class='bx bxl-github'></i><span>Github Repository</span></a>
                        </div>
                    </div>

                    <div class="portfoliodetail">
                        <p class="number">04</p>
                        <h3>Python Projekt</h3>
                        <p>Tetris..... In Arbeit .. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, nemo.</p>
                        <div class="tech">
                            <p>Python, Pygame</p>
                        </div>
                        <div class="github">
                            <a href="#"><i class='bx bxl-github'></i><span>Github Repository</span></a>
                        </div>
                    </div>

                    <div class="portfoliodetail">
                        <p class="number">05</p>
                        <h3>Python Projekt</h3>
                        <p>Tetris..... In Arbeit .. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, nemo.</p>
                        <div class="tech">
                            <p>Python, Pygame</p>
                        </div>
                        <div class="github">
                            <a href="#"><i class='bx bxl-github'></i><span>Github Repository</span></a>
                        </div>
                    </div>
                </div>
            -->
                <div class="portfoliobox">
                    <div class="portfoliocarousel">
                        <div class="imageslide">
                            <div class="imageitem">
                                <img src="images/placeholder1.png">
                            </div>
                            <div class="imageitem">
                                <img src="images/placeholder2.png">
                            </div>
                    <!--    <div class="imageitem">
                                <img src="images/placeholder3.png">
                            </div>
                            <div class="imageitem">
                                <img src="images/placeholder4.png">
                            </div>
                            <div class="imageitem">
                                <img src="images/placeholder5.png">
                            </div>
                            <div class="imageitem">
                                <img src="images/placeholder6.png">
                            </div> -->
                        </div>
                    </div>

                    <div class="navigation">
                        <button class="arrowleft disabled"><i class='bx bx-chevron-left'></i></button>
                        <button class="arrowright"><i class='bx bx-chevron-right' ></i></button>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <script src="js/script.js"></script>

</body>


</html>


