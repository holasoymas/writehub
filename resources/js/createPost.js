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

            const res = await axios.post('/posts', { content: data });

            if (res.status === 201) {
                console.log(res.data.message);
                window.location.href = res.data.redirect_url;
            }
        } catch (error) {
            console.error('Saving failed: ', error);
        }
    };
})

