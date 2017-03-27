import fetch from 'isomorphic-fetch';

export function fetchSearchData() {
    return fetch('http://localhost:8000/', {
        method: 'GET',
        mode: 'cors'
    }).then(res => res.json()).catch(err => err);
}