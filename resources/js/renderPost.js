
document.addEventListener('DOMContentLoaded', () => {

    const postContainer = document.querySelector('.post-content');

    const rawData = JSON.parse(postContainer.dataset.content);

    // console.log(rawData);

    renderEditorContent('.post-content', rawData.slice(1));
})

// Recursive list rendering function
function renderNestedList(items, style = 'unordered') {

    const tag = style === 'ordered' ? 'ol' : 'ul';

    let html = `<${tag}>`;

    items.forEach(item => {

        html += '<li>';

        if (item.items.length === 0) {

            html += item.content;

        } else if (item.items.length > 0) {

            html += item.content;

            html += renderNestedList(item.items, style);

        }

        html += '</li>';
    });

    html += `</${tag}>`;

    return html;
}

function renderEditorContent(selecter, blocks) {

    const container = document.querySelector(selecter);

    if (!container) return;

    container.innerHTML = '';

    // Loop over blocks
    blocks.forEach(block => {

        let element;

        switch (block.type) {

            case 'header':

                element = document.createElement('h' + block.data.level);

                element.className = `title is-${block.data.level + 1}`;

                element.innerHTML = block.data.text;

                break;

            case 'paragraph':

                element = document.createElement('p');

                element.innerHTML = block.data.text || '&nbsp;'; // add spacing for empty block

                break;

            case 'image':

                element = document.createElement('div');

                element.className = 'post-image';

                element.innerHTML = `
                    <figure>
                        <img src="${block.data.file.url}" alt="${block.data.caption || ''}">
                        <figcaption>${block.data.caption || ''}</figcaption>
                    </figure>
                `;
                break;

            case 'code':

                element = document.createElement('pre');

                element.innerHTML = `<code>${block.data.code}</code>`;

                break;

            case 'list':

                element = document.createElement('div');

                // element.className = 'post-list';

                element.innerHTML = renderNestedList(block.data.items, block.data.style);

                break;

            case 'delimiter':

                element = document.createElement('hr');

                break;

            case 'quote':

                element = document.createElement('figure');

                element.className = 'quote-block'; // or element.classList.add('quote-block');

                // Add blockquote
                const blockquote = document.createElement('blockquote');

                blockquote.innerHTML = block.data.text;

                element.appendChild(blockquote);

                // Add figcaption if caption is not empty
                if (block.data.caption?.trim()) {

                    const figcaption = document.createElement('figcaption');

                    figcaption.textContent = `— ${block.data.caption}`;

                    element.appendChild(figcaption);
                }
                break;

            default:
                break;
        }

        if (element) container.appendChild(element);
    });
}
