import React,{Component} from 'react'
import FormInput from '../../../utils/components/form-input.component';
import PropTypes from 'prop-types';
import {connect} from 'react-redux';
import {updateWarehouse, addChange, getWarehouseById} from '../warehouseActions'
import {bindActionCreators} from 'redux'


class WarehouseEdit extends Component {

    componentDidMount(){
        const {id} = this.props.match.params
        this.props.getWarehouseById(id)
    }

    handleSubmit = event => {
        event.preventDefault();
        this.props.updateWarehouse(this.props.history)
    }

    render() {
        const {addChange, currentWarehouse, errors} = this.props
        return (
            <section className="content-header">
                <div className="row">
                    <div className="col-md-12">
                        <div className="card card-warning">
                            <div className="card-header with-border">
                                <h3 className="card-title">Edit</h3>
                            </div>
                            <form onSubmit={this.handleSubmit}>
                                <div className="card-body">
                                    <div className="row">
                                        <div className="col-md-6">
                                            <FormInput 
                                                handleChange={(event)=> addChange('name', event.target.value)}
                                                label="Name :"
                                                name="name" 
                                                // placeholder={currentWarehouse.name || ""}
                                                errors={errors}
                                                value={currentWarehouse.name || ""}
                                            >
                                            </FormInput>
                                        </div>
                                        <div className="col-md-6">
                                            <FormInput 
                                                handleChange={(event)=>addChange('location', event.target.value)}
                                                label="Location :"
                                                name="location" 
                                                // placeholder={currentWarehouse.location || ""}
                                                errors={errors}
                                                value={currentWarehouse.location || ""}
                                            >
                                </FormInput>
                                        </div>
                                        <div className="col-md-4"></div>
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

WarehouseEdit.propTypes = {
    updateWarehouse: PropTypes.func.isRequired,
    addChange: PropTypes.func.isRequired,
    currentWarehouse: PropTypes.object.isRequired,
    getWarehouseById: PropTypes.func.isRequired
}

const mapStateToProps = state => ({
    currentWarehouse: state.warehouseEditReducer.currentWarehouse,
    errors: state.errorsReducer
})

const mapDispatchToProps = dispach => bindActionCreators({
    updateWarehouse, 
    addChange,
    getWarehouseById,
}, dispach)

export default connect(mapStateToProps, mapDispatchToProps)(WarehouseEdit);