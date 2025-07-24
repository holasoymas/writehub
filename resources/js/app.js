import './bootstrap';
import axios from 'axios';

// Get the token from meta tag
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Set it in Axios headers
if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
} else {
    console.error('CSRF token not found in meta tag!');
}
