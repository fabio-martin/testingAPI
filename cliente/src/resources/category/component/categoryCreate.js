import React, {Component} from 'react';
import PropTypes from 'prop-types';
import {connect} from 'react-redux';
import {createCategory} from "../categoryActions";
import classnames from 'classnames'

class CategoryCreate extends Component {
    constructor() {
        super()

        this.state = {
            category: "Cat ",
            image: "",
            // "updated_at": "2020-04-09 17:51:23",
            created_at: "2020-04-09 17:51:23",
            errors: {}
        }

        this.onChange = this.onChange.bind(this)
        this.onSubmit = this.onSubmit.bind(this)
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
    }

    onSubmit(e) {
        e.preventDefault()
        const newCategoria = {
            category: this.state.category,
            image: this.state.image
        }
        this.props.createCategory(newCategoria, this.props.history)

        // try {
        //     const response = await axios.post('http://demo0725191.mockable.io/post_data', { posted_data: 'example' });
        //     console.log('👉 Returned data:', response);
        // } catch (e) {
        //     console.log(`😱 Axios request failed: ${e}`);
        // }
        //
        // fetch(`http://127.0.0.1:8000/api/categoria`, {
        //     // mode: 'no-cors',
        //     method: 'POST',
        //     headers: {
        //         "Content-Type": "application/json",
        //         'Access-Control-Allow-Origin':'*'
        //     },
        //     body: JSON.stringify(this.state)
        // })
        //     .then(res => res.json())
        //     .then(json => this.setState({ data: json }));

    }

    render() {
        const {errors} = this.state

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
                                                <input type="text" name="category"
                                                       className={classnames("form-control", {
                                                           "is-invalid": errors.category
                                                       })}
                                                       placeholder="" value={this.state.category}
                                                       onChange={this.onChange.bind(this)}/>
                                                {errors.category && (
                                                    <div className="invalid-feedback">{errors.category}</div>
                                                )}
                                            </div>
                                        </div>
                                        <div className="col-md-4">
                                            <div className="form-group">
                                                <label>Image:</label>
                                                <input type="text" name="image"
                                                       className="form-control pull-right" id="image"
                                                       value={this.state.image}
                                                       onChange={this.onChange.bind(this)}/>
                                            </div>
                                        </div>
                                        <div className="col-md-4"></div>
                                    </div>


                                    {/*<div className="form-group">*/}
                                    {/*    <label>Text Disabled</label>*/}
                                    {/*    <input type="text" className="form-control" placeholder="Enter ..."*/}
                                    {/*           disabled=""/>*/}
                                    {/*</div>*/}

                                    {/*<div className="form-group">*/}
                                    {/*    <label>Textarea</label>*/}
                                    {/*    <textarea className="form-control" rows="3"*/}
                                    {/*              placeholder="Enter ..."></textarea>*/}
                                    {/*</div>*/}
                                    {/*<div className="form-group">*/}
                                    {/*    <label>Textarea Disabled</label>*/}
                                    {/*    <textarea className="form-control" rows="3" placeholder="Enter ..."*/}
                                    {/*              disabled=""></textarea>*/}
                                    {/*</div>*/}

                                    {/*<div className="form-group has-success">*/}
                                    {/*    <label className="control-label" htmlFor="inputSuccess"><i*/}
                                    {/*        className="fa fa-check"></i> Input with success</label>*/}
                                    {/*    <input type="text" className="form-control" id="inputSuccess"*/}
                                    {/*           placeholder="Enter ..."/>*/}
                                    {/*    <span className="help-block">Help block with success</span>*/}
                                    {/*</div>*/}
                                    {/*<div className="form-group has-warning">*/}
                                    {/*    <label className="control-label" htmlFor="inputWarning"><i*/}
                                    {/*        className="fa fa-bell-o"></i> Input with*/}
                                    {/*        warning</label>*/}
                                    {/*    <input type="text" className="form-control" id="inputWarning"*/}
                                    {/*           placeholder="Enter ..."/>*/}
                                    {/*    <span className="help-block">Help block with warning</span>*/}
                                    {/*</div>*/}
                                    {/*<div className="form-group has-error">*/}
                                    {/*    <label className="control-label" htmlFor="inputError"><i*/}
                                    {/*        className="fa fa-times-circle-o"></i> Input with*/}
                                    {/*        error</label>*/}
                                    {/*    <input type="text" className="form-control" id="inputError"*/}
                                    {/*           placeholder="Enter ..."/>*/}
                                    {/*    <span className="help-block">Help block with error</span>*/}
                                    {/*</div>*/}

                                    {/*<div className="form-group">*/}
                                    {/*    <div className="checkbox">*/}
                                    {/*        <label>*/}
                                    {/*            <input type="checkbox"/>*/}
                                    {/*            Checkbox 1*/}
                                    {/*        </label>*/}
                                    {/*    </div>*/}

                                    {/*    <div className="checkbox">*/}
                                    {/*        <label>*/}
                                    {/*            <input type="checkbox"/>*/}
                                    {/*            Checkbox 2*/}
                                    {/*        </label>*/}
                                    {/*    </div>*/}

                                    {/*    <div className="checkbox">*/}
                                    {/*        <label>*/}
                                    {/*            <input type="checkbox" disabled=""/>*/}
                                    {/*            Checkbox disabled*/}
                                    {/*        </label>*/}
                                    {/*    </div>*/}
                                    {/*</div>*/}

                                    {/*<div className="form-group">*/}
                                    {/*    <div className="radio">*/}
                                    {/*        <label>*/}
                                    {/*            <input type="radio" name="optionsRadios" id="optionsRadios1"*/}
                                    {/*                   value="option1" checked=""/>*/}
                                    {/*            Option one is this and that—be sure to include why it's*/}
                                    {/*            great*/}
                                    {/*        </label>*/}
                                    {/*    </div>*/}
                                    {/*    <div className="radio">*/}
                                    {/*        <label>*/}
                                    {/*            <input type="radio" name="optionsRadios" id="optionsRadios2"*/}
                                    {/*                   value="option2"/>*/}
                                    {/*            Option two can be something else and selecting it will*/}
                                    {/*            deselect option one*/}
                                    {/*        </label>*/}
                                    {/*    </div>*/}
                                    {/*    <div className="radio">*/}
                                    {/*        <label>*/}
                                    {/*            <input type="radio" name="optionsRadios" id="optionsRadios3"*/}
                                    {/*                   value="option3" disabled=""/>*/}
                                    {/*            Option three is disabled*/}
                                    {/*        </label>*/}
                                    {/*    </div>*/}
                                    {/*</div>*/}

                                    {/*<div className="form-group">*/}
                                    {/*    <label>Select</label>*/}
                                    {/*    <select className="form-control">*/}
                                    {/*        <option>option 1</option>*/}
                                    {/*        <option>option 2</option>*/}
                                    {/*        <option>option 3</option>*/}
                                    {/*        <option>option 4</option>*/}
                                    {/*        <option>option 5</option>*/}
                                    {/*    </select>*/}
                                    {/*</div>*/}
                                    {/*<div className="form-group">*/}
                                    {/*    <label>Select Disabled</label>*/}
                                    {/*    <select className="form-control" disabled="">*/}
                                    {/*        <option>option 1</option>*/}
                                    {/*        <option>option 2</option>*/}
                                    {/*        <option>option 3</option>*/}
                                    {/*        <option>option 4</option>*/}
                                    {/*        <option>option 5</option>*/}
                                    {/*    </select>*/}
                                    {/*</div>*/}

                                    {/*<div className="form-group">*/}
                                    {/*    <label>Select Multiple</label>*/}
                                    {/*    <select multiple="" className="form-control">*/}
                                    {/*        <option>option 1</option>*/}
                                    {/*        <option>option 2</option>*/}
                                    {/*        <option>option 3</option>*/}
                                    {/*        <option>option 4</option>*/}
                                    {/*        <option>option 5</option>*/}
                                    {/*    </select>*/}
                                    {/*</div>*/}
                                    {/*<div className="form-group">*/}
                                    {/*    <label>Select Multiple Disabled</label>*/}
                                    {/*    <select multiple="" className="form-control" disabled="">*/}
                                    {/*        <option>option 1</option>*/}
                                    {/*        <option>option 2</option>*/}
                                    {/*        <option>option 3</option>*/}
                                    {/*        <option>option 4</option>*/}
                                    {/*        <option>option 5</option>*/}
                                    {/*    </select>*/}
                                    {/*</div>*/}


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

CategoryCreate.propTypes = {
    createCategory: PropTypes.func.isRequired,
    errorsFromReducer: PropTypes.object.isRequired
}

const mapStateToProps = state => ({
    errorsFromReducer: state.errorsReducer
})

export default connect(mapStateToProps, {createCategory})(CategoryCreate);