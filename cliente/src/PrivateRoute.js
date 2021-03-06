import {Redirect, Route} from "react-router-dom";
import React from "react";

const PrivateRoute = ({component: Component, ...rest}) => (

    <Route {...rest} render={(props)=>(
        localStorage.usertoken ? <Component {...props}/>: <Redirect to="/login" />
    )}/>


)

export default PrivateRoute