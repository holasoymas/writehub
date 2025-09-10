<div class="modal-overlay" id="authModal">
    <div class="modal-box">

        <div class="modal-title" id="modalTitle">
            Authentication Required
        </div>

        <div class="modal-message" id="modalMessage">
            You need to be logged in to perform this action.
        </div>

        <!-- Modal buttons -->
        <div class="modal-buttons">
            <button class="modal-btn modal-btn-primary">
                Sign In
            </button>
            <button
                class="modal-btn modal-btn-secondary"
                onclick="document.getElementById('authModal').classList.remove('is-active');
                         document.documentElement.classList.remove('is-clipped');"
                >
                Cancel
            </button>
        </div>
    </div>
</div>
