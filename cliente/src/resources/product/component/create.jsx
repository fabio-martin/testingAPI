import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {connect} from 'react-redux';
import {create, store} from "../productActions";
import classnames from 'classnames'
import Select from 'react-select';
import {bindActionCreators} from "redux";
import {getSummary} from "../../dashboard/dashboardActions";
import Swal from "sweetalert2";
// var Select = require('react-select');


class Create extends Component {

    constructor() {
        super()

        this.state = {
            product: "",
            idCategory: "",
            price: "",
            unit: "",
            // "updated_at": "2020-04-09 17:51:23",
            created_at: "",
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
        const product = {
            product: this.state.product,
            idCategory: this.state.idCategory,
            price: this.state.price,
            unit: this.state.unit,
        }

        this.props.store(product, this.props.history)



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
                                                       onChange={this.onChange.bind(this)}/>
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
                                                        defaultValue=''
                                                onChange={this.onChange.bind(this)}>
                                                    <option value='' disabled hidden>Please Choose...</option>
                                                    {this.props.dataFromReducer.categories.map(category => (
                                                        <option key={category.id} value={category.id}>{category.category}</option>
                                                    ))}
                                                </select>
                                                {errors.idCategory && (
                                                    <div className="invalid-feedback">{errors.idCategory}</div>
                                                )}
                                                {/*<Select*/}
                                                {/*    name="form-field-name"*/}
                                                {/*    value="one"*/}
                                                {/*    options={this.props.dataFromReducer.categories}*/}
                                                {/*    onChange={logChange}*/}
                                                {/*/>*/}


                                                {/*<select className="select2 select2-hidden-accessible" multiple=""*/}
                                                {/*        data-placeholder="Select a State" style="width: 100%;"*/}
                                                {/*        data-select2-id="7" tabIndex="-1" aria-hidden="true">*/}
                                                {/*    <option>Alabama</option>*/}
                                                {/*    <option>Alaska</option>*/}
                                                {/*    <option>California</option>*/}
                                                {/*    <option>Delaware</option>*/}
                                                {/*    <option>Tennessee</option>*/}
                                                {/*    <option>Texas</option>*/}
                                                {/*    <option>Washington</option>*/}
                                                {/*</select><span*/}
                                                {/*className="select2 select2-container select2-container--default"*/}
                                                {/*dir="ltr" data-select2-id="8" style="width: 100%;"><span*/}
                                                {/*className="selection"><span*/}
                                                {/*className="select2-selection select2-selection--multiple"*/}
                                                {/*role="combobox" aria-haspopup="true" aria-expanded="false" tabIndex="-1"*/}
                                                {/*aria-disabled="false"><ul className="select2-selection__rendered"><li*/}
                                                {/*className="select2-search select2-search--inline"><input*/}
                                                {/*className="select2-search__field" type="search" tabIndex="0"*/}
                                                {/*autoComplete="off" autoCorrect="off" autoCapitalize="none"*/}
                                                {/*spellCheck="false" role="searchbox" aria-autocomplete="list"*/}
                                                {/*placeholder="Select a State"*/}
                                                {/*style="width: 538px;"></li></ul></span></span><span*/}
                                                {/*className="dropdown-wrapper" aria-hidden="true"></span></span>*/}
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
                                                       onChange={this.onChange.bind(this)}/>
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
                                                       onChange={this.onChange.bind(this)}/>
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

Create.propTypes = {
    create: PropTypes.func.isRequired,
    errorsFromReducer: PropTypes.object.isRequired
}

const mapStateToProps = state => ({
    errorsFromReducer: state.errorsReducer,
    dataFromReducer: state.productReducer
})

// const mapDispatchToProps = dispatch => bindActionCreators({create, store}, dispatch)

export default connect(mapStateToProps, {create, store})(Create);