// Function to show modal with custom title and message
export function showErrorBox(title = 'Authentication Required', message = 'You need to be logged in to perform this action.') {
    // Set custom title and message
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalMessage').textContent = message;

    if (title === 'Validation Error') {
        document.querySelector(".modal-btn.modal-btn-primary").style.display = "none";
    }

    // Show modal
    document.getElementById('authModal').classList.add('is-active');

    document.documentElement.classList.add("is-clipped"); // 🔒 disable background scroll
}

// Function to hide modal
export function hideErrorBox() {

    document.getElementById('authModal').classList.remove('is-active');

    document.documentElement.classList.remove("is-clipped"); // 🔒 re-enable background scroll
}

