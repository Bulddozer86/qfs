import fetch from 'isomorphic-fetch';
import {SET_SEARCH_VALUE} from '../consts/page-consts'

export default function fetchSearchData() {
    const data = fetch('http://localhost:8000/', {
        method: 'GET',
        mode: 'cors'
    }).then(res => res.json()).catch(err => err);

    return {
        type: SET_SEARCH_VALUE,
        payload: data
    }
}
