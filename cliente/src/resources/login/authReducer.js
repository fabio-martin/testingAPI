import {SET_CURRENT_USER} from "../../utils/actions/actionsTypes";

const initialState = {
    user: localStorage.user == null ? {
        id: null,
        name: null,
        isAuthenticated: false,
        roles: []
    } : JSON.parse(localStorage.user),
    userToken: {},
    validToken: false
}

const booleanActionPayload = (payload) => {
    if(payload)
    {
        return true;
    }
    else {
        return false;
    }

}

export default function (state = initialState, action) {

    switch (action.type) {
        case SET_CURRENT_USER:
            return {
                ...state,
                validToken: booleanActionPayload(action.payload),
                userToken: action.payload
            }

        default:
            return state;
    }

}