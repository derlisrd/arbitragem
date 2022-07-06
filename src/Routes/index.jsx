import React from 'react'
import {Routes,Navigate,Route} from "react-router-dom";
import { useAuth } from '../Contexts/AuthContext';
import Views from '../Views';
import Dashboard from '../Views/Dashboard';
import ErrorPage from '../Views/Errors';
import LoginForm from '../Views/LoginForm';


function RoutesMain() {

    const R = "/";
    const {userData} = useAuth();
    const {login,permisos} = userData

    const PublicRoute = ({children})=> login ? <Views>{children}</Views> : <Navigate to={"/"} />

    const PrivateRoute = ({children,id})=>{
        if(login && !permisos.some(e => parseInt(e.id_permiso_permiso) === parseInt(id)) ){
            return <Navigate to="/notautorized" />
        } 

        return login ? <Views>{children}</Views> : <Navigate to={"/"} />
    }

    return (

        <Routes>
            <Route path={R+"/dashboard"} element={<PrivateRoute id={1}><Dashboard /></PrivateRoute>} />
            <Route path={R} element={<LoginForm />} />
            <Route path="*" element={<ErrorPage />} />
        </Routes>

    );
}

export default RoutesMain;