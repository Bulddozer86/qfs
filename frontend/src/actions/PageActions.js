import {SET_SEARCH_VALUE} from '../consts/page-consts.js'

export function setSearchValue(value) {

  return {
    type: SET_SEARCH_VALUE,
    payload: value
  }

}
