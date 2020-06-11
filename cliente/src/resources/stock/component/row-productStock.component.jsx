import './stock-styles.css'
import React from 'react';
import {Link} from "react-router-dom";
import {updateProductStock, updateProductPrice, removeProductFromWarehouse} from '../stockAction'
import {connect} from 'react-redux'
import {bindActionCreators} from 'redux'
import PropTypes from 'prop-types';

class RowProductStock extends React.Component {

    state = {
        amount: 0,
        stock: this.props.product.pivot.stock,
        price: this.props.product.price
    }

    onClickEditPrice = (event) => {
        console.log('onClickEditPrice')
        console.log(this.state)
        event.preventDefault();
        this.props.updateProductPrice(this.props.product.id,this.state.price)
    }

    handleEditPrice = (event) => {
        event.preventDefault();
        let value = event.target.value
        this.setState({price: value})
    }

    amountChange = (event) => {
        event.preventDefault();
        let value = event.target.value
        this.setState({amount: value})
    }

    handleMinus = (event) => {
        event.preventDefault();
        const amount = -Math.abs(this.state.amount)
        let stock = Math.abs(this.state.stock) + amount
        this.props.updateProductStock(this.props.warehouseId, this.props.product.id, amount)
        if(stock >=0 ){
            this.setState({
                        amount: 0,
                        stock: stock
                    }
                )
        }
    }

    handlePlus = (event) => {
        event.preventDefault();
        const amount = Math.abs(this.state.amount)
        const stock = Math.abs(this.state.stock) + amount
        this.props.updateProductStock(this.props.warehouseId, this.props.product.id, amount)
        this.setState({
                    amount: 0,
                    stock: stock
                }
            )
    }

    handleRemoveProduct = (event) => {
        event.preventDefault();
        this.props.removeProductFromWarehouse(this.props.warehouseId, this.props.product.id)
    }
    
    render(){
        const p= this.props.product
        return (
            <div className="row align-items-start p-1">
                <div className="col-md-1">{p.id}</div>
                <div className="col-md-2">{p.product}</div>
                <div className="col-md-2" >
                    <div className="input-group mb-3 input-group-sm">
                        <span className="input-group-prepend">&#8364;</span>
                        <input className="text" size="6" value={this.state.price} onChange={this.handleEditPrice}/> 
                        <span className="input-group-append">
                            <button className="btn btn-warning btn-sm" onClick={this.onClickEditPrice}>
                                <i className="fa fa-database" title="Edit" aria-hidden="true"></i>
                                <span className="sr-only">Edit</span>
                            </button>
                        </span>
                    </div>   
                </div>
                <div className="col-md-2">{this.state.stock}</div>
                <div className="col-md-2"> 
                    <div className="input-group mb-3 input-group-sm">
                        <span className="input-group-prepend">
                            <button type="button" className="btn btn-secondary btn-number" data-type="minus" data-field="quant[3]" onClick={this.handleMinus}>
                                <i className="fa fa-minus" aria-hidden="true"></i>
                            </button>
                        </span>
                        <input type="number" name="quant[]" className="form-control" value={this.state.amount} min="1" max="999" onChange={this.amountChange}/>
                        <span className="input-group-append">
                            <button type="button" className="btn btn-primary btn-number" data-type="plus" data-field="quant[3]" onClick={this.handlePlus}>
                                <i className="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </span>
                    </div>   
                </div>
                <div className="col-md-1">
                    <Link className="btn btn-danger btn-sm" to="#" onClick={this.handleRemoveProduct}>
                        <i className="fa fa-times" title="Remove" aria-hidden="true"></i>
                        <span className="sr-only">Remove</span>
                    </Link>
                </div>
            </div>
        )
    }
    
}

RowProductStock.propTypes = {
    updateProductStock: PropTypes.func.isRequired,
    removeProductFromWarehouse: PropTypes.func.isRequired,
    updateProductPrice: PropTypes.func.isRequired
}

const mapDispatchProps = dispatch => bindActionCreators({
    updateProductStock, 
    removeProductFromWarehouse,
    updateProductPrice
}, dispatch)

export default connect(null, mapDispatchProps)(RowProductStock);