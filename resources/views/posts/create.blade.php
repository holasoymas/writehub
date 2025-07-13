<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Editor.js Demo</title>

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  {{-- <script type="module" src="{{ asset('js/editorConfig.js') }}"></script> --}}

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
<script src="https://cdn.jsdelivr.net/npm/@editorjs/inline-code@latest"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.11.1/build/styles/default.min.css">
<script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@11.11.1/build/highlight.min.js"></script>

<script>hljs.highlightAll();</script>

<style>

  #editorjs {
    padding: 10px;
    min-height: 200px;
  }

</style>

</head>

<body>
  <div id="editorjs"></div>
  <button id="save">Save</button>

  <div id="output">
  </div>
</body>
</html>
