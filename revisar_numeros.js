const axios = require('axios');
const cheerio = require('cheerio');

let url1 = "https://api.whatsapp.com/send?phone=584123091835"
let url2 = "https://api.whatsapp.com/send?phone=+18282792101"
let url3 = "https://api.whatsapp.com/send?phone=18282792101342"

async function getTextContent() {
    try {
        const response = await axios.get(url3);
        const html = response.data;
        const $ = cheerio.load(html);
        
        const textContent = $('h2._9vd5._9scb').text();
        
        return textContent;
    } catch (error) {
        console.error('Error al obtener el contenido:', error);
    }
}

getTextContent().then(content => {
    console.log('Texto del h2:', content);
}).catch(error => {
    console.error('Error:', error);
});
