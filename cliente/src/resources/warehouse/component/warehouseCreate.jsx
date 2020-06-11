import React, {Component} from 'react'
import FormInput from '../../../utils/components/form-input.component';
import PropTypes from 'prop-types';
import {connect} from 'react-redux';
import { bindActionCreators } from 'redux'
import {createWarehouse, addChange} from '../warehouseActions'

class WarehouseCreate extends Component {

    handleSubmit = event => {
        event.preventDefault();
        this.props.createWarehouse(this.props.history)
    }

    render() { 
        const {addChange, errors} = this.props;
        return (
            <section className="content-header">
                <div className="row">
                    <div className="col-md-12">
                        <div className="card card-warning"> 
                            <div className="card-header with-border">
                                <h3 className="card-title">Create</h3>
                            </div>
                            <form onSubmit={this.handleSubmit}>
                                <div className="card-body">
                                    <div className="row">
                                        <div className="col-md-6">
                                            <FormInput 
                                                handleChange={(event) => addChange('name', event.target.value)}
                                                label="Name:"
                                                name="name"
                                                errors = {errors}
                                                placeholder=""
                                            >
                                            </FormInput>
                                        </div>
                                        <div className="col-md-6">
                                            <FormInput 
                                                handleChange={(event) => addChange('location', event.target.value)}
                                                label="Location:"
                                                name="location"
                                                errors = {errors} 
                                                placeholder="" 
                                            >
                                            </FormInput>
                                        </div>
                                    </div>

                                </div>
                                <div className="card-footer">
                                    <div className="row">
                                        <div className="col-md-12">
                                            <button type="submit"
                                                    className="btn btn-block btn-success pull-right"
                                            >
                                            Save
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

WarehouseCreate.propTypes = {
    createWarehouse: PropTypes.func.isRequired,
    addChange: PropTypes.func.isRequired,
    currentWarehouse: PropTypes.object.isRequired,
    errors: PropTypes.object.isRequired
}

const mapDispatchToProps = dispach => bindActionCreators({createWarehouse, addChange}, dispach);

const mapStateToPops = state => ({
    currentWarehouse: state.warehouseEditReducer.currentWarehouse,
    errors: state.errorsReducer
})

export default connect(mapStateToPops,mapDispatchToProps)(WarehouseCreate);