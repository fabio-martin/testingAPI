import React from "react";
import {Route, Redirect} from "react-router-dom";
import {connect} from 'react-redux'
import PropTypes from 'prop-types'

const SecuredRoute = ({component: Component, authFromReducer, ...otherProps}) => (
    <Route
        {...otherProps}
        render={props =>
            authFromReducer.validToken === true ? (
                    <Component {...props} />)
                : (
                    <Redirect to="login"/>
                )
        }/>
)

SecuredRoute.propTypes = {
    authFromReducer: PropTypes.object.isRequired
}
const mapStateToProps = state => ({
    authFromReducer: state.authReducer,
})

export default connect(mapStateToProps) (SecuredRoute)