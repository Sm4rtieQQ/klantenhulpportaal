import axios from 'axios';
import { destroyErrors, destroyMessage } from '../error';
import { setErrorBag, setMessage } from '../error';

const http = axios.create({
    baseURL: '/api',
    headers: {
        'Content-Type': 'application/json'
    }
});

export const getRequest = (endpoint: any) => http.get(endpoint);
export const postRequest = (endpoint: any, data: any) => http.post(endpoint, data);
export const putRequest = (endpoint: any, data: any) => http.put(endpoint, data);
export const deleteRequest = (endpoint: any) => http.delete(endpoint);

http.interceptors.request.use(
    config => {
        destroyErrors();
        destroyMessage();
        return config;
    },
    error => Promise.reject(error)
);

http.interceptors.response.use(
    response => response,
    error => {
        if (error.response && error.response.status === 422) {
            setErrorBag(error.response.data.errors);
            setMessage(error.response.data.message);
        }
        return Promise.reject(error);
    }
)