import React, {Component} from 'react';
import {connect} from 'react-redux'
import {index, destroy} from "../userActions";
import {bindActionCreators} from 'redux'
import PropTypes from 'prop-types';
import {Link} from "react-router-dom";


class Index extends Component {

    componentDidMount() {
        this.props.index()
    }

    onUpdatePassClick = id => {
        this.props.destroy(id)
    }

    onDeleteClick = id => {
        this.props.destroy(id)
    }

    render() {

        // this.props.dataFromReducer.users.map(user => (console.log(user)))
        return (
            <section className="content-header">
                <div className="card">
                    <div className="card-header">
                        <h3 className="card-title"><i className="fas fa-list fa-fw"></i>Users</h3>
                        <a className="btn btn-success btn-xs float-right" href="/user/create">
                            <i className="fa fa-plus" title="Add" aria-hidden="true"></i>
                            <span className="sr-only">Add</span>
                        </a>
                    </div>
                    <div className="card-body p-0">
                        <table className="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>

                            {

                                this.props.data.users.map(user => (
                                    <tr key={user.id}>
                                        <td>{user.id}</td>
                                        <td>{user.name}</td>
                                        <td>{user.email}</td>
                                        <td>{user.role[0].name}</td>
                                        <td>{user.created_at}</td>
                                        <td>{user.updated_at}</td>
                                        <td>

                                            <Link className="btn btn-info btn-xs" to="#"
                                                  onClick={this.onUpdatePassClick.bind(this, user.id)}
                                                  style={{marginRight: 2}}>
                                                <i className="fa fa-key" title="Delete" aria-hidden="true"></i>
                                                <span className="sr-only">Delete</span>
                                            </Link>

                                            <Link className="btn btn-warning btn-xs" to={`/user/${user.id}/edit`}
                                                  style={{marginRight: 2}}>
                                                <i className="fa fa-pencil-alt" title="Edit" aria-hidden="true"></i>
                                                <span className="sr-only">Edit</span>
                                            </Link>

                                            <Link className="btn btn-danger btn-xs" to="#"
                                                  onClick={this.onDeleteClick.bind(this, user.id)}>
                                                <i className="fa fa-trash-alt" title="Delete" aria-hidden="true"></i>
                                                <span className="sr-only">Delete</span>
                                            </Link>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                    <div className="card-footer"></div>
                </div>
            </section>
        );
    }
}

Index.propTypes = {
    data: PropTypes.object.isRequired,
    index: PropTypes.func.isRequired
}

const mapStateToProps = state => ({
    data: state.userReducer,
})

const mapDispatchToProps = dispatch => bindActionCreators({index, destroy}, dispatch)

export default connect(mapStateToProps, mapDispatchToProps)(Index);