import axios from "axios";
import {DELETE_CATEGORIA, GET_CATEGORIA, GET_CATEGORIAS, GET_ERRORS} from "../../utils/actions/actionsTypes";
import Swal from "sweetalert2";


export const createCategory = (categoria, history) => async dispatch => {
    try {
        const res = await axios.post(`/category`, categoria, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('usertoken')}`
            }
        })
        console.log(res)
        history.push("/category")
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
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data
        })
    }
}

export const getCategory = (id, history) => async dispatch => {
    try {
        const res = await axios.get(`/category/${id}/edit`, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('usertoken')}`
            }
        })
        dispatch({
            type: GET_CATEGORIA,
            payload: res.data
        })
    } catch (err) {
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data
        })
        // history.push('/category')
    }
}

export const updateCategory = (category, history) => async dispatch => {
    console.log(category)
    try {
        const res = await axios.put(`/category/${category}`, category, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('usertoken')}`
            }
        })
        console.log(res)
        history.push("/category")
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

export const deleteCategory = id => async dispatch => {
    // console.log("ID: "+id)
    try {
        // if(window.confirm("Tem a certeza?")) {}

        // const deleteFile = async () => {
        //     // Wait for the user to press a button...
        //     const shouldDelete = await Swal("Delete file?", "Are you sure that you want to delete this file?", "warning");
        //
        //     if (shouldDelete) {
        //         // Code to actually delete file goes here
        //         const res = await axios.delete(`/category/${id}`, id)
        //         Swal("Poof!", "Your file has been deleted!", "success");
        //     }
        // }



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

                const res = await axios.delete(`/category/${id}?token=${localStorage.getItem('usertoken')}`, id)
                console.log(res)
                dispatch({
                    type: DELETE_CATEGORIA,
                    payload: id
                })

                // Swal.fire(
                //     'Sucess!',
                //     'Successfully deleted.',
                //     'success'
                // )

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

export const getCategories = () => async dispatch => {
    try {
        const res = await axios.get(`/category`,
            {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('usertoken')}`
                }
            })
        dispatch({
            type: GET_CATEGORIAS,
            payload: res.data
        })
    } catch (err) {
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data
        })
    }
}

