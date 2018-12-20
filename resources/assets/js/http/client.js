import axios from 'axios'
import { store } from './store'
import { service } from './service'

let refreshing = false
let refreshSubscribers = []

const client = axios.create({
    baseURL: window.location.origin + '/api/',
    headers: {
        Accept: 'application/json'
    }
})

client.interceptors.request.use (
    (config) => {
        const token = store.token;

        if(token) {
            config.headers.Authorization = `Bearer  ${token}`
        }
        return config
    },
    (err) => {
        return Promise.reject(err);
    }
)


client.interceptors.response.use(null, (error) => {
    if (error.config && error.response) {
        if(error.response.status === 401) {
            const config = error.config;
            if(!refreshing) {
                refreshing = true
                service.refreshToken()
                    .then(response => {
                        refreshing = false

                        store.token = response.data.access_token
                        Echo.connector.options.auth.headers['Authorization'] = `Bearer ${store.token}`
                        // return client.request(error.config);
                        refreshSubscribers.map(cb => cb(store.token))
                        refreshSubscribers = []
                    })
                    .catch(error => {
                        refreshing = false
                        store.clear()
                        $(location).attr('href', '/login')
                    })
            }

            const retryOrigReq = new Promise((resolve, reject) => {
                refreshSubscribers.push((token) => {
                    config.headers['Authorization'] = `Bearer ${token}`;
                    resolve(client.request(config))
                })
            })
            return retryOrigReq
        }else {
            return Promise.reject(error);
        }
    }

    return Promise.reject(error);
})





export default client
