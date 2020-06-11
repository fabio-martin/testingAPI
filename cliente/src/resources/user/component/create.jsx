import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {connect} from 'react-redux';
import {create, store} from "../userActions";
import classnames from 'classnames'
// var Select = require('react-select');


class Create extends Component {

    constructor() {
        super()

        this.state = {
            name: "",
            email: "",
            password: "",
            role: "",
            errors: {}
        }

        this.onChange = this.onChange.bind(this)
        this.onSubmit = this.onSubmit.bind(this)
    }

    componentWillMount() {
        console.log('componentWillMount')
        this.props.create()
    }

    componentDidMount() {
        console.log('componentDidMount')
    }

    //life cycle hooks
    componentWillReceiveProps(nextProps, nextContext) {
        if (nextProps.errorsFromReducer) {
            this.setState({errors: nextProps.errorsFromReducer})
        }
    }


    onChange(e) {
        this.setState({
            [e.target.name]: e.target.value
        })
        // console.log(this.state)
    }

    onSubmit(e) {
        e.preventDefault()
        const user = {
            name: this.state.name,
            email: this.state.email,
            password: this.state.password,
            role: this.state.role
        }
        // console.log(newUser)
        this.props.store(user, this.props.history)

    }

    render() {
        const {errors} = this.state

        // var options = [
        //     { value: 'one', label: 'One' },
        //     { value: 'two', label: 'Two' }
        // ];

        // function logChange(val) {
        //     console.log("Selected: " + val);
        // }

        // console.log(this.props.dataFromReducer.categories)

        return (
            <section className="content-header">
                <div className="row">
                    <div className="col-md-12">
                        <div className="card card-primary">
                            <div className="card-header with-border">
                                <h3 className="card-title">Create</h3>
                            </div>
                            <form onSubmit={this.onSubmit}>
                                <div className="card-body">
                                    <div className="row">
                                        <div className="col-md-4">
                                            <div className="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name"
                                                       className={classnames("form-control", {
                                                           "is-invalid": errors.name
                                                       })}
                                                       placeholder="" value={this.state.name}
                                                       onChange={this.onChange.bind(this)}/>
                                                {errors.name && (
                                                    <div className="invalid-feedback">{errors.name}</div>
                                                )}
                                            </div>
                                        </div>
                                        <div className="col-md-4">
                                            <div className="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email"
                                                       className={classnames("form-control", {
                                                           "is-invalid": errors.email
                                                       })}
                                                       placeholder="" value={this.state.email}
                                                       onChange={this.onChange.bind(this)}/>
                                                {errors.email && (
                                                    <div className="invalid-feedback">{errors.email}</div>
                                                )}
                                            </div>
                                        </div>
                                        <div className="col-md-4">
                                            <div className="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password"
                                                       className={classnames("form-control", {
                                                           "is-invalid": errors.password
                                                       })}
                                                       placeholder="" value={this.state.password}
                                                       onChange={this.onChange.bind(this)}/>
                                                {errors.password && (
                                                    <div className="invalid-feedback">{errors.password}</div>
                                                )}
                                            </div>
                                        </div>

                                        <div className="col-md-4">
                                            <div className="form-group">
                                                <label>Roles</label>
                                                <select className={classnames("form-control select2", {
                                                    "is-invalid": errors.role
                                                })} name="role"
                                                        defaultValue=''
                                                        onChange={this.onChange.bind(this)}>
                                                    <option value='' disabled>Please Choose...</option>
                                                    {this.props.dataFromReducer.roles.map(role => (
                                                        <option key={role.id} value={role.id}>{role.name}</option>
                                                    ))}
                                                </select>
                                                {errors.role && (
                                                    <div className="invalid-feedback">{errors.role}</div>
                                                )}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="card-footer">
                                    <div className="row">
                                        <div className="col-md-12">
                                            <button type="submit"
                                                    className="btn btn-block btn-success pull-right">Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        );
    }
}

Create.propTypes = {
    create: PropTypes.func.isRequired,
    errorsFromReducer: PropTypes.object.isRequired
}

const mapStateToProps = state => ({
    errorsFromReducer: state.errorsReducer,
    dataFromReducer: state.userReducer
})

// const mapDispatchToProps = dispatch => bindActionCreators({create, store}, dispatch)

export default connect(mapStateToProps, {create, store})(Create);