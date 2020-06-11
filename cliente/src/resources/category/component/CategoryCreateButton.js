import React from 'react';
import {Link} from 'react-router-dom'

const CategoryCreateButton = () => {
    return (
        <React.Fragment>
            <Link className="btn btn-success btn-xs pull-right" to="/categoria/create">
                <i className="fa fa-plus" title="Adicionar" aria-hidden="true"></i>
                <span className="sr-only">Adicionar</span>
            </Link>
        </React.Fragment>
    );
}

export default CategoryCreateButton;