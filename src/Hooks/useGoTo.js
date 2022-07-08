import { useNavigate } from "react-router-dom";
import {env} from "../App/Config/app";

export default function useGoto(state=null){
    const navigate = useNavigate()
    const to = u => navigate(env.BASE_PATH+"/"+u,{state:state});
    return {to};
}