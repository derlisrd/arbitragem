import { env } from "../../App/Config/app";
const URL = env.BASE_PATH;
export const lista = [
    {
        id:1,
        text:"Dashboard",
        icon:"apps",
        url:`${URL}/dashboard`
    },
    {
        id:2,
        text:"Relatorios",
        icon:"reports",
        url:`${URL}/reports`
    },
    {
        id:3,
        text:"Users",
        icon:"people",
        url:`${URL}/users`
    }
];