import axios from "axios";
import { showErrorBox } from "./error-box";

// for post dropdown
document.addEventListener('DOMContentLoaded', () => {

    const articleContainer = document.querySelector('.articles-section');

    //open a dropdown for post actions
    articleContainer.addEventListener('click', (e) => {

        if (e.target.closest('.dropdown-trigger button')) {

            // remove all the dropdowns
            const otherDropdown = articleContainer.querySelectorAll(".dropdown-article-action");
            otherDropdown.forEach(d => d.classList.remove('is-active'))

            const dropdown = e.target.closest('.dropdown-article-action');

            console.log(dropdown)

            dropdown.classList.toggle('is-active');
        }
    });

    // Close dropdown(on post action) if clicking outside
    document.addEventListener('click', (e) => {

        const openDropdown = document.querySelector('.dropdown-article-action.is-active');

        if (openDropdown && !openDropdown.contains(e.target)) {

            openDropdown.classList.remove('is-active');
        }
    });

    // open the report from and close the post dropdown action
    articleContainer.addEventListener('click', async (e) => {

        if (e.target.matches('.dropdown-item.report')) {

            const postId = e.target.closest('.article-card').dataset.postId;

            // remove the post action dropdown as report model will appear
            e.target.closest('.dropdown-article-action.is-active').classList.remove('is-active');

            const reportModal = document.querySelector('#report-modal');
            reportModal.classList.add('is-active');

            // Store the postId in the modal itself so you know which blog you clicked
            reportModal.dataset.postId = postId;

            e.stopPropagation(); // ← prevents document "outside click" from seeing this click
        }
    });

    // event for selecting radio eleemnt with some logic (like appearing text field when click on other)
    document.addEventListener('click', (e) => {
        // logic for reason selection

        if (e.target.closest(".report-reason")) {

            const radios = document.querySelectorAll("input[name='report_reason']");

            const otherReasonInput = document.querySelector("#other-reason-input");

            radios.forEach(radio => {

                radio.addEventListener('change', () => {

                    if (document.querySelector("#other-reason").checked) {

                        otherReasonInput.style.display = "block";
                        otherReasonInput.focus();

                    } else {
                        otherReasonInput.style.display = "none";
                        otherReasonInput.value = "";
                    }
                })
            })
        }
    });

    // for closing the report banner
    document.addEventListener('click', (e) => {

        const reportModal = document.querySelector('#report-modal');

        // if this is the success button, don't close here (absolute necessary because you can get undefined when form is submitted)
        if (e.target.matches('.buttons .button.is-success')) return;

        if (e.target.matches(".delete") || e.target.matches(".buttons .button")) {

            reportModal.classList.remove('is-active');

            resetReportModal();
        }
    });

    document.addEventListener('click', async (e) => {

        const reportModal = document.querySelector('#report-modal');

        if (e.target.matches('.buttons .button.is-success')) {

            const postId = reportModal.dataset.postId;
            const other = document.querySelector("#other-reason-input").value;
            const reason = document.querySelector("input[name='report_reason']:checked")?.value;

            try {
                const data = await axios.post('/report', { postId, reason, other });

            } catch (err) {

                if (err.response) {

                    const { status, data } = err.response;

                    if (status === 401) {

                        reportModal.classList.remove("is-active");
                        resetReportModal();

                        showErrorBox(); // Default validation error
                    }

                    if (status === 422) {
                        const errors = data.errors;
                        let messages = Object.values(errors).flat().join('\n');

                        // close the report form, reset the data  and show the error box
                        reportModal.classList.remove("is-active");
                        resetReportModal();

                        showErrorBox('Validation Error', messages);

                    }

                    if (status === 500) {
                        reportModal.classList.remove("is-active");
                        resetReportModal();

                        showErrorBox('Server Error', 'Something went wrong, Please try again later');
                    }

                } else {
                    reportModal.classList.remove("is-active");
                    resetReportModal();

                    showErrorBox('Server Error', 'Something went wrong, Please try again later');
                }
            }
        }
    });

    function resetReportModal() {
        const reportModal = document.querySelector('#report-modal');

        // Uncheck all radios
        const radios = reportModal.querySelectorAll("input[name='report_reason']");
        radios.forEach(radio => radio.checked = false);

        // Hide and clear the "Other" text input
        const otherReasonInput = reportModal.querySelector("#other-reason-input");
        otherReasonInput.style.display = "none";
        otherReasonInput.value = "";

        // Remove stored postId
        delete reportModal.dataset.postId;
    }
})


