import React, {Component} from 'react';
import CategoriaTableTr from "./CategoryTableTr";
import {connect} from 'react-redux'
import {getCategories} from "../categoryActions";
import PropTypes from 'prop-types';
import {bindActionCreators} from 'redux'


class Index extends Component {

    componentDidMount() {
        this.props.getCategories()
        // console.log(this.props)
    }

    render() {

        // this.items = this.props.category.categories.map((item, key) =>
        //     <li key={item.id}>{item.category}</li>
        // );

        return (
            <section className="content-header">

                <div className="card">
                    <div className="card-header">
                        <h3 className="card-title"><i className="fas fa-list fa-fw"></i>Categories</h3>
                        {/*<Route exact path="/categoria/reate" component={CategoriaCreate}/>*/}
                        {/*<CategoryCreateButton/>*/}
                        <a className="btn btn-success btn-xs float-right" href="/category/create">
                            <i className="fa fa-plus" title="Add" aria-hidden="true"></i>
                            <span className="sr-only">Add</span>
                        </a>
                    </div>
                    <div className="card-body p-0">
                        <table className="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
                                <th>Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            {
                                this.props.dataFromReducer.categories.map(category => (
                                    <CategoriaTableTr key={category.id} categoria={category}/>
                                ))
                            }
                            </tbody>
                        </table>
                    </div>
                    <div className="card-footer">
                        {/*<ul>*/}
                        {/*    {this.items}*/}
                        {/*</ul>*/}
                    </div>
                </div>
            </section>
        );
    }
}

Index.propTypes = {
    dataFromReducer: PropTypes.object.isRequired,
    getCategories: PropTypes.func.isRequired
}

const mapStateToProps = state => ({
    dataFromReducer: state.categoryReducer,
})

const mapDispatchToProps = dispatch =>
    bindActionCreators({getCategories}, dispatch)


export default connect(mapStateToProps, mapDispatchToProps)(Index);