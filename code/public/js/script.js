// JavaScript function to scroll to the top of the page
function scrollToTop() {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  }

  // Show or hide the "Go to Top" button based on scroll position
  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      document.getElementById("goToTop").style.display = "block";
    } else {
      document.getElementById("goToTop").style.display = "none";
    }
  }

  // Get the current date
function getCurrentDate() {
  const today = new Date();
  const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
  return today.toLocaleDateString('id-ID', options);
}

// Update the current date display
function updateCurrentDateDisplay() {
  const currentDateElement = document.getElementById('currentDate');
  currentDateElement.textContent = getCurrentDate();
}

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const img = entry.target;
        img.src = img.dataset.src; // Replace with actual image URL
        observer.unobserve(img); // Stop observing after loading
      }
    });
  });

  const images = document.querySelectorAll('img[data-src]');
  images.forEach((img) => observer.observe(img));

// Show or hide the current date display based on scroll position
window.addEventListener('scroll', function() {
  const currentDateElement = document.getElementById('currentDate');
  const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

  if (scrollPosition > 100) {
    currentDateElement.classList.add('d-none');
  } else {
    currentDateElement.classList.remove('d-none');
  }
});

// Initialize the current date display
updateCurrentDateDisplay();

function loadImages() {
    const images = document.querySelectorAll('img[data-src]');
    const windowHeight = window.innerHeight;

    images.forEach((img) => {
      const imgPos = img.getBoundingClientRect().top;
      const isVisible = imgPos < windowHeight;

      if (isVisible) {
        img.src = img.dataset.src;
        img.removeAttribute('data-src');
      }
    });
  }

  window.addEventListener('scroll', loadImages);
  window.addEventListener('resize', loadImages);

//counter
const counters = document.querySelectorAll('.counter');
const speed = 100; // The lower the slower

counters.forEach(counter => {
	const updateCount = () => {
		const target = +counter.getAttribute('data-target');
		const count = +counter.innerText;

		// Lower inc to slow and higher to slow
		// const inc = target / speed;
        const inc = Math.floor(target / speed);

		// console.log(inc);
		// console.log(count);

		// Check if target is reached
		if (count < target) {
			// Add inc to count and output in counter
			counter.innerText = count + inc;
			// Call function every ms
			setTimeout(updateCount, 1);
		} else {
			counter.innerText = target;
		}
	};

	updateCount();
});

window.addEventListener('load', function() {
    const loading = document.getElementById('loading');
    const content = document.getElementById('content');

    loading.style.display = 'none';
    // content.style.display = 'block';
});
