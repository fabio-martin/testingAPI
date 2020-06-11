const initialState = {
    summary: {totalRequest: 0, totalOpenRequest: 0},
    requests: []
}

export default function (state = initialState, action) {
    switch (action.type) {
        case 'DASHBOARD_INDEX':
            // console.log(action.payload)
            return {
                ...state, //replica este
                requests: action.payload.requests
                // summary: {totalRequest: 1110, totalOpenRequest: 2220} //altera apenas o summary
            };

        // case DELETE_CATEGORIA:
        //     return {
        //         ...state,
        //         categorias: state.categorias.filter(categoria=>categoria.id !== action.payload)
        //     };

        default:
            return state;
    }
}