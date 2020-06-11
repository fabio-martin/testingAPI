import React, {Component} from 'react'
import {connect} from 'react-redux'
import {bindActionCreators} from "redux";
import {index} from "./dashboardActions";
import {Link} from "react-router-dom";

class Index extends Component {

    //sempre que o componente esta a ser renderizado
    componentWillMount()
    {
        this.props.index()
    }


    render() {

        const userLink = (<b>======== LOGIN OK ========= </b>)
        const loginRegLink = (<b><a href="/login">LOGIN</a></b>)


        console.log(this.props.data.requests)

        return (
            <div>

                <div className="content-header">
                    <div className="container-fluid">
                        <div className="row mb-2">
                            <div className="col-sm-6">
                                <h1 className="m-0 text-dark">Request's</h1>
                            </div>
                            <div className="col-sm-6">
                                <ol className="breadcrumb float-sm-right">
                                    <li className="breadcrumb-item"><a href="#">Home</a></li>
                                    <li className="breadcrumb-item active">Resume</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <section className="content">
                    <div className="container-fluid">
                        <div className="row">

                            {this.props.data.requests.map(request => (
                                <div className="col-lg-2 col-6" key={'request'+request.id}>
                                    <div className={'small-box bg-'+request.states[0].state.color}>
                                        <div className="inner">
                                            <h3><i className={'fas '+request.states[0].state.icon}></i></h3>
                                            <p>{request.provenance.location}</p>
                                        </div>
                                        <div className="icon">
                                            <i className="fas fa-window-restore"></i>
                                        </div>
                                        <Link to={'/request/'+request.id} className="small-box-footer">{request.states[0].state.option} <i
                                            className="fas fa-arrow-circle-right"></i></Link>
                                    </div>
                                </div>
                            ))}



                        </div>
                    </div>
                    <div className="text-center">
                        {/*{localStorage.usertoken ? userLink : loginRegLink}*/}
                    </div>
                </section>
            </div>
        )
    }
}

const mapStateToProps = state => ({  // retorna um objecto
    //retirar da store e colocar nas props deste componente
    //LIGAÇÃO AO REDUCER
    data: state.dashboardReducer
})

const mapDispatchToProps = dispatch => bindActionCreators({index}, dispatch)

export default connect(mapStateToProps, mapDispatchToProps) (Index)