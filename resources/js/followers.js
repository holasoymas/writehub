import axios from "axios";

document.addEventListener("DOMContentLoaded", () => {
    // General modal open function
    function openModal(modalId, users, buttonType) {

        const modal = document.getElementById(modalId);

        const content = modal.querySelector(".modal-card-body");

        // Render dynamic users list
        content.innerHTML = users.map(user => `
      <div class="media">
        <div class="media-left">
          <img src="${user.profile_pic}" alt="${user.name}" class="following-avatar">
        </div>
        <div class="media-content">
          <p class="has-text-weight-semibold"><a class="has-text-black" href="/user/${user.id}">${user.name}</a> </p>
          <p class="is-size-7 has-text-grey">${user.bio || ""}</p>
        </div>
        <div class="media-right">
          <button class="button is-small ${buttonType.class}">${buttonType.text}</button>
        </div>
      </div>
    `).join("");

        modal.classList.add("is-active");

        document.documentElement.classList.add("is-clipped"); // 🔒 disable background scroll

        // Close when clicking X or background
        modal.querySelector(".delete").onclick = () => closeModal(modalId);

        modal.addEventListener("click", (e) => {

            if (!e.target.closest(".modal-card")) {

                closeModal(modalId);
            }
        });
    }

    // General modal close
    function closeModal(modalId) {

        document.getElementById(modalId).classList.remove("is-active");

        document.documentElement.classList.remove("is-clipped"); // 🔓 re-enable background scroll
    }

    // Event bindings
    document.getElementById("show-followers").addEventListener("click", async () => {

        const userId = document.querySelector(".profile-header").dataset.userId;

        try {

            const followers = await axios.get(`/user/${userId}/followers`);

            console.log(followers);

            openModal("followersModal", followers.data.followers, { text: "Follow back", class: "is-outlined" });

        } catch (err) {

            console.log("Error", err);
        }


    });

    document.getElementById("show-followings").addEventListener("click", async () => {

        const userId = document.querySelector(".profile-header").dataset.userId;
        console.log(userId);

        try {

            const following = await axios.get(`/user/${userId}/followings`);

            console.log(following);

            openModal("followingModal", following.data.followings, { text: "Unfollow", class: "is-danger is-outlined" });

        } catch (err) {

            console.log("Error", err);
        }

    });
});


