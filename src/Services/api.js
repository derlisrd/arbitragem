import { env } from "../App/Config/app";
import axios from 'axios';

const URL = env.API_END_POINT;

export const APICALLER = {
    login: async(datas)=>{
        try {
            const res = await axios({
                url: `${URL}auth/login`,
                method: "POST",
                data: datas,
                /* headers: { "X-Api-Token": "" }, */
              });
              return await res.data;
        } catch (error) {
            return error.response.data;
        }
    },
    refreshToken: async(token)=>{
        try {
            const res = await axios({
                url: `${URL}auth/refreshtoken`,
                method: "POST",
                data: {token: token},
                /* headers: { "X-Api-Token": "" }, */
              });
              return await res.data;
        } catch (error) {
            return error.response.data;
        }
    },
    validateToken: async(token)=>{
        try {
            const res = await axios({
                url: `${URL}auth/validatetoken`,
                method: "POST",
                data: {token: token},
                /* headers: { "X-Api-Token": "" }, */
              });
              return await res.data;
        } catch (error) {
            return error.response.data;
        }
    },
    logout: async(token) => { 
        try {
            const res = await axios({
                url: `${URL}auth/logout`,
                method: "POST",
                data: {token: token},
                /* headers: { "X-Api-Token": "" }, */
              });
              return await res.data;
        } catch (error) {
            return error.response.data;
        }
    }
}