import axios from "axios";
import Swal from "sweetalert2";
import {GET_ERRORS} from "../../utils/actions/actionsTypes";
    // ?token=${localStorage.getItem('usertoken')}

export const select_category = (idCategory) => async dispatch => {
    try {
        dispatch({
            type: 'Request_SELECT_CATEGORY',
            payload: idCategory
        })
    } catch (err) {
        console.log(err)
    }
}

export const select_provenance = (provenance) => async dispatch => {
    try {
        dispatch({
            type: 'Request_SELECT_PROVENANCE',
            payload: provenance
        })
    } catch (err) {
        console.log(err)
    }
}

export const add_Product_Request = (product) => async dispatch => {
    try {
        dispatch({
            type: 'Request_Add_Product_Request',
            payload: product
        })
    } catch (err) {
        console.log(err)
    }
}

export const create = () => async dispatch => {
    try {
        const result = await axios.get(`/request/create`, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('usertoken')}`
            }
        })
        console.log('CREASTEEEEEEE')
        dispatch({
            type: 'Request_CREATE',
            payload: result.data
        })
    } catch (err) {
        console.log(err)
        dispatch({
            type: 'GET_ERRORS',
            payload: err
        })
    }
}

export const store = (request, history) => async dispatch => {
    console.log(request)
    try {
        const res = await axios.post(`/request`, request, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('usertoken')}`
            }
        })
        console.log(res.data)
        // history.push("/")
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

export const show = () => async dispatch => {
    try {
        const result = await axios.get(`/request/create`, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('usertoken')}`
            }
        })
        console.log('CREASTEEEEEEE')
        dispatch({
            type: 'Request_CREATE',
            payload: result.data
        })
    } catch (err) {
        console.log(err)
        dispatch({
            type: 'GET_ERRORS',
            payload: err
        })
    }
}

// export const getRequest = (id, history) => async dispatch => {
//     try {
//         const res = await axios.get(`/product/${id}/edit`, {
//             headers: {
//                 Authorization: `Bearer ${localStorage.getItem('usertoken')}`
//             }
//         })
//         // console.log(res)
//         dispatch({
//             type: 'GET',
//             payload: res.data
//         })
//     } catch (err) {
//         dispatch({
//             type: GET_ERRORS,
//             payload: err.response.data
//         })
//     }
// }

// export const index = () => async dispatch  => {
//     try {
//         const result = await axios.get(`/product`, {
//             headers: {
//                 Authorization: `Bearer ${localStorage.getItem('usertoken')}`
//             }
//         })
//         console.log(result.data)
//         dispatch({
//             type: 'Request_INDEX',
//             payload: result.data
//         })
//     } catch (err) {
//         dispatch({
//             type: 'GET_ERRORS',
//             payload: err.response
//         })
//     }
// }



//
// export const edit = (id, history) => async dispatch => {
//     try {
//         const result = await axios.get(`/product/${id}/edit`, {
//             headers: {
//                 Authorization: `Bearer ${localStorage.getItem('usertoken')}`
//             }
//         })
//         // console.log(result.data)
//         dispatch({
//             type: 'Request_EDIT',
//             payload: result.data
//         })
//
//     } catch (err) {
//
//
//         dispatch({
//             type: 'GET_ERRORS',
//             payload: err.response.data
//         })
//     }
// }
//
// export const update = (product, history) => async dispatch => {
//     try {
//         const res = await axios.put(`/product/${product}`, product, {
//             headers: {
//                 Authorization: `Bearer ${localStorage.getItem('usertoken')}`
//             }
//         })
//         console.log(res)
//         history.push("/product")
//         dispatch({
//             type: GET_ERRORS,
//             payload: {}
//         })
//
//         Swal.fire({
//             position: 'top-end',
//             toast: true,
//             icon: 'success',
//             title: 'Success!',
//             text: 'Successfully updated!',
//             // footer: '<a href>Why</a>',
//             showConfirmButton: false,
//             timer: 2000
//         })
//     } catch (err) {
//         dispatch({
//             type: GET_ERRORS,
//             payload: err.response.data
//         })
//     }
// }
//
// export const destroy = id => async dispatch => {
//     // console.log("ID: "+id)
//     try {
//         Swal.fire({
//             title: 'Are you sure?',
//             text: "You will delete this resource!",
//             icon: 'warning',
//             reverseButtons: true,
//             showCancelButton: true,
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             confirmButtonText: 'Yes',
//             cancelButtonText: 'No'
//         }).then(async (result) => {
//             if (result.value) {
//
//                 // const result = await axios.delete(`/product/${id}`, id, {
//                 //     headers: {
//                 //         Authorization: `Bearer ${localStorage.getItem('usertoken')}`
//                 //     }})
//                 // dispatch({
//                 //     type: 'DESTROY',
//                 //     payload: id
//                 // })
//
//                 const result = await axios.delete(`/product/${id}?token=${localStorage.getItem('usertoken')}`, id)
//                 console.log(result)
//                 dispatch({
//                     type: 'Request_DESTROY',
//                     payload: id
//                 })
//
//                 // Swal.fire(
//                 //     'Sucess!',
//                 //     'Successfully deleted.',
//                 //     'success'
//                 // )
//
//                 Swal.fire({
//                     position: 'top-end',
//                     toast: true,
//                     icon: 'success',
//                     title: 'Success!',
//                     text: 'Successfully deleted!',
//                     // footer: '<a href>Why</a>',
//                     showConfirmButton: false,
//                     timer: 2000
//                 })
//             }
//         })
//     } catch (err) {
//         dispatch({
//             type: GET_ERRORS,
//             payload: err.response.data
//         })
//     }
// }
//
//
