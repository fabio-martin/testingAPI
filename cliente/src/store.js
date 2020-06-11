import {applyMiddleware, compose, createStore} from "redux";
import thunk from "redux-thunk";
import allReducers from './utils/reducers/reducers'
import {persistStore} from 'redux-persist';

const initialState = {}
const middleware = [thunk]

let store;

const ReactReduxDevTools = window.__REDUX_DEVTOOLS_EXTENSION__ && window.__REDUX_DEVTOOLS_EXTENSION__()

if(window.navigator.userAgent.includes('Chrome') && ReactReduxDevTools)
{
    store = createStore(
        allReducers,
        initialState,
        compose(applyMiddleware(...middleware),
            ReactReduxDevTools
        )
    )
}
else
{
    store = createStore(
        allReducers,
        initialState,
        compose(applyMiddleware(...middleware))
    )
}


const persistor = persistStore(store)

const rootStore = { store, persistor}

export default rootStore;