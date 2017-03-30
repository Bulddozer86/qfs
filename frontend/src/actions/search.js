import fetch from 'isomorphic-fetch';

export default function fetchSearchData() {
    const data = fetch('http://localhost:8000/', {
        method: 'GET',
        mode: 'cors'
    }).then(res => res.json()).catch(err => err);

    return {
        type: 'SET_SEARCH',
        payload: data
    }
}