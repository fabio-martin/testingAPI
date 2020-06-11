import React, {Component} from 'react';
import {getCategory, updateCategory} from "../categoryActions";
import PropTypes from 'prop-types';
import {connect} from 'react-redux';
import classnames from 'classnames';


class CategoryEdit extends Component {

    componentDidMount() {
        const {id} = this.props.match.params
        this.props.getCategory(id, this.props.history)
    }

    constructor() {
        super()

        this.state = {
            id: "",
            category: "",
            image: "",
            // "updated_at": "2020-04-09 17:51:23",
            created_at: "",
            errors: {}
        }

        this.onChange = this.onChange.bind(this)
        this.onSubmit = this.onSubmit.bind(this)
    }

    componentWillReceiveProps(nextProps, nextContext) {
        //nao perder o conteudo do form
        if (nextProps.errorsFromReducer) {
            this.setState({errors: nextProps.errorsFromReducer})
        }
        const {id, category, created_at} = nextProps.categoryFromReducer
        this.setState({id, category, created_at})
    }

    onChange(e) {
        this.setState({[e.target.name]: e.target.value})
    }

    onSubmit(e) {
        e.preventDefault()
        const updateCategory = {
            id: this.state.id,
            category: this.state.category,
            image: this.state.image,
        }

        this.props.updateCategory(updateCategory, this.props.history)
    }

    render() {
        const {errors} = this.state

        console.log(errors)

        return (
            <section className="content-header">
                <div className="row">
                    <div className="col-md-12">
                        <div className="card card-warning">
                            <div className="card-header with-border">
                                <h3 className="card-title">Edit</h3>
                            </div>
                            <form onSubmit={this.onSubmit}>
                                <div className="card-body">
                                    <div className="row">
                                        <div className="col-md-4">
                                            <div className="form-group">
                                                <label>Name</label>
                                                <input type="text" name="category"
                                                       className={classnames("form-control", {
                                                           "is-invalid": errors.category
                                                       })}
                                                       placeholder="" value={this.state.category}
                                                       onChange={this.onChange}/>
                                                {errors.category && (
                                                    <div className="invalid-feedback">{errors.category}</div>
                                                )}
                                            </div>
                                        </div>
                                        <div className="col-md-4">
                                            <div className="form-group">
                                                <label>Image</label>
                                                <input type="text" name="image"
                                                       className={classnames("form-control", {
                                                           "is-invalid": errors.image
                                                       })}
                                                       placeholder="" value={this.state.image}
                                                       onChange={this.onChange}/>
                                                {errors.category && (
                                                    <div className="invalid-feedback">{errors.image}</div>
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

CategoryEdit.propTypes = {
    getCategory: PropTypes.func.isRequired,
    updateCategory: PropTypes.func.isRequired,
    categoryFromReducer: PropTypes.object.isRequired,
    errorsFromReducer: PropTypes.object.isRequired
}

const mapStateToProps = state => ({
    categoryFromReducer: state.categoryReducer.category,
    errorsFromReducer: state.errorsReducer
})

export default connect(mapStateToProps, {getCategory, updateCategory})(CategoryEdit);