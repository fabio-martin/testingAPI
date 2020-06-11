const initialState = {
    products: [],
    productsShow: [],
    categories: [],
    provenance: [],
    product: {},
    request: {products:[], provenance:{id:0}},
    totalPriceRequest:0
}

function amount(item) {
    return item.price * item.qtd
}

function sum(prev, next) {
    return +prev + +next;
}

export default (state = initialState, action) => {
    switch (action.type) {

        case 'Request_CREATE':
            // console.log(action.payload.data.categories)
            return {
                ...state,
                categories: action.payload.data.categories,
                products: action.payload.data.products,
                provenance: action.payload.data.provenance,
            };

        case 'Request_SELECT_CATEGORY':
            return {
                ...state,
                productsShow: state.products.filter(product=>product.idCategory === action.payload),
            };

        case 'Request_SELECT_PROVENANCE':
            state.request.provenance=action.payload
            return {
                ...state
            };

        case 'Request_Add_Product_Request':
            var exist=0;
            state.request.products.forEach(function (product) {
                if(product.id===action.payload.id)
                    {
                        product.qtd++;
                        exist=1;
                    }
            })

            if(exist===0)
            {
                action.payload.qtd=1;
                state.request.products.push(action.payload);
            }

            return {
                ...state,
                totalPriceRequest: state.request.products.length > 0 ? state.request.products.map(amount).reduce(sum) : 0
            };


        // case 'Request_INDEX':
        //     return {
        //         ...state,
        //         products: action.payload.data.products,
        //     };

        // case 'Request_GET':
        //     return {
        //         ...state,
        //         product: action.payload
        //     };



        // case 'Request_EDIT':
        //     console.log("EDIT product")
        //     // console.log(action.payload.data.categories)
        //     return {
        //         ...state,
        //         product: action.payload.data.product,
        //         categories: action.payload.data.categories
        //     };
        //
        // case 'Request_DESTROY':
        //     return {
        //         ...state,
        //         products: state.products.filter(product=>product.id !== action.payload)
        //     };

        default:
            return state;
    }
}