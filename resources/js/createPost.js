import axios from "axios";

window.addEventListener('DOMContentLoaded', () => {

    document.querySelector("#save").addEventListener("click", save);

    const token = document.head.querySelector("meta[name='csrf-token']");
    // console.log(token);
    // console.log(token.content);

    const baseUrl = window.location.origin;

    const editor = new EditorJS({
        holder: 'editorjs', // <-- this tells Editor.js where to render
        autofocus: true,

        data: {
            blocks: [
                {
                    type: 'header',
                    data: {
                        text: '',
                        level: 1
                    }
                }
            ]
        },
        tools: {
            header: {
                class: Header,
                toolbox: [
                    {
                        icon: 'H1',
                        title: 'Heading 1',
                        data: {
                            level: 1,
                        },
                    },
                    {
                        icon: 'H2',
                        title: 'Heading 2',
                        data: {
                            level: 2,
                        },
                    },
                    {
                        icon: 'H3',
                        title: 'Heading 3',
                        data: {
                            level: 3,
                        },
                    },
                    {
                        icon: 'H4',
                        title: 'Heading 4',
                        data: {
                            level: 4,
                        },
                    },
                ],
                inlineToolbar: true,
                config: {
                    placeholder: 'Write a blog....... ',
                    levels: [1, 2, 3, 4],
                    defaultLevel: 1,
                    shortcut: 'CMD+SHIFT+H',
                }
            },

            list: {
                class: EditorjsList,
                inlineToolbar: true,
                config: {
                    defaultStyle: 'unordered',
                }
            },

            quote: {
                class: Quote,
                inlineToolbar: true,
            },

            embed: {
                class: Embed,
            },
            code: editorjsCodeflask,
            // image : SimpleImage,
            underline: Underline,
            inlineCode: InlineCode,
            delimiter: Delimiter,
            image: {
                class: ImageTool,
                config: {
                    endpoints: {
                        byFile: `${baseUrl}/posts/uploadImage`, // Your backend file uploader endpoint
                        byUrl: `${baseUrl}/posts/ploadImageUrl`, // Your endpoint that provides image by URL
                    },
                    additionalRequestHeaders: {
                        'X-CSRF-TOKEN': token.content,
                    },
                }
            }
        },
    });

    editor.isReady
        .then(() => console.log('Editor.js is initialized'))
        .catch((reason) => console.error('Editor.js initialization failed:', reason));

    async function save() {
        try {
            const data = await editor.save();
            console.log('Data saved: ', data);

            // if (!tags || tags.length === 0) {
            //     showError("Please, Include at least 1 tag");
            //     return;
            // }

            const payload = {
                content: data,
                tags,
            }
            console.log(payload);

            const res = await axios.post('/posts', payload);

            if (res.status === 201) {
                console.log(res.data.message);
                window.location.href = res.data.redirect_url;
            }
        } catch (error) {
            console.error('Saving failed: ', error);
        }
    };
})

/* =========================================================
 * FOR TAGS RELATED JS
 * =========================================================
 */

let tags = [];
const MAX_TAGS = 5;

const tagInput = document.getElementById('tagInput');
const tagContainer = document.getElementById('tagContainer');
const errorText = document.getElementById('errorText');
const tagCounter = document.getElementById('tagCounter');

tagInput.addEventListener('keydown', handleKeyDown);
tagInput.addEventListener('input', handleInput);

tagContainer.addEventListener('click', e => {
    const buttonElmnt = e.target.closest('button');
    if (!buttonElmnt) return;
    const indx = parseInt(buttonElmnt.dataset.tagId); // Convert to number
    removeTag(indx);
});


function handleKeyDown(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        const value = e.target.value.trim();
        if (value) {
            addTag(value);
        }
    }

    if (e.key === 'Backspace' && e.target.value === '' && tags.length > 0) {
        removeTag(tags.length - 1);
    }
}

function handleInput(e) {
    // Remove spaces automatically
    if (e.target.value.includes(' ')) {
        e.target.value = e.target.value.replace(/\s/g, '');
        showError('Spaces are not allowed in tags');
    } else {
        hideError();
    }
}

function addTag(tagText) {
    if (!isValidTag(tagText)) return;

    if (tags.length >= MAX_TAGS) {
        showError(`Maximum ${MAX_TAGS} tags allowed`);
        return;
    }

    const normalizedTag = tagText.toLowerCase();
    if (tags.includes(normalizedTag)) {
        showError('Tag already exists');
        return;
    }

    tags.push(normalizedTag);
    tagInput.value = '';
    renderTags();
    updateCounter();
    hideError();
}

function removeTag(index) {
    tags.splice(index, 1);
    renderTags();
    updateCounter();
    hideError();
}

function isValidTag(tag) {
    if (!tag || tag.length === 0) {
        showError('Tag cannot be empty');
        return false;
    }

    if (tag.includes(' ')) {
        showError('Spaces are not allowed');
        return false;
    }

    if (tag.length > 20) {
        showError('Tag must be 20 characters or less');
        return false;
    }

    if (!/^[a-zA-Z0-9_-]+$/.test(tag)) {
        showError('Only letters, numbers, hyphens and underscores allowed');
        return false;
    }

    return true;
}

function renderTags() {
    // Remove existing tags from container
    const existingTags = tagContainer.querySelectorAll('.tag');
    existingTags.forEach(tag => tag.remove());

    // Add tags before input
    const inputElement = tagContainer.querySelector('#tagInput');
    tags.forEach((tag, index) => {
        const tagElement = document.createElement('span');
        tagElement.className = 'tag';
        tagElement.innerHTML = `
                    ${tag}
            <button type="button" class="tag-remove" data-tag-id="${index}" title="Remove tag">×</button>
                `;
        tagContainer.insertBefore(tagElement, inputElement);
    });

    // Update input state
    const isMaxReached = tags.length >= MAX_TAGS;
    tagInput.disabled = isMaxReached;
    tagContainer.classList.toggle('disabled', isMaxReached);

    if (isMaxReached) {
        tagInput.placeholder = 'Maximum tags reached';
    } else {
        tagInput.placeholder = 'Add up to 5 tags...';
    }
}

function updateCounter() {
    const count = tags.length;
    tagCounter.textContent = `${count}/${MAX_TAGS}`;

    tagCounter.className = 'tag-counter';
    if (count === MAX_TAGS) {
        tagCounter.classList.add('error');
    } else if (count >= MAX_TAGS - 1) {
        tagCounter.classList.add('warning');
    }
}

function showError(message) {
    errorText.textContent = message;
    errorText.classList.add('show');
    setTimeout(hideError, 3000);
}

function hideError() {
    errorText.classList.remove('show');
}
