// Get the dropdown container (the element that will receive 'is-active' class)
const profileDropdown = document.querySelector('.profile-dropdown');

// Get the profile picture (the clickable trigger)
const profilePic = document.querySelector('.profile-avatar');

// Add click event to profile picture
profilePic.addEventListener('click', (e) => {
    console.log("Profile picture clicked");

    // Stop the event from bubbling up to document
    // This prevents the "click outside" handler from running immediately
    e.stopPropagation();

    // Toggle the 'is-active' class on the dropdown container
    // This makes the CSS rule .dropdown.is-active .dropdown-menu work
    profileDropdown.classList.toggle('is-active');
});

// Close dropdown when clicking outside of it
document.addEventListener('click', (e) => {
    // Check if the clicked element is NOT inside the dropdown
    if (!profileDropdown.contains(e.target)) {
        // Remove 'is-active' class to hide dropdown
        profileDropdown.classList.remove('is-active');
    }
});

// Optional: Handle dropdown item clicks
const dropdownItems = document.querySelectorAll('.dropdown-item');
dropdownItems.forEach(item => {
    item.addEventListener('click', (e) => {
        // Prevent default link behavior for demo
        e.preventDefault();

        // Get the text of the clicked item
        const action = item.querySelector('span').textContent;

        // Close dropdown after clicking an item
        profileDropdown.classList.remove('is-active');

        // Handle the action (replace this with your actual navigation logic)
        console.log(`Action clicked: ${action}`);

        // Example: You can add actual navigation here
        // if (action === 'Logout') {
        //     window.location.href = '/logout';
        // }
    });
});
