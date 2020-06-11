import React, {Component} from 'react';
// import ProductTableTr from "./CategoryTableTr";
import {connect} from 'react-redux'
import {index, destroy} from "../productActions";
import {bindActionCreators} from 'redux'
import PropTypes from 'prop-types';
import CategoriaTableTr from "../../category/component/CategoryTableTr";
import {Link} from "react-router-dom";


class Index extends Component {

    componentWillMount() {
        this.props.index()
    }

    onDeleteClick = id => {
        this.props.destroy(id)
    }

    render() {
        console.log(this.props.dataFromReducer.products)
        return (
            <section className="content-header">
                <div className="card">
                    <div className="card-header">
                        <h3 className="card-title"><i className="fas fa-list fa-fw"></i>Products</h3>
                        <a className="btn btn-success btn-xs float-right" href="/product/create">
                            <i className="fa fa-plus" title="Add" aria-hidden="true"></i>
                            <span className="sr-only">Add</span>
                        </a>
                    </div>
                    <div className="card-body p-0">
                        <table className="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Unit</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>

                            {
                                this.props.dataFromReducer.products.map(product => (
                                    <tr key={product.id}>
                                        <td>{product.id}</td>
                                        <td>{product.product}</td>
                                        <td>{product.category.category}</td>
                                        <td>{product.price}€</td>
                                        <td>{product.unit}</td>
                                        <td>{product.created_at}</td>
                                        <td>{product.updated_at}</td>
                                        <td>
                                            <Link className="btn btn-warning btn-xs" to={`/product/${product.id}/edit`}
                                                  style={{marginRight: 2}}>
                                                <i className="fa fa-pencil-alt" title="Edit" aria-hidden="true"></i>
                                                <span className="sr-only">Edit</span>
                                            </Link>

                                            <Link className="btn btn-danger btn-xs" to="#"
                                                  onClick={this.onDeleteClick.bind(this, product.id)}>
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
    dataFromReducer: PropTypes.object.isRequired,
    index: PropTypes.func.isRequired
}

const mapStateToProps = state => ({
    dataFromReducer: state.productReducer,
})

const mapDispatchToProps = dispatch => bindActionCreators({index, destroy}, dispatch)

export default connect(mapStateToProps, mapDispatchToProps)(Index);