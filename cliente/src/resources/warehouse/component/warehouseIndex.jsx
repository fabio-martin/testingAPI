import React,{Component} from 'react';
import {connect} from 'react-redux'
import {index, destroy} from '../warehouseActions'
import {bindActionCreators} from 'redux'
import {Link} from "react-router-dom";
import PropTypes from 'prop-types';

class WarehouseIndex extends Component {

    componentDidMount() {
        this.props.index()
    }

    onDeleteClick = id => {
        this.props.destroy(id)
    }

    render() {
        console.log(this.props)
        return (
            <section className="content-header">
                <div className="card">
                    <div className="card-header">
                        <h3 className="card-title"><i className="fas fa-list fa-fw"></i>WareHouses</h3>
                        <a className="btn btn-success btn-xs float-right" href="/warehouse/create">
                            <i className="fa fa-plus" title="Add" aria-hidden="true"></i>
                            <span className="sr-only">Add</span>
                        </a>
                    </div>
                    <div className="card-body p-0">
                        <table className="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>WareHouses</th>
                                <th>Location</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                            </tr>
                            </thead>
                            <tbody>
                            {
                                this.props.warehousesData.warehouses.map(warehouse => {
                                    let id = warehouse.id
                                    return (
                                        <tr key={id} >
                                            <td>{id}</td>
                                            <td>
                                                <Link to={{
                                                    pathname: '/stock',
                                                    state: { fromWarehouse: warehouse }
                                                }} >
                                                    {warehouse.name}
                                                </Link> 
                                            </td>
                                            <td>
                                                <Link to={{
                                                    pathname: '/stock',
                                                    warehouse:{warehouse}
                                                }} >
                                                    {warehouse.location}
                                                </Link> 
                                            </td>
                                            <td>{warehouse.created_at}</td>
                                            <td>{warehouse.updated_at}</td>
                                            <td>
                                                <Link className="btn btn-warning btn-xs" to={`/warehouse/${id}/edit`}
                                                    style={{marginRight: 2}}>
                                                    <i className="fa fa-pencil-alt" title="Edit" aria-hidden="true"></i>
                                                    <span className="sr-only">Edit</span>
                                                </Link>
    
                                                <Link className="btn btn-danger btn-xs" to="#"
                                                    onClick={this.onDeleteClick.bind(this, id)}>
                                                    <i className="fa fa-trash-alt" title="Delete" aria-hidden="true"></i>
                                                    <span className="sr-only">Delete</span>
                                                </Link>
                                            </td>
                                        </tr>
                                    )
                                })
                                    
                            }
                            </tbody>
                        </table>
                    </div>
                    <div className="card-footer"></div>
                </div>
            </section>
        );
    }
}

WarehouseIndex.propTypes = {
    warehousesData: PropTypes.object.isRequired,
    index: PropTypes.func.isRequired
}

const mapStateToProp = state => ({
    warehousesData: state.warehouseReducer,
})

const mapDispatchToProps = dispatch => bindActionCreators({index, destroy}, dispatch)

export default connect(mapStateToProp, mapDispatchToProps)(WarehouseIndex);