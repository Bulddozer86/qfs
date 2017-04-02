// const initialState = {
//     searchData: [
//         {id: 1, price: '1000', headline: 'Hello world'}
//     ]
// };
//
// export default function searchState(state = initialState, action) {
//     switch (action.type) {
//         case  'SET_SEARCH' :
//             return {...state, year: action.payload};
//
//         default:
//             return state;
//     }
// }

import {combineReducers} from 'redux'
import page from './page'
import searchForm from './form'

export default combineReducers({
  searchForm
})