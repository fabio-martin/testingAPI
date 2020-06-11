import {combineReducers} from 'redux';
import errorReducer from "./errorReducer";
import categoryReducer from "../../resources/category/categoryReducer";
import authReducer from "../../resources/login/authReducer";
import dashboardReducer from "../../resources/dashboard/dashboardReducer";
import productReducer from "../../resources/product/productReducer";
import warehouseReducer from '../../resources/warehouse/warehouseReducer'
import userReducer from "../../resources/user/userReducer";
import {reducer as formReducer} from 'redux-form'
import requestReducer from "../../resources/request/requestReducer";
import productsStockReducer from '../../resources/stock/stockReducer'

import {persistReducer} from 'redux-persist';
//allows access to windows.localStorage
import storage from 'redux-persist/lib/storage';


const persistConfig = {
    key: 'root',
    storage,
    whitelist: [
        // 'errorsReducer',
        'form',
        // 'dashboardReducer',
        'categoryReducer',
        // 'userReducer',
        'productReducer',
        'warehouseReducer',
        'warehouseEditReducer',
        // 'authReducer',
        // 'requestReducer',
        productsStockReducer
    ]
}

const rootReducer = combineReducers({
    errorsReducer: errorReducer,
    form: formReducer,

    //dashboard: () => ({summary: {totalRequest: 100, totalOpenRequest: 33}}),  //recebe 2 parametros => 1ยบ = estado(store), 2ยบ = action
    dashboardReducer: dashboardReducer,
    categoryReducer: categoryReducer,
    userReducer: userReducer,
    productReducer: productReducer,
    warehouseReducer: warehouseReducer.warehouseReducer,
    warehouseEditReducer: warehouseReducer.warehouseEditReducer,
    authReducer: authReducer,
    requestReducer: requestReducer,
    productsStockReducer: productsStockReducer
})

export default persistReducer(persistConfig,rootReducer);


