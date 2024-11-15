import axios from 'axios'

const instance = axios.create({
    baseURL: 'http://127.0.01:8000/api',
    headers: {
        'Content-Type': 'application/json'
    }
})

instance.interceptors.request.use(config => {
    return config
})

export default instance;
