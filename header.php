<?php $currentPage = basename($_SERVER['PHP_SELF']); ?>

<header class="active">
        <a href="index.php" class="logo">Stefanie.</a>

        <i class="bx bx-menu" id="menu"></i>

        <nav>
            <a href="index.php" class="<?php if ($currentPage == 'index.php') echo 'active'; ?>">Startseite</a>
            <a href="ueber-mich.php" class="<?php if ($currentPage == 'ueber-mich.php') echo 'active'; ?>">Über mich</a>
            <a href="bildung.php" class="<?php if ($currentPage == 'bildung.php') echo 'active'; ?>">Bildung</a>
            <a href="portfolio.php" class="<?php if ($currentPage == 'portfolio.php') echo 'active'; ?>">Projekte</a>
            <a href="kontakt.php" class="<?php if ($currentPage == 'kontakt.php') echo 'active'; ?>">Kontakt</a>
        </nav>
    </header>