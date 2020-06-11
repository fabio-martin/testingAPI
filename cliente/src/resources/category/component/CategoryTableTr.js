import React, {Component} from 'react';
import {Link} from "react-router-dom";
import PropTypes from 'prop-types'
import {connect} from 'react-redux'
import {deleteCategory} from "../categoryActions";

class CategoryTableTr extends Component {

    onDeleteClick = id => {
        this.props.deleteCategory(id)
    }

    render() {
        const {categoria} = this.props
        return (
            <tr>
                <td>{categoria.id}</td>
                <td>{categoria.category}</td>
                <td><i className={'fa '+categoria.image} title="Edit" aria-hidden="true"></i></td>
                <td>{categoria.created_at}</td>
                <td>{categoria.updated_at}</td>
                <td>
                    <Link className="btn btn-warning btn-xs" to={`/category/${categoria.id}/edit`}
                          style={{marginRight: 2}}>
                        <i className="fa fa-pencil-alt" title="Edit" aria-hidden="true"></i>
                        <span className="sr-only">Edit</span>
                    </Link>

                    <Link className="btn btn-danger btn-xs" to="#"
                          onClick={this.onDeleteClick.bind(this, categoria.id)}>
                        <i className="fa fa-trash-alt" title="Delete" aria-hidden="true"></i>
                        <span className="sr-only">Delete</span>
                    </Link>
                </td>
            </tr>
        );
    }
}

CategoryTableTr.prototypes = {
    deleteCategory: PropTypes.func.isRequired
};


export default connect(null, {deleteCategory})(CategoryTableTr);