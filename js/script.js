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


const portfolioBoxes = document.querySelectorAll('.portfoliobox');
const carouselPortfolioBox = portfolioBoxes[1];
const textPortfolioBox = portfolioBoxes[0];

if (carouselPortfolioBox && textPortfolioBox) {

    const arrowRight = carouselPortfolioBox.querySelector('.navigation .arrowright');
    const arrowLeft = carouselPortfolioBox.querySelector('.navigation .arrowleft');

    let index = 0;
    const maxIndex = 2; 

    
    const updateArrowStates = () => {
        if (arrowLeft) {
            if (index === 0) { // 
                arrowLeft.classList.add('disabled');
            } else {
                arrowLeft.classList.remove('disabled'); 
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
        const imgSlide = carouselPortfolioBox.querySelector('.portfoliocarousel .imageslide');
        const portfolioDetails = textPortfolioBox.querySelectorAll('.portfoliodetail');

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
    
    if (arrowRight) {
        arrowRight.addEventListener('click', () => {
            if (index < maxIndex) { 
                index++; 
            }
            activePortfolio();      
            updateArrowStates();    
        });
    }

    if (arrowLeft) {
        arrowLeft.addEventListener('click', () => {
            if (index > 0) { 
                index--; 
            }
            activePortfolio();     
            updateArrowStates();    
        });
    }


    activePortfolio();      
    updateArrowStates();    

} 


  
  


document.addEventListener('DOMContentLoaded', function() {
    const currentMainSection = document.querySelector('main section');
    if (currentMainSection) {
        currentMainSection.classList.add('active');
    }
});



function closeqrgruss() {
  const el = document.getElementById('qrgruss');
  if (el) {
    el.style.display = 'none';
  }
}