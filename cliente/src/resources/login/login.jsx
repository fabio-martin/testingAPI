import './auth.css'

import React, {Component} from 'react'
import PropTypes from 'prop-types'
import {connect} from 'react-redux'
import classnames from 'classnames'
import {login} from './authActions'

class Login extends Component {
    constructor() {
        super()
        this.state = {
            email: '',
            password: '',
            errors: {}
        }

        this.onChange = this.onChange.bind(this)
        this.onSubmit = this.onSubmit.bind(this)
    }

    onChange(e) {
        this.setState({[e.target.name]: e.target.value})
    }

    componentWillReceiveProps(nextProps, nextContext) {
        if (nextProps.authFromReducer.validToken) {
            this.props.history.push("/")
        }

        if (nextProps.errors) {
            this.setState({errors: nextProps.errors})
        }
    }

    componentDidMount() {
        if (this.props.authFromReducer.validToken)
            this.props.history.push("/")
    }

    onSubmit(e) {
        e.preventDefault()

        const loginRequest = {
            email: this.state.email,
            password: this.state.password,
            errors: {}
        }

        this.props.login(loginRequest)

        // login(loginRequest).then(res => {
        //     console.log(res)
        //     if (res) {
        //         this.props.history.push(`/`)
        //     }
        // })
    }

    render() {
        const {errors} = this.state


        return (
            <section className="content-header">
                <form noValidate onSubmit={this.onSubmit}>
                    <div className="row text-center pt-2">
                        <div className="col-md-3"></div>
                        <div className="col-md-5">
                            <div className="card">
                                <div className="card-header">
                                    <div className="login-logo">
                                        {/*<a href="#"><b>ILuminate</b>Gest</a>*/}
                                    </div>
                                    <img src="/images/logo_full.png" className="img-circle" alt="ILuminateGest"/>
                                    <div className="card-body">
                                        <div className="form-group">
                                            <label htmlFor="email">Email</label>
                                            <input
                                                type="email"
                                                className={classnames("form-control", {
                                                    "is-invalid": errors.email
                                                })}
                                                name="email"
                                                placeholder="Enter email"
                                                value={this.state.email}
                                                onChange={this.onChange}/>
                                            {
                                                errors.email && (
                                                    <div className="invalid-feedback">{errors.email}</div>
                                                )
                                            }
                                        </div>
                                        <div className="form-group">
                                            <label htmlFor="password">Password</label>
                                            <input
                                                type="password"
                                                className={classnames("form-control", {
                                                    "is-invalid": errors.password
                                                })}
                                                name="password"
                                                placeholder="Password"
                                                value={this.state.password}
                                                onChange={this.onChange}/>
                                            {
                                                errors.password && (
                                                    <div className="invalid-feedback">{errors.password}</div>
                                                )
                                            }
                                        </div>
                                    </div>
                                    <div className="card-footer p-0">
                                        <button type="submit" className="btn btn-lg btn-primary btn-block">Login</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-4"></div>
                </form>
            </section>
        )
    }
}


Login.propTypes = {
    login: PropTypes.func.isRequired,
    errors: PropTypes.object.isRequired,
    authFromReducer: PropTypes.object.isRequired
}
const mapStateToProps = state => ({
    authFromReducer: state.authReducer,
    errors: state.errorsReducer
})

export default connect(mapStateToProps, {login})(Login)