import axios from "axios";

export const index = () => async dispatch => {
    try {
        const res = await axios.get(`/dashboard`, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('usertoken')}`
            }
        })
        // console.log(res)
        dispatch({
            type: 'DASHBOARD_INDEX',
            payload: res.data
        })
    } catch (err) {
        dispatch({
            type: 'GET_ERRORS',
            payload: err.response.data
        })
        // history.push('/category')
    }
}