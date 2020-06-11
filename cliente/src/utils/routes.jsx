import React, { Suspense, lazy } from 'react';
import {BrowserRouter as Router, Route, Redirect, Switch} from 'react-router-dom'
import Login from "../resources/login/login.jsx";
import SecuredRoute from "./secureRoute";
import Dashboard from "../resources/dashboard";

import RequestCreate from "../resources/request/component/create";
import RequestShow from "../resources/request/component/show";

import Categories from "../resources/category/component/index";
import CategoriaCreate from "../resources/category/component/categoryCreate";
import CategoriaEdit from "../resources/category/component/categoryEdit";

import Product from "../resources/product/component/index";
import ProductCreate from "../resources/product/component/create";
import ProductEdit from "../resources/product/component/edit";

import User from "../resources/user/component/index";
import UserCreate from "../resources/user/component/create";
import UserEdit from "../resources/user/component/edit";

import WarehouseIndex from '../resources/warehouse/component/warehouseIndex';
import WarehouseEdit from '../resources/warehouse/component/warehouseEdit';
import WarehouseCreate from '../resources/warehouse/component/warehouseCreate';

import StockManagement from '../resources/stock/component/stockManagement';

export default props => (
    <Router>
        <Suspense fallback={<div>Loading...</div>}>
        <Switch>
            <Route exact path="/login" component={Login}/>
            <SecuredRoute exact path="/" component={Dashboard}/>

            <SecuredRoute exact path="/request/create" component={RequestCreate}/>
            <SecuredRoute exact path="/request/:idRequest" component={RequestShow}/>

            <SecuredRoute exact path="/category" component={Categories}/>
            <SecuredRoute exact path="/category/create" component={CategoriaCreate}/>
            <SecuredRoute exact path="/category/:id/edit" component={CategoriaEdit}/>

            <SecuredRoute exact path="/product" component={Product}/>
            <SecuredRoute exact path="/product/create" component={ProductCreate}/>
            <SecuredRoute exact path="/product/:id/edit" component={ProductEdit}/>

            <SecuredRoute exact path="/user" component={User}/>
            <SecuredRoute exact path="/user/create" component={UserCreate}/>
            <SecuredRoute exact path="/user/:id/edit" component={UserEdit}/>
            
            <SecuredRoute exact path="/warehouse" component={WarehouseIndex}/>
            <SecuredRoute exact path="/warehouse/:id/edit" component={WarehouseEdit}/>
            <SecuredRoute exact path="/warehouse/create" component={WarehouseCreate}/>
            <SecuredRoute exact path="/stock" component={StockManagement}/>

            <Redirect from='*' to='/'/>
        </Switch>
        </Suspense>
    </Router>
)