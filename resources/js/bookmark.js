import axios from "axios";
import { showErrorBox } from "./error-box";

document.addEventListener('click', async (e) => {

    const btn = e.target.closest("[data-action='bookmark']");
    if (!btn) return; // click wasn't on a bookmark button

    const postId = btn.dataset.postId;

    try {
        const res = await axios.post(`/bookmark`, { postId });

        console.log(res);

        btn.classList.toggle("active", res.data.bookmarked);

    } catch (error) {
        // console.error(error);
        if (error.response) {

            const { status } = error.response;

            if (status === 401) return showErrorBox();

            if (status === 500) return showErrorBox('Server Error', 'Something went wrong, please try again later');
        }

        showErrorBox('Server Error', 'Something went wrong, please try again later')
    }
});

