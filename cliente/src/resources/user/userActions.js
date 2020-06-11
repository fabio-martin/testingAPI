import axios from "axios";
import Swal from "sweetalert2";
import {GET_ERRORS} from "../../utils/actions/actionsTypes";

export const index = () => async dispatch  => {
    try {
        const result = await axios.get(`/user`, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('usertoken')}`
            }
        })
        dispatch({
            type: 'User_INDEX',
            payload: result.data
        })
    } catch (err) {
        dispatch({
            type: 'GET_ERRORS',
            payload: err.response
        })
    }
}

export const create = () => async dispatch => {
    try {
        const result = await axios.get(`/user/create`, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('usertoken')}`
            }
        })
        // console.log(result.data)
        dispatch({
            type: 'User_CREATE',
            payload: result.data
        })

    } catch (err) {


        dispatch({
            type: 'GET_ERRORS',
            payload: err.response.data
        })
    }
}

export const store = (user, history) => async dispatch => {
    try {
        const res = await axios.post(`/user`, user, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('usertoken')}`
            }
        })
        console.log(res)
        history.push("/user")
        dispatch({
            type: GET_ERRORS,
            payload: {}
        })

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

    } catch (err) {
        var text='';
        Object.keys(err.response.data).forEach(key => text += err.response.data[key]+'<br>')
        Swal.fire({
            position: 'top-end',
            toast: true,
            icon: 'warning',
            title: 'Warning!',
            html: text,
            // footer: '<a href>Why</a>',
            showConfirmButton: false,
            timer: 2000
        })
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data
        })
    }
}

export const edit = (id, history) => async dispatch => {
    try {
        const result = await axios.get(`/user/${id}/edit`, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('usertoken')}`
            }
        })
        // console.log(result.data)
        dispatch({
            type: 'User_EDIT',
            payload: result.data
        })

    } catch (err) {


        dispatch({
            type: 'GET_ERRORS',
            payload: err.response.data
        })
    }
}

export const update = (user, history) => async dispatch => {
    try {
        const res = await axios.put(`/user/${user}`, user, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('usertoken')}`
            }
        })
        console.log(res)
        history.push("/user")
        dispatch({
            type: GET_ERRORS,
            payload: {}
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
    } catch (err) {
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data
        })
    }
}

export const destroy = id => async dispatch => {
    // console.log("ID: "+id)
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
                const result = await axios.delete(`/user/${id}?token=${localStorage.getItem('usertoken')}`, id)
                console.log(result)
                dispatch({
                    type: 'User_DESTROY',
                    payload: id
                })

                Swal.fire({
                    position: 'top-end',
                    toast: true,
                    icon: 'success',
                    title: 'Success!',
                    text: 'Successfully deleted!',
                    // footer: '<a href>Why</a>',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        })


    } catch (err) {
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data
        })
    }
}


