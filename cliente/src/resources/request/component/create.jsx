import './custom.css'

import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {connect} from 'react-redux';
import {bindActionCreators} from 'redux'
import {create, store, select_category, select_provenance, add_Product_Request} from "../requestActions";
import classnames from 'classnames'

class Create extends Component {

    constructor() {
        super()

        this.state = {
            product: "",
            idCategory: "",
            // "updated_at": "2020-04-09 17:51:23",
            created_at: "",
            errors: {}
        }

        this.onChange = this.onChange.bind(this)
        this.onSubmit = this.onSubmit.bind(this)

        this.onSelectCategory = this.onSelectCategory.bind(this)
        this.add_Product_Request = this.onSelectCategory.bind(this)
    }

    componentWillMount() {
        console.log('componentWillMount')
        this.props.create()

    }

    componentDidMount() {
        console.log('componentDidMount')

        //this.state.idCategory=this.props.dataFromReducer.categories.first.id;

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
        this.props.store(this.props.data.request, this.props.history)
    }

    onSelectCategory(idCategory) {
        this.props.select_category(idCategory)
    }

    onSelectProvenance(provenance) {
        this.props.select_provenance(provenance)
    }

    onSelectProduct(product) {
        this.props.add_Product_Request(product)
    }

    render() {
        const {errors} = this.state

        // console.log(this.props.data.request)
        let requestCategories = []
        var exist = 0;

        this.props.data.request.products.forEach(function (productOnRequest) {
            exist = 0;
            requestCategories.forEach(function (category) {
                if (productOnRequest.category.id == category.id)
                    exist = 1;
            })
            if (exist == 0)
                requestCategories.push(productOnRequest.category)
        })


        // function amount(item) {
        //     return item.price * item.qtd
        // }
        //
        // function sum(prev, next) {
        //     return +prev + +next;
        // }

        //const totalPriceRequest = this.props.data.request.products.length > 0 ? this.props.data.request.products.map(amount).reduce(sum) : 0


        // Array.prototype.forEach.call(this.props.data.request.products, productOnRequest => {
        //     // if(!requestCategories.includes(productOnRequest.category))
        //     //     requestCategories.push(productOnRequest.category)
        // });

        return (
            <section className="content-header">
                <div className="row">
                    <div className="col-10 col-sm-10">
                        <div className="card card-primary card-tabs">
                            <div className="card-header p-0 pt-1">
                                <ul className="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li className="nav-item">
                                        <a className="nav-link active" id="requestTab1-tab" data-toggle="pill"
                                           href="#requestTab1" role="tab" aria-controls="custom-tabs-one-home"
                                           aria-selected="true">Tables</a>
                                    </li>
                                    <li className="nav-item">
                                        <a className="nav-link" id="requestTab2-tab" data-toggle="pill"
                                           href="#requestTab2" role="tab"
                                           aria-controls="custom-tabs-one-profile" aria-selected="false">Products</a>
                                    </li>
                                </ul>
                            </div>
                            <div className="card-body">
                                <div className="tab-content" id="custom-tabs-one-tabContent">
                                    <div className="tab-pane fade active show" id="requestTab1" role="tabpanel"
                                         aria-labelledby="requestTab1-tab">
                                        <div className="row">
                                            {this.props.data.provenance.map((provenance) => (
                                                <div className="col-lg-2 col-6" key={'provenance'+provenance.id} onClick={() => this.onSelectProvenance(provenance)}>
                                                    <div className={this.props.data.request.provenance.id==provenance.id?'small-box bg-success':'small-box bg-info'}>
                                                        <div className="inner">
                                                            {this.props.data.request.provenance.id==provenance.id?<h3><i className="fas fa-check"></i></h3>:<h3><i className="far fa-hand-spock"></i></h3>}
                                                            <p>{provenance.location}</p>
                                                        </div>
                                                        <div className="icon">
                                                            {this.props.data.request.provenance.id==provenance.id?<i className="fas fa-border-none"></i>:<i className="fas fa-table"></i>}
                                                        </div>
                                                        <a href="#" className="small-box-footer">
                                                            {this.props.data.request.provenance.id==provenance.id?'SELECTED':<span> Click to Choose <i className="fas fa-hand-pointer"></i></span>}
                                                        </a>
                                                    </div>
                                                </div>
                                            ))}
                                        </div>
                                    </div>
                                    <div className="tab-pane fade" id="requestTab2" role="tabpanel"
                                         aria-labelledby="requestTab2-tab">
                                        <div className="row">
                                            <div className="col-lg-2 col-2 p-0" id="requestTab2Categories">
                                                <div className="card card-widget widget-user-2">
                                                    {/*<div className="widget-user-header bg-warning">*/}
                                                    {/*    Categories*/}
                                                    {/*</div>*/}
                                                    <div className="card-footer p-0">
                                                        <ul className="nav flex-column">
                                                            {this.props.data.categories.map(category => (
                                                                <li className="nav-item" key={'category' + category.id}>
                                                                    <a href="#" className="nav-link"
                                                                       onClick={() => this.onSelectCategory(category.id)}>
                                                                        {category.category} <span
                                                                        className="float-right badge bg-warning">{category.totalProducts}</span>
                                                                    </a>
                                                                </li>
                                                            ))}
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="col-lg-10 col-10">
                                                <div className="row">
                                                    {this.props.data.productsShow.map((product, index) => (
                                                        <div className="col-12 col-sm-6 col-md-3 divProduct"
                                                             key={'product' + product.id}
                                                             onClick={() => this.onSelectProduct(product)}>
                                                            <div className={'info-box bg-dark'}>
                                                                <div className="info-box-content">
                                                                    <span
                                                                        className="info-box-number">{product.product}<small></small></span>
                                                                    <span className="info-box-text">{product.unit} <span
                                                                        className="badge badge-success float-right">{product.price}€</span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ))}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div className="col-lg-2 col-2 p-0" id="requestTab2Request">
                        <div className="card card-primary">
                            <div className="card-header">
                                <h3 className="card-title">Resume</h3><span
                                className="badge badge-success float-right">{this.props.data.totalPriceRequest}€</span>
                            </div>
                            <div className="card-body">
                                {requestCategories.map(category => (
                                    <div key={'divR' + category.id}>
                                        <strong><i
                                            className={'fas ' + category.image + ' mr-1'}></i> {category.category}
                                        </strong>
                                        <ul className="text-muted list-unstyled">
                                            {this.props.data.request.products.filter(product => product.idCategory == category.id).map((product, index) => (
                                                <li key={category.id + 'product' + product.id}>{product.qtd} {product.product}
                                                    <span
                                                        className="badge badge-success float-right">{product.qtd * product.price}€</span>
                                                </li>
                                            ))}
                                        </ul>
                                        <hr/>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                </div>
                <div className="row">
                    <div className="col-lg-12 col-12">
                        <button type="button" onClick={this.onSubmit}
                                className="btn btn-block bg-gradient-success">Create Request
                        </button>
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
    data: state.requestReducer
})

const mapDispatchToProps = dispatch => bindActionCreators({
    create,
    store,
    select_category,
    select_provenance,
    add_Product_Request
}, dispatch)

export default connect(mapStateToProps, mapDispatchToProps)(Create);