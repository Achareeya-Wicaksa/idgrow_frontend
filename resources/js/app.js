// resources/js/app.js
import axios from 'axios';

const token = document.querySelector('meta[name="auth-token"]').getAttribute('content');

axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Contoh request GET
axios.get('/barang')
    .then(response => {
        console.log(response.data);
    })
    .catch(error => {
        console.error(error.response);
    });

// Contoh request POST
axios.post('/barang', {
    // data Anda di sini
})
.then(response => {
    console.log(response.data);
})
.catch(error => {
    console.error(error.response);
});
