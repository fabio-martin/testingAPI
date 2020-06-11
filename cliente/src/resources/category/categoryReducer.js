import {DELETE_CATEGORIA, GET_CATEGORIA, GET_CATEGORIAS} from '../../utils/actions/actionsTypes'

const initialState = {
    categories: [],
    category: {}

}

export default function (state = initialState, action) {
    switch (action.type) {
        case GET_CATEGORIAS:
            return {
                ...state,
                categories: action.payload
            };

        case GET_CATEGORIA:
            return {
                ...state,
                category: action.payload
            };

        case DELETE_CATEGORIA:
            return {
                ...state,
                categories: state.categories.filter(category=>category.id !== action.payload)
            };

        default:
            return state;
    }
}