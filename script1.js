window.addEventListener('scroll', revealOnScroll);

function revealOnScroll() {
  var revealElements = document.querySelectorAll('.slogan');
  var additionalContent = document.querySelectorAll('.about');
  var thirdPart = document.querySelectorAll('.footer');
  
  for (var i = 0; i < revealElements.length; i++) {
    var windowHeight = window.innerHeight;
    var revealTop = revealElements[i].getBoundingClientRect().top;
    var revealPoint = 50;

    if (revealTop < windowHeight - revealPoint) {
      revealElements[i].classList.add('active');
    } else {
      revealElements[i].classList.remove('active');
    }
  }
  for (var i = 0; i < additionalContent.length; i++) {
    var windowHeight = window.innerHeight;
    var contentTop = additionalContent[i].getBoundingClientRect().top;
    var revealPoint = 50;

    if (contentTop < windowHeight - revealPoint) {
      additionalContent[i].classList.add('active');
    } else {
      additionalContent[i].classList.remove('active');
    }
  }
  for (var i = 0; i < thirdPart.length; i++) {
    var windowHeight = window.innerHeight;
    var partTop = thirdPart[i].getBoundingClientRect().top;
    var revealPoint = 50;

    if (partTop < windowHeight - revealPoint) {
      thirdPart[i].classList.add('active');
    } else {
      thirdPart[i].classList.remove('active');
    }
  }




}

// JavaScript code to populate social media links
document.addEventListener("DOMContentLoaded", function() {
  var follow2Div = document.querySelector(".follow2");

  // Loop through the social media links JSON data and create <a> elements
  socialMediaLinks.forEach(function(link) {
      var socialLink = document.createElement("a");
      socialLink.href = link.url;
      socialLink.classList.add("fa", "fa-" + link.platform.toLowerCase());
      follow2Div.appendChild(socialLink);
  });
});