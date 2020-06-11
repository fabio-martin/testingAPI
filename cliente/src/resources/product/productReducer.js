
const initialState = {
    products: [],
    categories: [],
    product: {}

}

export default (state = initialState, action) => {
    switch (action.type) {
        case 'Product_INDEX':
            return {
                ...state,
                products: action.payload.data.products
            };

        case 'Product_GET':
            return {
                ...state,
                product: action.payload
            };

        case 'Product_CREATE':
            // console.log(action.payload.data.categories)
            return {
                ...state,
                categories: action.payload.data.categories
            };

        case 'Product_EDIT':
            console.log("EDIT product")
            // console.log(action.payload.data.categories)
            return {
                ...state,
                product: action.payload.data.product,
                categories: action.payload.data.categories
            };

        case 'Product_DESTROY':
            return {
                ...state,
                products: state.products.filter(product=>product.id !== action.payload)
            };

        default:
            return state;
    }
}