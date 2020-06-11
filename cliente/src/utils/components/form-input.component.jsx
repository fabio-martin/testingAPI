import React from 'react';
import classnames from 'classnames'

const FormInput = ({ handleChange, label, errors, ...otherProps}) =>{
    console.log('ERROR-----')
    console.log(errors)
    return (
    <div className="form-group">
        {
            label ? (
                <label> {label} </label>
            ) : null
        }
        <input
            className={classnames("form-control", {
                "is-invalid": errors.error
            })}
            type="text"
            onChange={handleChange}
            {...otherProps}
            />
            {errors.error && (
                <div className="invalid-feedback">Error</div>
            )}
    </div>                                                
)}

export default FormInput;