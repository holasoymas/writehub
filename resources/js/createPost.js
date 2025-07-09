import axios from "axios";

document.querySelector("#save").addEventListener("click", save);

async function save() {

    try {
        const data = await editor.save();
        console.log('Data saved: ', data);

        const res = await axios.post('/posts', { block: data });
        console.log(res);

        const edjsParser = edjsHTML();
        let html = edjsParser.parse(data);

        console.log(html);
        document.getElementById('output').innerHTML = html;

    } catch (error) {
        console.error('Saving failed: ', error);
    }

};
