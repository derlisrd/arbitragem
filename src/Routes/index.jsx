import React from 'react'
import {Routes,Navigate,Route} from "react-router-dom";
import { useAuth } from '../Contexts/AuthContext';
import Views from '../Views';
import Dashboard from '../Views/Dashboard';
import ErrorPage from '../Views/Errors';
import LoginForm from '../Views/LoginForm';
import Reports from '../Views/Reports';
import Users from '../Views/Users';


function RoutesMain() {

    const R = "/";

    const {userData} = useAuth();
    const {auth,permissions} = userData

    const PublicRoute = ({children})=> auth ? <Views>{children}</Views> : <Navigate to={"/"} />

    const PrivateRoute = ({children,id})=>{
        if(auth && !permissions.some(e => parseInt(e.permission_id) === parseInt(id)) ){
            return <Navigate to="/notautorized" />
        } 

        return auth ? <Views>{children}</Views> : <Navigate to={"/"} />
    }


    

    return (
        <Routes>
            <Route path={R+"ahora"} element={<PublicRoute><h2>PUBLIC ROUTE</h2></PublicRoute>} />
            <Route path={R+"dashboard"} element={<PrivateRoute id={1}><Dashboard /></PrivateRoute>} />
            <Route path={R+"reports"} element={<PrivateRoute id={2}><Reports /></PrivateRoute>} />
            <Route path={R+"users"} element={<PrivateRoute id={3}><Users /></PrivateRoute>} />
            <Route path={R} element={<LoginForm />} />
            <Route path="*" element={<ErrorPage />} />
        </Routes>

    );
}

export default RoutesMain;