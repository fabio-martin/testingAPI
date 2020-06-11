import TYPES from '../warehouse/warehouse.types';
import {GET_ERRORS} from "../../utils/actions/actionsTypes";
import axios from "axios";
import Swal from "sweetalert2";

function errorServerNotAvailable(err, dispatch){
    // var text='';
        // Object.keys(err.response.data).forEach(key => text += err.response.data[key]+'<br>')
        Swal.fire({
            position: 'top-end',
            toast: true,
            icon: 'warning',
            title: 'Warning!',
            // html: text,
            html:'<p>The server is not available</p>',
            showConfirmButton: false,
            timer: 2000
        })
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data
        })
}

export const getWarehouseById = (id) => async dispatch => {
    try {
        const result = await axios.get(`/warehouse/${id}`, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('usertoken')}`
            }
        })
        console.log(result.data)
        dispatch({
            type: TYPES.GET_WAREHOUSE_BY_ID,
            payload: result.data
        })
    } catch (err) {
        errorServerNotAvailable(err, dispatch)
    }
}

export const addChange = (name, value) =>  dispatch => {
    const field = {
        name: name,
        value: value,
    }
    dispatch({
        type: TYPES.ADD_CHANGE,
        payload: field
    })
}

export const createWarehouse = (history) => async dispatch => {
    try{  
        dispatch({
            type: TYPES.EDIT_WAREHOUSE,
            payload: {
                createWarehouse: async (warehouse) => {
                    const body = {
                        name: warehouse.name,
                        location: warehouse.location
                    }
                    const result = await axios.post(`/warehouse`, body, {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem('usertoken')}`
                        }
                    })
                    
                    console.log('Result-----')
                    console.log(result)
                    if(!result.data.success){
                        console.log('Result-Error-----')
                        console.log(result)
                        var text='';
                        Object.keys(result.data.data).forEach(key => text += result.data.data[key]+'<br>')
                        Swal.fire({
                            position: 'top-end',
                            toast: true,
                            icon: 'warning',
                            title: 'Warning!',
                            html: text,
                            // html: '<br>The warehouse with this name and location already exists</br>',
                            // footer: '<a href>Why</a>',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        return result.data
                    }
                
                    Swal.fire({
                        position: 'top-end',
                        toast: true,
                        icon: 'success',
                        title: 'Success!',
                        text: 'Successfully created!',
                        // footer: '<a href>Why</a>',
                        showConfirmButton: false,
                        timer: 2000
                    })   
                     
                    history.push("/warehouse")
                    return result.data   
                }
            },
        })
    }
    catch (err) {
        errorServerNotAvailable(err, dispatch)
    }
}

export const index = () => async dispatch  => {
    try {
        const result = await axios.get(`/warehouse`, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('usertoken')}`
            }
        })
        console.log(result.data)
        dispatch({
            type: TYPES.GET_ALL_WAREHOUSES,
            payload: result.data
        })
    } catch (err) {
        errorServerNotAvailable(err, dispatch)
    }
}

export const updateWarehouse = (history) => async dispatch => {
    try{
        dispatch({
            type: TYPES.EDIT_WAREHOUSE,
            payload: {
                createWarehouse: async (warehouse) => {
                    const body = {
                        id: warehouse.id,
                        name: warehouse.name,
                        location: warehouse.location
                    }
                    const result = await axios.put(`/warehouse/${warehouse.id}`, body, {
                        headers: {
                            Authorization: `Bearer ${localStorage.getItem('usertoken')}`
                        }
                    })
                    console.log('Result-----')
                    console.log(result)
                    if(!result.data.success){
                        console.log('Result-Error-----')
                        console.log(result)
                        var text='';
                        Object.keys(result.data.data).forEach(key => text += result.data.data[key]+'<br>')
                        
                        Swal.fire({
                            position: 'top-end',
                            toast: true,
                            icon: 'warning',
                            title: 'Warning!',
                            html: text,
                            showConfirmButton: false,
                            timer: 2000
                        })
                        return result.data
                    }
                
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
                     
                    history.push("/warehouse")
                    return result.data   
                }
            },
        })
                
    }catch (err) {
        errorServerNotAvailable(err, dispatch);
    }
}

export const destroy = id => async dispatch => {
    try {
        Swal.fire({
            title: 'Are you sure?',
            text: "You will delete this resource!",
            icon: 'warning',
            reverseButtons: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then(async (result) => {
            if (result.value) {
                const result = await axios.delete(`/warehouse/${id}?token=${localStorage.getItem('usertoken')}`, id)
                console.log(result)
                dispatch({
                    type: TYPES.DELETE_WAREHOUSE,
                    payload: id
                })
                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    icon: 'success',
                    title: 'Success!',
                    text: 'Successfully deleted!',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        
        })
    
    }catch (err) {
        errorServerNotAvailable(err, dispatch)
    }
}