
// Mobile menu toggle
document.addEventListener('DOMContentLoaded', () => {

    document.getElementById('show-followers').addEventListener('click', showFollowersModal);
    document.getElementById('show-followings').addEventListener('click', showFollowingModal);

    document.querySelector('#followers-close-btn').addEventListener('click', () => closeModal('followersModal'));
    document.querySelector('#following-close-btn').addEventListener('click', () => closeModal('followingModal'));

    // close on click area outside of that followerers/ following box
    document.querySelector('#followersModal').addEventListener('click', () => closeModal('followersModal'));
    document.querySelector('#followingModal').addEventListener('click', () => closeModal('followingModal'));

    // Tab switching functionality
    function switchTab(tabName) {
        // Hide all tab contents
        const tabContents = document.querySelectorAll('.tab-content');
        tabContents.forEach(content => {
            content.classList.remove('is-active');
        });

        // Remove active class from all tabs
        const tabs = document.querySelectorAll('.tabs li');
        tabs.forEach(tab => {
            tab.classList.remove('is-active');
        });

        // Show selected tab content
        document.getElementById(tabName + '-content').classList.add('is-active');

        // Add active class to selected tab
        document.querySelector(`[data-tab="${tabName}"]`).classList.add('is-active');
    }

    // Modal functions
    function showFollowersModal() {
        const modal = document.getElementById('followersModal');
        const content = document.getElementById('followersContent');

        // Sample followers data
        const followers = [
            { name: 'Sarah Johnson', bio: 'UX Designer & Writer', avatar: 'https://images.unsplash.com/photo-1494790108755-2616b6df47c6?w=100&h=100&fit=crop&crop=face' },
            { name: 'Mike Chen', bio: 'Frontend Developer', avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face' },
            { name: 'Emily Davis', bio: 'Product Manager', avatar: 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop&crop=face' },
            { name: 'Alex Rodriguez', bio: 'Data Scientist', avatar: 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=100&h=100&fit=crop&crop=face' }
        ];

        content.innerHTML = followers.map(follower => `
                <div class="media">
                    <div class="media-left">
                        <img src="${follower.avatar}" alt="${follower.name}" class="following-avatar">
                    </div>
                    <div class="media-content">
                        <p class="has-text-weight-semibold">${follower.name}</p>
                        <p class="is-size-7 has-text-grey">${follower.bio}</p>
                    </div>
                    <div class="media-right">
                        <button class="button is-small is-outlined">Follow back</button>
                    </div>
                </div>
            `).join('');

        modal.classList.add('is-active');
    }

    function showFollowingModal() {
        const modal = document.getElementById('followingModal');
        const content = document.getElementById('followingContent');

        // Sample following data
        const following = [
            { name: 'Code Like A Girl', bio: 'Empowering women in tech', avatar: 'https://images.unsplash.com/photo-1494790108755-2616b6df47c6?w=100&h=100&fit=crop&crop=face' },
            { name: 'Better Humans', bio: 'Better Living Through Technology', avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face' },
            { name: 'Let\'s Code Future', bio: 'Programming tutorials and tips', avatar: 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=100&h=100&fit=crop&crop=face' }
        ];

        content.innerHTML = following.map(user => `
                <div class="media">
                    <div class="media-left">
                        <img src="${user.avatar}" alt="${user.name}" class="following-avatar">
                    </div>
                    <div class="media-content">
                        <p class="has-text-weight-semibold">${user.name}</p>
                        <p class="is-size-7 has-text-grey">${user.bio}</p>
                    </div>
                    <div class="media-right">
                        <button class="button is-small is-danger is-outlined">Unfollow</button>
                    </div>
                </div>
            `).join('');

        modal.classList.add('is-active');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('is-active');
    }
});
