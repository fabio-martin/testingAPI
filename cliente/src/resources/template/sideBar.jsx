/* eslint-disable jsx-a11y/anchor-is-valid */
// SideBar.js
import React, {Component} from 'react';
import PropTypes from "prop-types";
import {connect} from "react-redux";
import Menu from "./menu"

class SideBar extends Component {

    render(){
        // console.log(this.props.authFromReducer.user)
        // const {name, email} = this.props.authFromReducer.user

        const {validToken, userToken, user} = this.props.data
        const userIsNotAuthenticated = ('')
        const userIsAuthenticated = (
            <aside className="main-sidebar sidebar-dark-primary elevation-4">
                <a href="/" className="brand-link">
                    <img src="/images/logo.png" alt="ILuminateGest"
                         className="brand-image img-circle elevation-3"
                         />
                        <span className="brand-text font-weight-light">IluminateGest</span>
                </a>

                <div className="sidebar">
                    <div className="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div className="image">
                            <img src="/images/user.png" className="img-circle elevation-2" alt="João Acácio" />
                        </div>
                            <div className="info">
                                <a href="#" className="d-block">
                                {user.name || ''}
                                </a>
                            </div>
                    </div>

                    <nav className="mt-2">
                        <Menu />
                    </nav>
                </div>
            </aside>


        )

        let sideBar;
        if (validToken && userToken) {
            sideBar = userIsAuthenticated
        } else {
            sideBar = userIsNotAuthenticated
        }

        return (<div>{sideBar}</div>)
    }
}


SideBar.propTypes = {
    // logout: PropTypes.func.isRequired,
    data: PropTypes.object.isRequired
}

const mapStateToProps = state => ({
    data: state.authReducer,
    //user: JSON.parse(localStorage.getItem('user'))
})

export default connect(mapStateToProps)(SideBar)