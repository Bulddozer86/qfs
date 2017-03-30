const initialState = {
  value: ''
};

export default function page(state = initialState, action) {

  switch (action.type) {
    case 'SET_SEARCH_VALUE':
      return {...state, value: action.payload};

    default:
      return state;
  }

}