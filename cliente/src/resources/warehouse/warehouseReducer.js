import TYPES from './warehouse.types'

const currentState = {
    data: {
        warehouses : []
    },
    edit: {
        currentWarehouse: {
            id:'',
            name: '',
            location: ''
        }
    }
}

const warehouseEditReducer = (state = currentState.edit, action) =>{
    switch(action.type){
        case TYPES.ADD_CHANGE:
            const newForm = state.currentWarehouse;
            newForm[action.payload.name] = action.payload.value;
            return {
                ...state,
                currentWarehouse: {...state.currentWarehouse, newForm}
            };
        case TYPES.EDIT_WAREHOUSE:
            let currentWarehouse = state.currentWarehouse
            action.payload
                    .createWarehouse(currentWarehouse)
                    .then(res => {
                        if(res.success){
                            currentWarehouse = res.data
                        }
                        return res.data
                    })
            return {
                ...state,
                currentWarehouse: currentWarehouse
            }
        case TYPES.GET_WAREHOUSE_BY_ID:
            const warehouse = action.payload.data
            return {
                ...state,
                currentWarehouse: warehouse
            }
        default:
            return state;
    }
        
}




const warehouseReducer = (state = currentState.data, action) => {
    switch(action.type){
        case TYPES.GET_ALL_WAREHOUSES:
            return {
                ...state,
                warehouses: [...action.payload.data]
            }
        case TYPES.DELETE_WAREHOUSE:
            return {
                ...state,
                warehouses: state.warehouses.filter(warehouse=>warehouse.id !== action.payload)
            }
        // case TYPES.UPDATE_WAREHOUSE:
        //     console.log(`UPDATE: ${action.payload.data}`)
        //     return {
        //         ...state,
        //         warehouses: state.warehouses.map(obj =>{
        //             const warehouse = action.payload.data
        //             return obj.id === warehouse.id ? warehouse : obj
        //             }
        //         )
        //     }
    
        default:
            return state;
    }
}

export default {
    warehouseReducer,
    warehouseEditReducer,
};