let circle = document.querySelector('.circle');
let slider = document.querySelector('.slider');
let list = document.querySelector('.list');
let prev = document.getElementById('prev');
let next = document.getElementById('next');
let items = document.querySelectorAll('.list .item');
let count = items.length;
let active = 0;
let leftTransform = 0;
let width_item = items[active].offsetWidth;

// Function to run carousel
function runCarousel() {
    prev.style.display = (active == 0) ? 'none' : 'block';
    next.style.display = (active == count - 1) ? 'none' : 'block';

    let old_active = document.querySelector('.item.active');
    if (old_active) old_active.classList.remove('active');
    items[active].classList.add('active');

    leftTransform = width_item * (active - 1) * -1;
    list.style.transform = `translateX(${leftTransform}px)`;
}

// Move to the next item
next.onclick = () => {
    active = active >= count - 1 ? count - 1 : active + 1;
    runCarousel();
}

// Move to the previous item
prev.onclick = () => {
    active = active <= 0 ? active : active - 1;
    runCarousel();
}

// Automatically slide the carousel every 3 seconds
let autoSlide = setInterval(() => {
    active = active >= count - 1 ? 0 : active + 1;  // Reset to first item if at the end
    runCarousel();
}, 3000);  // 3000ms = 3 seconds

// Reset the interval when manually navigating
next.onclick = () => {
    clearInterval(autoSlide); // Stop auto sliding
    active = active >= count - 1 ? count - 1 : active + 1;
    runCarousel();
    autoSlide = setInterval(() => {  // Restart auto sliding
        active = active >= count - 1 ? 0 : active + 1;
        runCarousel();
    }, 3000);
};

prev.onclick = () => {
    clearInterval(autoSlide); // Stop auto sliding
    active = active <= 0 ? 0 : active - 1;
    runCarousel();
    autoSlide = setInterval(() => {  // Restart auto sliding
        active = active >= count - 1 ? 0 : active + 1;
        runCarousel();
    }, 3000);
};

// Initialize carousel
runCarousel();

// Set Text on a Circle
let textCircle = circle.innerText.split('');
circle.innerText = '';
textCircle.forEach((value, key) => {
    let newSpan = document.createElement("span");
    newSpan.innerText = value;
    let rotateThisSpan = (360 / textCircle.length) * (key + 1);
    newSpan.style.setProperty('--rotate', rotateThisSpan + 'deg');
    circle.appendChild(newSpan); 
});
