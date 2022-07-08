import { env } from "../Config/app";
import axios from 'axios';

export const api = {
    login: async(datas)=>{
        try {
            const res = await axios({
                url: `${APIURL}auth/login`,
                method: "POST",
                data: JSON.stringify(datas),
                headers: { "X-Api-Token": "" },
              });
              return await res.data;
        } catch (error) {
            return error;
        }
    }
}