import React,{ createContext, useContext,useState } from "react";


const ContextAuth = createContext()

function AuthContext({children}) {

    const initialUserData = {
        token: null,
        id : null,
        username:null,
        login:false,
        permisos:[]
    }

    const [userData,setUserData]= useState({
        token:null,

    })


    const values = {
        userData
    }
    return ( 
        <ContextAuth.Provider value={values}>
        {children}
        </ContextAuth.Provider> 
    );
}

export function useAuth(){
    const {userData} = useContext(ContextAuth)
    return {userData}
}



export default AuthContext;