import React, {Component} from "react";
import {connect} from "react-redux";
import {logout} from "../login/authActions";
import PropTypes from "prop-types";

class Menu extends Component {

    logOut() {
        this.props.logout();
        window.location.href = "/"
        // localStorage.removeItem('usertoken')
        // this.props.history.push("/")
    }

    render() {
        return (<ul className="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
            <li className="nav-item has-treeview menu-open">
                <a href="#" className="nav-link active">
                    <i className="nav-icon fas fa-kaaba"></i>
                    <p>
                        Geral
                        <i className="right fas fa-angle-left"></i>
                        <span className="right badge badge-warning">New</span>
                    </p>
                </a>
                <ul className="nav nav-treeview">
                    <li className="nav-item">
                        <a href="/request/create" className="nav-link active">
                            <i className="far fa-circle nav-icon"></i>
                            <p>New</p>
                        </a>
                    </li>
                    <li className="nav-item">
                        <a href="#" className="nav-link active">
                            <i className="far fa-circle nav-icon"></i>
                            <p>Open</p>
                        </a>
                    </li>
                </ul>
            </li>


            <li className="nav-item has-treeview">
                <a href="#" className="nav-link">
                    <i className="nav-icon fas fa-cogs"></i>
                    <p>
                        Administration
                        <i className="fas fa-angle-left right"></i>
                        <span className="badge badge-info right">6</span>
                    </p>
                </a>
                <ul className="nav nav-treeview">
                    <li className="nav-item">
                        <a href="/user" className="nav-link">
                            <i className="far fa-circle nav-icon"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li className="nav-item">
                        <a href="/category" className="nav-link">
                            <i className="far fa-circle nav-icon"></i>
                            <p>Categories</p>
                        </a>
                    </li>
                    <li className="nav-item">
                        <a href="/product" className="nav-link">
                            <i className="far fa-circle nav-icon"></i>
                            <p>Produts</p>
                        </a>
                    </li>
                    <li className="nav-item">
                        <a href="/warehouse" className="nav-link">
                            <i className="far fa-circle nav-icon"></i>
                            <p>Warehouses</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li className="nav-item">
                <a href="#" onClick={this.logOut.bind(this)} className="nav-link">
                    <i className="nav-icon fas fa-sign-out-alt"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>)
    }

}

Menu.propTypes = {
    logout: PropTypes.func.isRequired,
}

const mapStateToProps = state => ({})

export default connect(mapStateToProps, {logout})(Menu)