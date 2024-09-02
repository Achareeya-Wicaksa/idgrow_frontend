// resources/js/axios.js
import axios from 'axios';

// Set base URL for API
axios.defaults.baseURL = process.env.MIX_API_URL || 'http://localhost:8080';

// Get token from local storage or session
const token = localStorage.getItem('access_token') || '';

// Set token in default headers
axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
