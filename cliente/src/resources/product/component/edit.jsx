import React, {Component} from 'react';
import {edit, update} from "../productActions";
import PropTypes from 'prop-types';
import {connect} from 'react-redux';
import classnames from 'classnames';


class ProductEdit extends Component {

    componentDidMount() {
        const {id} = this.props.match.params
        // this.props.getProduct(id, this.props.history)
        this.props.edit(id, this.props.history)
        // console.log(this.props)
    }

    constructor() {
        super()

        this.state = {
            id: '',
            product: '',
            idCategory: '',
            price: '',
            unit: '',
            // "updated_at": "2020-04-09 17:51:23",
            created_at: '',
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
        const {id, product, idCategory, price, unit} = nextProps.dataFromReducer.product
        this.setState({id, product, idCategory, price, unit})
    }

    onChange(e) {
        this.setState({[e.target.name]: e.target.value})
    }

    onSubmit(e) {
        e.preventDefault()
        const product = {
            id: this.state.id,
            product: this.state.product,
            idCategory: this.state.idCategory,
            price: this.state.price,
            unit: this.state.unit,
        }
        this.props.update(product, this.props.history)
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
                                                <label>Name</label>
                                                <input type="text" name="product"
                                                       className={classnames("form-control", {
                                                           "is-invalid": errors.product
                                                       })}
                                                       placeholder="" value={this.state.product}
                                                       onChange={this.onChange}/>
                                                {errors.product && (
                                                    <div className="invalid-feedback">{errors.product}</div>
                                                )}
                                            </div>
                                        </div>
                                        <div className="col-md-4">
                                            <div className="form-group">
                                                <label>Category</label>
                                                <select className={classnames("form-control select2", {
                                                    "is-invalid": errors.idCategory
                                                })} name="idCategory"
                                                        value={this.state.idCategory}
                                                        onChange={this.onChange.bind(this)}  >
                                                    {this.props.dataFromReducer.categories.map(category => (
                                                        <option key={category.id} value={category.id}
                                                                // selected={category.id==this.state.idCategory}
                                                        >{category.category}</option>
                                                    ))}
                                                </select>
                                                {errors.idCategory && (
                                                    <div className="invalid-feedback">{errors.idCategory}</div>
                                                )}
                                            </div>
                                        </div>
                                        <div className="col-md-4">
                                            <div className="form-group">
                                                <label>Price</label>
                                                <input type="text" name="price"
                                                       className={classnames("form-control", {
                                                           "is-invalid": errors.price
                                                       })}
                                                       placeholder="" value={this.state.price}
                                                       onChange={this.onChange}/>
                                                {errors.price && (
                                                    <div className="invalid-feedback">{errors.price}</div>
                                                )}
                                            </div>
                                        </div>
                                        <div className="col-md-4">
                                            <div className="form-group">
                                                <label>Unit</label>
                                                <input type="text" name="unit"
                                                       className={classnames("form-control", {
                                                           "is-invalid": errors.unit
                                                       })}
                                                       placeholder="" value={this.state.unit}
                                                       onChange={this.onChange}/>
                                                {errors.unit && (
                                                    <div className="invalid-feedback">{errors.unit}</div>
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

ProductEdit.propTypes = {
    // getCategory: PropTypes.func.isRequired,
    // updateCategory: PropTypes.func.isRequired,
    // categoryFromReducer: PropTypes.object.isRequired,
    errorsFromReducer: PropTypes.object.isRequired
}

const mapStateToProps = state => ({
    dataFromReducer: state.productReducer,
    errorsFromReducer: state.errorsReducer,
})

export default connect(mapStateToProps, {edit, update})(ProductEdit);