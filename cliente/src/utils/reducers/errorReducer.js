import {GET_ERRORS} from "../actions/actionsTypes";

const inicialState = {}

export default function (state = inicialState, action) {
    switch (action.type) {
        case GET_ERRORS:
            return {
                ...state,
                error: action.payload
            }

        default:
            return state
    }
}