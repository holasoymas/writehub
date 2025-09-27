import axios from "axios";

const input = document.querySelector('#usersearchinput');
const suggestionsBox = document.querySelector('#suggestions-box');

// Dummy blog suggestions (replace with API later)
const blogs = [
    { id: 1, title: "Bulma CSS Tips", url: "/blog/1" },
    { id: 2, title: "Learn PHP Basics", url: "/blog/2" },
    { id: 3, title: "JavaScript Tricks", url: "/blog/3" },
    { id: 4, title: "Building with Laravel", url: "/blog/4" },
    { id: 5, title: "XAMPP Setup Guide", url: "/blog/5" },
];

input.addEventListener('input', async (e) => {
    const query = e.target.value;
    if (!query) {
        suggestionsBox.style.display = "none";
        return;
    }

    const res = await axios.get(`/search?q=${encodeURIComponent(query)}`);
    console.log(res.data);

    const filtered = res.data;
    if (filtered.length === 0) {
        suggestionsBox.innerHTML = `<p class="has-text-grey">No results</p>`;
    } else {
        suggestionsBox.innerHTML = filtered.map(b => `
      <a href="${b.slug}" class="dropdown-item" style="display:block; padding: 8px; border-bottom: 1px solid #eee;">
        ${b.title}
      </a>
    `).join('');
    }

    suggestionsBox.style.display = "block";
});

// Hide suggestions when clicking outside
document.addEventListener('click', (e) => {
    if (!suggestionsBox.contains(e.target) && e.target !== input) {
        suggestionsBox.style.display = "none";
    }
});

