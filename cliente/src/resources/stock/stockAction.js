import axios from "axios";
import GET_ERRORS from '../../utils/reducers/errorReducer';
import TYPES from '../stock/stock.types'
import Swal from "sweetalert2";

export const getWarehouseProductsStock = (warehouseId) => async dispatch  => {

    try{
        const result = await axios.get(`/warehouse/${warehouseId}/product`,{
            headers: {
                Authorization: `Bearer ${localStorage.getItem('usertoken')}`
            }
        })
        if(!result.data.success){
            dispatch({
                type: GET_ERRORS,
                payload: result.data.data
            })
        }
        else{
            dispatch({
                type:TYPES.GET_ALL_WAREHOUSE_PRODUCTS_STOCK,
                payload:result.data.data
            })

        }
        
    }
    catch(err){
        dispatch({
            type:GET_ERRORS,
            payload:err
        })

    }
}

export const updateProductStock = (warehouseId, productId, amount) => async dispatch => {
    const body = {
        stock: amount
    }

    try{
        const result = await axios.put(`warehouse/${warehouseId}/product/${productId}`, body, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('usertoken')}`
            }
        })
        
        if(!result.data.success){
            dispatch({
                type: GET_ERRORS,
                payload: result.data.data
            })
            Swal.fire({
                position: 'top-end',
                toast: true,
                icon: 'warning',
                title: 'Warning!',
                // html: text,
                html:'<p>Error to update</p>',
                showConfirmButton: false,
                timer: 2000
            })
        }
        else{
            dispatch({
                type: TYPES.UPDATE_PRODUCT_STOCK,
                payload: result.data.data
            })
            Swal.fire({
                position: 'top-end',
                toast: true,
                icon: 'success',
                title: 'Success!',
                text: 'Successfully updated!',
                // footer: '<a href>Why</a>',
                showConfirmButton: false,
                timer: 2000
            })   
        }
        
    }
    catch(err){
        dispatch({
            type:GET_ERRORS,
            payload:err
        })
        Swal.fire({
            position: 'top-end',
            toast: true,
            icon: 'warning',
            title: 'Warning!',
            // html: text,
            html:'<p>Error to update</p>',
            showConfirmButton: false,
            timer: 2000
        })
    }
}

export const updateProductPrice = (productId, price) => async dispatch => {
    const body = {
        price: price
    }
    try{
        const result = await axios.put(`/product/${productId}/price`, body, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('usertoken')}`
                }
            })

        if(!result.data.success){
            dispatch({
                type: GET_ERRORS,
                payload: result.data.data
            })
            Swal.fire({
                position: 'top-end',
                toast: true,
                icon: 'warning',
                title: 'Warning!',
                // html: text,
                html:'<p>Error to update</p>',
                showConfirmButton: false,
                timer: 2000
            })
        }
        else{
            dispatch({
                type: TYPES.UPDATE_PRODUCT_PRICE,
                payload: result.data.data
            })
            Swal.fire({
                position: 'top-end',
                toast: true,
                icon: 'success',
                title: 'Success!',
                text: 'Successfully updated!',
                // footer: '<a href>Why</a>',
                showConfirmButton: false,
                timer: 2000
            })   
        }
        
    }
    catch(err){
        dispatch({
            type:GET_ERRORS,
            payload:err
        })
        Swal.fire({
            position: 'top-end',
            toast: true,
            icon: 'warning',
            title: 'Warning!',
            // html: text,
            html:'<p>Error to update</p>',
            showConfirmButton: false,
            timer: 2000
        })
    }
}

export const removeProductFromWarehouse = (warehouseId, productId) => async dispatch => {
    try{
        const result = await axios.delete(`/warehouse/${warehouseId}/product/${productId}`,
            {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('usertoken')}`
                }
            }
        )

        if(!result.data.success){
            Swal.fire({
                position: 'top-end',
                toast: true,
                icon: 'warning',
                title: 'Warning!',
                // html: text,
                html:`<p>${result.data.data}</p>`,
                showConfirmButton: false,
                timer: 2000
            })
        }
        else{
            dispatch({
                type: TYPES.REMOVE_PRODUCT_FROM_WAREHOUSE,
                payload: result.data.data
            })
            Swal.fire({
                position: 'top-end',
                toast: true,
                icon: 'success',
                title: 'Success!',
                text: 'Successfully removed!',
                // footer: '<a href>Why</a>',
                showConfirmButton: false,
                timer: 2000
            })   
        }
    }
    catch(err){
        dispatch({
            type:GET_ERRORS,
            payload:err
        })
        Swal.fire({
            position: 'top-end',
            toast: true,
            icon: 'warning',
            title: 'Warning!',
            // html: text,
            html:'<p>Error to remove</p>',
            showConfirmButton: false,
            timer: 2000
        })
    }
}