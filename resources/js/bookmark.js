import axios from "axios";

document.addEventListener('click', async (e) => {

    const btn = e.target.closest("[data-action='bookmark']");
    if (!btn) return; // click wasn't on a bookmark button

    const postId = btn.dataset.postId;

    try {
        const res = await axios.post(`/bookmark`, { postId });

        // console.log(res);

        btn.classList.toggle("active", res.data.bookmarked);
    } catch (error) {
        console.error(error);
    }
});

