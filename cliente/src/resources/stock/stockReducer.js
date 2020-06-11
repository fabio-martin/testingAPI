import TYPES from './stock.types'
const currentState = {
    data: {
        warehouseProductsStock: []
    },
}

const productsStockReducer = (state = currentState.data, action) => {
    console.log('WarehouseProductsStock-----currentState')
    console.log(state)
                
    switch(action.type){
        case TYPES.GET_ALL_WAREHOUSE_PRODUCTS_STOCK:
            return {
                ...state,
                warehouseProductsStock: action.payload
            }
        case TYPES.UPDATE_PRODUCT_PRICE:
            return {
                ...state,
                warehouseProductsStock: updatesProductPrice(state.warehouseProductsStock,action.payload)
            }
        case TYPES.UPDATE_PRODUCT_STOCK:
            return {
                ...state,
                warehouseProductsStock: updatesProductStock(state.warehouseProductsStock,action.payload)
            }
        case TYPES.REMOVE_PRODUCT_FROM_WAREHOUSE:
            return {
                ...state,
                warehouseProductsStock: state.warehouseProductsStock.filter(p => {
                    const {wId,pId} = action.payload
                   return !(Number(p.id) === Number(pId) && Number(p.pivot.warehouse_id) === Number(wId)) 
                })
            }
        default:
            return state
    }
}

export default productsStockReducer;

function updatesProductPrice(products, product){
    return products.map(p => {
        if(p.id === product.id){
            p.price = product.price
        }
        return p
    })
}

function updatesProductStock(products, data){
    return products.map(p => {
        if(p.id === data.pivot.product_id){
            p.pivot.stock = data.pivot.stock
        }
        return p
    })
}