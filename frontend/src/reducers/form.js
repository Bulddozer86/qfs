const initialState = {
    value: '',
    list: []
};

export default function formStore(state = initialState, action) {
    switch (action.type) {
        case 'SET_LIST':
            return {...state, list: action.payload};
        default:
            return state;
    }
}
