import axios from "axios";

// following unfollow action in profile modal and side modal
document.addEventListener('click', async (e) => {

    if (!e.target.classList.contains('follow-btn')) return;

    const btn = e.target;
    const userId = btn.dataset.userId;

    console.log(userId)
    try {
        const res = await axios.post(`/follow/toggle/${userId}`);

        const following = res.data.following;

        if (following) {
            btn.textContent = "Following";
            btn.classList.add("is-following");
        } else {
            btn.textContent = "Follow";
            btn.classList.remove("is-following");
        }
        console.log(res.data);

    } catch (error) {
        alert("Error : " + error);
    }
})

