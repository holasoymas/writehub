<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Editor.js Demo</title>

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  {{-- <script type="module" src="{{ asset('js/createPost.js') }}"></script> --}}

@vite(['resources/js/createPost.js'])

  <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>

<script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/underline@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/image@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@calumk/editorjs-codeflask@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/editorjs-html@4.0.0/.build/edjsHTML.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.11.1/build/styles/default.min.css">
<script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.11.1/build/highlight.min.js"></script>

<!-- and it's easy to individually load additional languages -->
<!-- <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.11.1/build/languages/go.min.js"></script> -->

<script>hljs.highlightAll();</script>

<style>

  #editorjs {
    padding: 10px;
    min-height: 200px;
  }

</style>

</head>

<body>

  <h2>Medium Writing</h2>
  <div id="editorjs"></div>
  <button id="save">Save</button>

  <h2>Output</h2>
  <div id="output">

  </div>

  <script>
      const token = document.head.querySelector("meta[name='csrf-token']");
      console.log(token);
      console.log(token.content);

    const editor = new EditorJS({
      holder: 'editorjs', // <-- this tells Editor.js where to render
        autofocus : true,

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
      tools:{
        header : {
          class: Header,
          toolbox: [
             {
    icon: 'H1', // icon for H1,
    title: 'Heading 1',
    data: {
      level: 1,
    },
  },
  {
    icon: 'H2' ,// icon for H2,
    title: 'Heading 2',
    data: {
      level: 2,
    },
  },
  {
    icon: 'H3' ,// icon for H3,
    title: 'Heading 3',
    data: {
      level: 3,
    },
  },
   {
    icon: 'H4', // icon for H1,
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

        list : {
          class: EditorjsList,
          inlineToolbar: true,
          config: {
            defaultStyle: 'unordered',
          }
        },

quote : {
  class: Quote,
  inlineToolbar: true,

},

embed : {
  class: Embed,
},
code: editorjsCodeflask,
{{-- image : SimpleImage, --}}
underline : Underline,
delimiter : Delimiter,
 image : {
   class: ImageTool,
   config: {
     endpoints: {
       byFile: 'http://127.0.0.1:8000/posts/uploadImage', // Your backend file uploader endpoint
       byUrl: 'http://127.0.0.1:8000/posts/ploadImageUrl', // Your endpoint that provides image by URL
     },
       additionalRequestHeaders : {
           'X-CSRF-TOKEN' : token.content,
       },
   }
 }
      },
    });

editor.isReady
  .then(() => console.log('Editor.js is initialized'))
  .catch((reason) => console.error('Editor.js initialization failed:', reason));


  </script>

<pre>
  <code>
    function parser(str){
      const edjsParser = edjsHTML();
      let html = edjsParser.parse(str);
      console.log(html);
      document.getElementById('output').innerHTML = html;
    }parser(string);
    </code>
  </pre>


</body>
</html>
