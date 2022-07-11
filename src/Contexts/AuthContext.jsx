import React,{ createContext, useContext,useState,useCallback,useEffect} from "react";
import { APICALLER } from "../Services/api";


const ContextAuth = createContext()

function AuthContext({children}) {

    const storage = JSON.parse(sessionStorage.getItem("auth")) || JSON.parse(localStorage.getItem("auth"));

    const initialUserData = {
        token: null,
        id : null,
        email:null,
        auth:false,
        permissions:[],
        type_user:null
    }

    const [userData,setUserData]= useState(storage ? storage : initialUserData);

    const logIn = async (datas)=>{
        let res = await APICALLER.login(datas);

        if(res.response===false){
            console.log(res);
            return false;
        }
        if(res.response===true){
            let newdatesuser = {
                token: res.results.token,
                id: res.results.id,
                email: res.results.email,
                permissions: res.results.permissions,
                type_user:res.results.type_user,
                auth:true
            }
            setUserData(newdatesuser);
            sessionStorage.setItem("auth", JSON.stringify(newdatesuser))
            localStorage.setItem("auth", JSON.stringify(newdatesuser))
        }

    }

    const logOut = ()=>{
        setUserData(initialUserData);
        localStorage.removeItem("auth");
        sessionStorage.setItem("auth",JSON.stringify(initialUserData));

    }

    const validarToken = useCallback(async()=>{

        if (userData.auth) {
            let res = await APICALLER.validateToken(userData.token);
            if (res.response===false) {    
                logOut()
            }
        }

    },[userData,logOut])

    useEffect(() => {
        const ca = new AbortController(); let isActive = true;
        if (isActive) {
          validarToken();
        }
        return () => {
          isActive = false; ca.abort();
        };
      }, [validarToken]);


    const values = {
        userData,logIn
    }
    return ( 
        <ContextAuth.Provider value={values}>
        {children}
        </ContextAuth.Provider> 
    );
}

export function useAuth(){
    const {userData,logIn} = useContext(ContextAuth)
    return {userData,logIn}
}



export default AuthContext;