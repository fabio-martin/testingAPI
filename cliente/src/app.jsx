// App.js
import React, {Component} from 'react';

import {Provider} from "react-redux";
import {PersistGate} from 'redux-persist/integration/react';
import rootStore from './store';

import Header from "./resources/template/header";
import SideBar from "./resources/template/sideBar";

import jwt_decode from 'jwt-decode'
import setTokenHeader from "./utils/setTokenHeader";
import {SET_CURRENT_USER} from "./utils/actions/actionsTypes";
import {logout} from "./resources/login/authActions";
import Footer from "./resources/template/footer";
import MyRoutes from "./utils/routes";

const token = localStorage.usertoken
console.log(token)
console.log('localStorage')
console.log(localStorage)
if (token) {
    setTokenHeader(token)
    const decoded_token = jwt_decode(token)
    // console.log(decoded_token)
    rootStore.store.dispatch(
        {
            type: SET_CURRENT_USER,
            payload: decoded_token
        }
    )

    const currentTime = Date.now() / 1000
    if (decoded_token.exp < currentTime) {
        rootStore.store.dispatch(logout())
        window.location.href = "/"
    }
}


class App extends Component {
    render() {

        const footer = token ? <Footer/> : ''

        return (
            
            <Provider store={rootStore.store}>
                <PersistGate persistor={rootStore.persistor}>
                    {/*<div className={App}>*/}
                    <div>
                        <Header/>
                        <SideBar/>
                        {/*{localStorage.usertoken ? <Header /> : ''}*/}
                        {/*{localStorage.usertoken ? <SideBar /> : '' }*/}
                        <div className="content-wrapper">
                            <MyRoutes/>
                        </div>
                    {footer}
                    </div>
                </PersistGate>
            </Provider>
           
        );
    }
}

export default App;
