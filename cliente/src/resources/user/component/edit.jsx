import React, {Component} from 'react';
import {edit, update} from "../userActions";
import PropTypes from 'prop-types';
import {connect} from 'react-redux';
import classnames from 'classnames';


class UserEdit extends Component {

    componentDidMount() {
        const {id} = this.props.match.params
        this.props.edit(id, this.props.history)
    }

    constructor() {
        super()

        this.state = {
            id: '',
            name: "",
            email: "",
            role: "",
            errors: {}
        }

        this.onChange = this.onChange.bind(this)
        this.onSubmit = this.onSubmit.bind(this)
    }


    componentWillReceiveProps(nextProps, nextContext) {
        //nao perder o conteudo do form
        if(nextProps.errorsFromReducer)
        {
            this.setState({errors: nextProps.errorsFromReducer})
        }
        // console.log(nextProps.dataFromReducer)
        const {id, name, email} = nextProps.dataFromReducer.user[0]
        this.setState({id, name, email})

        this.setState({
            role: nextProps.dataFromReducer.user[0].role[0].name
        });
    }

    onChange(e) {
        this.setState({[e.target.name]: e.target.value})
    }

    onSubmit(e) {
        e.preventDefault()
        const user = {
            id: this.state.id,
            name: this.state.name,
            email: this.state.email,
            role: this.state.role,
        }

        console.log(user)

        this.props.update(user, this.props.history)
    }

    render() {
        const {errors} = this.state

        // console.log(this.props)


        return (
            <section className="content-header">
                <div className="row">
                    <div className="col-md-12">
                        <div className="card card-warning">
                            <div className="card-header with-border">
                                <h3 className="card-title">Edit</h3>
                            </div>
                            <form role="form" onSubmit={this.onSubmit}>
                                <div className="card-body">
                                    <div className="row">
                                        <div className="col-md-4">
                                            <div className="form-group">
                                                <label>Nome</label>
                                                <input type="text" name="name"
                                                       className={classnames("form-control", {
                                                           "is-invalid": errors.name
                                                       })}
                                                       placeholder="" value={this.state.name}
                                                       onChange={this.onChange}/>
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
                                                <label>Roles</label>
                                                <select className={classnames("form-control select2", {
                                                    "is-invalid": errors.role
                                                })} name="role"
                                                        value={this.state.role}
                                                        onChange={this.onChange.bind(this)}  >
                                                    {this.props.dataFromReducer.roles.map(role => (
                                                        <option key={role.id} value={role.name}
                                                        >{role.name}</option>
                                                    ))}
                                                </select>
                                                {errors.role && (
                                                    <div className="invalid-feedback">{errors.role}</div>
                                                )}
                                            </div>
                                        </div>
                                        <div className="col-md-4"></div>
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

UserEdit.propTypes = {
    errorsFromReducer: PropTypes.object.isRequired
}

const mapStateToProps = state => ({
    dataFromReducer: state.userReducer,
    errorsFromReducer: state.errorsReducer,
})

export default connect(mapStateToProps, {edit, update})(UserEdit);