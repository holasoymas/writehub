import axios, { AxiosError } from "axios";

document.addEventListener('DOMContentLoaded', () => {

    /*============================================================================
        Render comments
     =============================================================================
     */
    const commentContainer = document.querySelector('#comments-container');

    const rawCommentData = JSON.parse(commentContainer.dataset.comment);

    renderComments(rawCommentData, commentContainer);


    /*============================================================================
    find and render the reply form container at the right place
     =============================================================================
     */
    document.querySelector("#comments-container").addEventListener("click", (e) => {

        if (e.target.matches(".reply-btn")) {

            const commentDiv = e.target.closest(".comment-item");

            const commentId = commentDiv?.dataset.commentId;

            if (commentId) {

                renderReplyForm(commentId);
            }
        }
    })


    /*============================================================================
         cancel reply btn
      =============================================================================
     */
    document.querySelector("#comments-container").addEventListener("click", (e) => {

        if (e.target.matches(".cancel-btn")) {

            cancelReply();
        }
    });


    /*============================================================================
         new comment api fetch
      =============================================================================
     */
    document.querySelector('#new-comment-btn').addEventListener('click', async () => {
        const postId = document.querySelector(".post-content").dataset.postId;
        const comment = document.querySelector("#new-comment").value;


        if (!comment.trim()) return;

        try {
            const res = await axios.post("/comment/create", {
                parentId: null,
                postId,
                comment
            })
            console.log(res);
            const commentData = res.data;

            const commentContainer = document.querySelector("#comments-container");
            renderComments([commentData], commentContainer, false);

            document.querySelector("#new-comment").value = '';

        } catch (error) {
            if (error.response) {

                const { status, data } = error.response;

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
    })



    /*============================================================================
         reply comment api
      =============================================================================
     */
    document.querySelector("#comments-container").addEventListener("click", async (e) => {

        if (e.target.matches(".reply-comment-btn")) {

            const commentDiv = e.target.closest(".comment-item");

            const parentId = commentDiv?.dataset.commentId;
            console.log(parentId)

            const postId = document.querySelector(".post-content").dataset.postId;
            const comment = document.querySelector("#comment-value").value;

            try {

                const res = await axios.post("/comment/create", { parentId, postId, comment });
                console.log(res);

                const parentElement = document.querySelector(`[data-comment-id="${parentId}"]`);
                let repliesContainer = parentElement.querySelector(".replies");

                // if replies container doesnt exist create it
                if (!repliesContainer) {

                    repliesContainer = document.createElement("div");

                    repliesContainer.classList.add("replies");

                    parentElement.querySelector('.comment-content').appendChild(repliesContainer);
                }

                renderComments([res.data], repliesContainer, false);

                cancelReply();

            } catch (error) {

                if (error.response) {

                    const { status, data } = error.response;

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
    })
});

function renderComments(comments, parentElement, clearDom = true) {

    if (clearDom) parentElement.innerHTML = '';

    comments.forEach(comment => {

        const commentDiv = document.createElement("div");

        commentDiv.classList.add("comment-item", `depth-${comment.depth || 0}`);

        commentDiv.dataset.commentId = comment.id;

        const replies = comment.recursive_replies || [];

        commentDiv.innerHTML = `
                    <img src="https://placehold.co/400" alt="${'pic'}" class="comment-avatar">
                    <div class="comment-content">
                        <div class="comment-header">
                            <span class="comment-author">${"ram"}</span>
                            <span class="comment-time">${comment.created_at}</span>
                        </div>
                        <div class="comment-text">
                            ${comment.body}
                        </div>
                        <div class="comment-actions">
                            <button class="comment-action like-btn" onclick="toggleCommentLike(this)">
                                <i class="far fa-heart"></i>
                                <span>12</span>
                            </button>
                            <button class="comment-action reply-btn">
                                <i class="fas fa-reply"></i>
                                Reply
                            </button>
                        </div>
                        ${replies.length > 0 ? '<div class="replies"></div>' : ''}
                    </div>
                `;

        parentElement.prepend(commentDiv);

        // Render nested replies
        if (replies.length > 0) {

            const repliesContainer = commentDiv.querySelector('.replies');

            renderComments(replies, repliesContainer);
        }
    });
}

function cancelReply() {

    const existingForm = document.querySelector(".reply-form");

    if (existingForm) existingForm.remove();
}


function renderReplyForm(parentId) {

    const existingForm = document.querySelector(".reply-form");

    if (existingForm) existingForm.remove();

    const parentComment = document.querySelector(`[data-comment-id="${parentId}"]`)
    const commentContent = parentComment.querySelector('.comment-content');


    const form = document.createElement("div");

    form.classList.add("comment-form-reply", "reply-form");

    form.innerHTML = `
                <div class="form-header">
                    <img src="https://placehold.co/400" alt="Current User" class="comment-avatar">
                    <span class="user-name">Current User</span>
                </div>
                <textarea id="comment-value" placeholder="Write your reply..." rows="3"></textarea>
                <div class="form-actions">
                    <button class="cancel-btn">Cancel</button>
                    <button class="reply-comment-btn">Reply</button>
                </div>
            `;

    parentComment.appendChild(form);

    // Insert the form after the comment actions but before any replies
    const repliesContainer = commentContent.querySelector('.replies');

    if (repliesContainer) {

        commentContent.insertBefore(form, repliesContainer);

    } else {

        commentContent.appendChild(form);
    }
}

