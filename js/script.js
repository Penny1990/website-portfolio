const menuIcon = document.querySelector('#menu');
const navbar = document.querySelector('header nav');

menuIcon.addEventListener('click', () => {
    menuIcon.classList.toggle('bx-x');
    navbar.classList.toggle('active');
});


const profilebuttons = document.querySelectorAll('.profilebutton');

if (profilebuttons.length > 0) {
    profilebuttons.forEach((btn, idx) => {
        btn.addEventListener('click', () => {
            const profileDetails = document.querySelectorAll('.profiledetail');

            profilebuttons.forEach(btn => {
                btn.classList.remove('active');
            });
            btn.classList.add('active');

            profileDetails.forEach(detail => {
                detail.classList.remove('active');
            });
            
            if (profileDetails[idx]) {
                profileDetails[idx].classList.add('active');
            }
        });
    });
}

// HIER BEGINNT DER PORTFOLIO-CODE-BLOCK FÜR SOFORTIGES AUSGRAUEN (MIT maxIndex = 2)
const portfolioBox = document.querySelector('.portfoliobox');
if (portfolioBox) {
    const arrowRight = portfolioBox.querySelector('.navigation .arrowright');
    const arrowLeft = portfolioBox.querySelector('.portfoliobox .navigation .arrowleft');

    let index = 0;

    // MaxIndex ist 2 für 3 Elemente (0, 1, 2)
    const maxIndex = 2; // Dies ist der letzte gültige Index!

    // HELFER-FUNKTION: Aktualisiert den Zustand der Pfeile basierend auf dem aktuellen Index
    // Diese Funktion sorgt dafür, dass die Pfeile sofort ausgegraut werden, wenn der Index die Grenze erreicht
    const updateArrowStates = () => {
        if (arrowLeft) {
            if (index === 0) { // Wenn am Anfang (Index 0)
                arrowLeft.classList.add('disabled');
            } else {
                arrowLeft.classList.remove('disabled'); // Ansonsten aktivieren
            }
        }

        if (arrowRight) {
            if (index === maxIndex) { // Wenn am Ende (Index 2)
                arrowRight.classList.add('disabled');
            } else {
                arrowRight.classList.remove('disabled'); // Ansonsten aktivieren
            }
        }
    };

    const activePortfolio = () => {
        const imgSlide = portfolioBox.querySelector('.portfoliocarousel .imageslide');
        const portfolioDetails = portfolioBox.querySelectorAll('.portfoliodetail');

        if (imgSlide) {
            imgSlide.style.transform = `translateX(calc(${index * -100}% - ${index * 2}rem))`;
        }

        portfolioDetails.forEach(detail => {
            detail.classList.remove('active');
        });
        if (portfolioDetails[index]) {
            portfolioDetails[index].classList.add('active');
        }
    };

    // Event-Listener für den rechten Pfeil
    if (arrowRight) {
        arrowRight.addEventListener('click', () => {
            if (index < maxIndex) { // Wenn der Index kleiner ist als 2 (also 0 oder 1)
                index++; // Index erhöhen
            }
            activePortfolio();      // Inhalt wechseln
            updateArrowStates();    // Pfeil-Status sofort aktualisieren
        });
    }

    // Event-Listener für den linken Pfeil
    if (arrowLeft) {
        arrowLeft.addEventListener('click', () => {
            if (index > 0) { // Wenn der Index größer als 0 ist (also 1 oder 2)
                index--; // Index verringern
            }
            activePortfolio();      // Inhalt wechseln
            updateArrowStates();    // Pfeil-Status sofort aktualisieren
        });
    }

    // Initialer Aufruf beim Laden der Portfolioseite
    // Setzt den Startzustand der Pfeile und zeigt das erste Portfolio-Element
    activePortfolio();      // Zeigt das erste Element an (Index 0)
    updateArrowStates();    // Setzt den Pfeil-Status für den Start (linker Pfeil disabled)

} // ENDE DES PORTFOLIO-CODE-BLOCKS


  
  


document.addEventListener('DOMContentLoaded', function() {
    const currentMainSection = document.querySelector('main section');
    if (currentMainSection) {
        currentMainSection.classList.add('active');
    }
});