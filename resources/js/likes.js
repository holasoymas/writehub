import axios from "axios";

document.addEventListener('DOMContentLoaded', () => {

    const likeBtnInfo = document.querySelector('.action-btn.like');

    const likableId = likeBtnInfo.dataset.likableId;
    const likableType = likeBtnInfo.dataset.likableType;

    const likeBtn = document.querySelector('.action-btn i');

    likeBtn.addEventListener('click', async () => fetchLike(likeBtnInfo, { likableId, likableType }));

    const commentDiv = document.querySelector('#comments-container');

    commentDiv.addEventListener('click', async (event) => {

        const likeButton = event.target.closest('.like-btn');
        if (!likeButton) return;

        // Find the nearest .comment-content to get its data attributes
        const commentElement = likeButton.closest('.comment-content');
        if (!commentElement) return;


        const likableId = commentElement.dataset.likableId;
        const likableType = commentElement.dataset.likableType;

        await fetchLike(likeButton, { likableId, likableType });

    });
})

async function fetchLike(likeButton, likableObj) {
    try {
        const req = await axios.post('/like', likableObj);

        likeButton.classList.toggle('liked');

        likeButton.querySelector('span').textContent = req.data.likesCount;

    } catch (err) {
        if (err.response) {

            const { status, data } = err.response;

            if (status === 401) {
                alert("Login to comment");
                cancelReply();
            }

            if (status === 422) {
                const errors = data.errors;
                let messages = Object.values(errors).flat().join('\n');
                alert(`Validation Failed:\n${messages}`);
            }

            if (status === 500) {
                alert("Something went wrong, Try again later");
                cancelReply();
            }

        } else {

            alert("Something went wrong, Try again later");
        }
    }
}
