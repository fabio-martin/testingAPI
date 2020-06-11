import React, {Component} from 'react';
import {connect} from 'react-redux'
import {show} from "../requestActions";
import {bindActionCreators} from 'redux'
import PropTypes from 'prop-types';


class Index extends Component {

    componentWillMount() {
        //this.props.index()
    }

    onDeleteClick = id => {
        //this.props.destroy(id)
    }

    render() {
        console.log(this.props.data)
        return (
            <section className="content-header">
                <div className="card">
                    <div className="card-header">
                        <h3 className="card-title"><i className="fas fa-list fa-fw"></i>Request</h3>
                        <a className="btn btn-success btn-xs float-right" href="/product/create">
                            <i className="fa fa-plus" title="Add" aria-hidden="true"></i>
                            <span className="sr-only">Add</span>
                        </a>
                    </div>
                    <div className="card-body p-0">
                        <div className="row">

                        <div className="col-lg-2 col-2 p-0" id="requestTab2Request">
                            <div className="card card-primary">
                                <div className="card-header">
                                    <h3 className="card-title">Resume</h3><span
                                    className="badge badge-success float-right">{this.props.data.totalPriceRequest}€</span>
                                </div>
                                <div className="card-body">

                                </div>
                            </div>
                        </div>
                        </div>


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
    data: state.productReducer,
})

const mapDispatchToProps = dispatch => bindActionCreators({show}, dispatch)

export default connect(mapStateToProps, mapDispatchToProps)(Index);