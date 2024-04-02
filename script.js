// Get the audio element
const clickSound = document.getElementById('clickSound');

// Get all the buttons
const buttons = document.querySelectorAll('.button');

// Add click event listener to each button
buttons.forEach(button => {
    button.addEventListener('click', () => {
        // Play the click sound
        clickSound.play();
    });
});
window.onload = function() {
    alert("Today's Special: Jalebi - Just waiting for you!");
}
function toggleOptions(optionId) {
    var option = document.getElementById(optionId);
    if (option.style.display === "block") {
        option.style.display = "none";
    } else {
        option.style.display = "block";
    }
}

// Function to fetch meme quote of the day
function fetchMemeQuote() {
    fetch('https://foodish-api.com/api/')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data && data.image) {
                document.getElementById('foodQuote').innerHTML = `<img src="${data.image}" alt="Food Meme">`;
            } else {
                throw new Error('Invalid response format');
            }
        })
        .catch(error => {
            console.error('Error fetching meme quote:', error);
            document.getElementById('foodQuote').textContent = 'Failed to fetch food meme.';
        });
}



