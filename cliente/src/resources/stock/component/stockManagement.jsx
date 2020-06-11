
import React,{Component} from 'react';
import {Link} from "react-router-dom";
import RowProductStock from './row-productStock.component'
import {getWarehouseProductsStock} from '../stockAction'
import {connect} from 'react-redux'
import {bindActionCreators} from 'redux'
import PropTypes from 'prop-types';

class StockManagement extends Component {

    constructor(props){
        super(props)
        this.state = {
            warehouse : this.props.location.state.fromWarehouse
        }
    }

    componentDidMount(){
        
        const warehouseId = this.state.warehouse.id
        this.props.getWarehouseProductsStock(warehouseId)
    }

    render() {
        const warehouse = this.state.warehouse
       
        return (
            <section className="content-header">
                <div className="card">
                    <div className="card-header">
                        
                        <h3 className="card-title">
                            <Link to="/warehouse">
                                <i className="fas fa-list fa-fw"></i>
                            </Link>
                                {warehouse.name} | {warehouse.location}
                        </h3>
                        
                        <a className="btn btn-success btn-xs float-right" href="/product">
                            <i className="fa fa-plus" title="Add" aria-hidden="true"></i>
                            <span className="sr-only">Add</span>
                        </a>
                    </div>
                    <div className="card-body p-4">
                        <div className="row align-items-start p-2">
                            <div className="col-md-1"><h3 className="stock-header">Id</h3></div>
                            <div className="col-md-2"><h3 className="stock-header">Product</h3></div>
                            <div className="col-md-2"><h3 className="stock-header">Price</h3></div>
                            <div className="col-md-2"><h3 className="stock-header">Stock</h3></div>
                            <div className="col-md-3"><h3 className="stock-header">Remove/Add</h3></div>
                        </div>
                        {
                            this.props.warehouseProductsStock.map(product => {
                                let productId = product.id
                                return <RowProductStock 
                                    key={productId}
                                    warehouseId={warehouse.id}
                                    product={product}/>
                            })
                        }
                        
                    </div>
                    <div className="card-footer"></div>
                </div>
            </section>
        )
    }

}
StockManagement.propTypes = {
    getWarehouseProductsStock: PropTypes.func.isRequired,
}

const mapStateToProps = state => ({
    warehouseProductsStock: state.productsStockReducer.warehouseProductsStock
})

const mapDispatchToProps = dispatch => bindActionCreators({getWarehouseProductsStock}, dispatch)

export default connect(mapStateToProps,mapDispatchToProps)(StockManagement);