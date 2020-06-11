import axios from "axios";
import {GET_ERRORS, SET_CURRENT_USER} from "../../utils/actions/actionsTypes";
import setTokenHeader from "../../utils/setTokenHeader";
import jwt_decode from "jwt-decode";

// export const register = (newUser, history) => async dispatch => {
//     try {
//         const res = await axios.post(`/api/register`, newUser )
//         console.log(res)
//         history.push("/")
//         dispatch({
//             type: GET_ERRORS,
//             payload: {}
//         })
//     }
//     catch (err) {
//         dispatch({
//             type: GET_ERRORS,
//             payload: err.response.data
//         })
//     }
// }

export const login = loginRequest => async dispatch => {
    try {
        console.log('LOGIN')
        const res = await axios.post(`/login`, loginRequest )
        console.log('LOGIN2')
        console.log(res)
        const { token } = res.data
        // console.log(token)
        localStorage.setItem('usertoken', token)

        localStorage.setItem('user', JSON.stringify(res.data.user))
        setTokenHeader(token)
        const decoded = jwt_decode(token)

        dispatch({
            type: SET_CURRENT_USER,
            payload: decoded
        })
    } 
    catch (err) {
        console.log(err)
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data
        })
    }

    // return axios
    //     .post(
    //         'api/login',
    //         {
    //             email: user.email,
    //             password: user.password
    //         },
    //         {
    //             headers: { 'Content-Type': 'application/json' }
    //         }
    //     )
    //     .then(response => {
    //         console.log(response)
    //         localStorage.setItem('usertoken', response.data.token)
    //         return response.data.token
    //     })
    //     .catch(err => {
    //         console.log(err)
    //     })
}

export const getProfile = () => {
    return axios
        .get('/profile', {
            headers: { Authorization: `Bearer ${localStorage.usertoken}` }
        })
        .then(response => {
            console.log(response)
            return response.data
        })
        .catch(err => {
            console.log(err)
        })
}

export const logout = () => dispatch  => {
    localStorage.removeItem('usertoken')
    setTokenHeader(false)
    dispatch({
        type: SET_CURRENT_USER,
        payload: {}
    })
}