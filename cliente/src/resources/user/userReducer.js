const initialState = {
    roles: [],
    users: [],
    user: {}

}

export default (state = initialState, action) => {
    switch (action.type) {
        case 'User_INDEX':
            return {
                ...state,
                users: action.payload.data.users
            };

        case 'User_GET':
            return {
                ...state,
                user: action.payload
            };

        case 'User_CREATE':
            // console.log(action.payload.data.categories)
            return {
                ...state,
                categories: action.payload.data.categories,
                roles: action.payload.data.roles
            };

        case 'User_EDIT':
            console.log("EDIT USER")
            // console.log(action.payload.data.categories)
            return {
                ...state,
                user: action.payload.data.user,
                roles: action.payload.data.roles
            };

        case 'User_DESTROY':
            return {
                ...state,
                users: state.users.filter(user=>user.id !== action.payload)
            };

        default:
            return state;
    }
}