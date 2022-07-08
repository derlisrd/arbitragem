import { Box, Button, Grid, Icon, InputAdornment, Stack, TextField, Typography } from '@mui/material';
import React, { useState,useCallback,useEffect } from 'react'
import {useAuth} from '../../Contexts/AuthContext';
import {useStyles} from '../../Styles/global'
import useGoto from '../../Hooks/useGoTo';

function LoginForm() {
    const navigate = useGoto();
    const style = useStyles();
    const {logIn,userData} = useAuth();
    const {auth} = userData
    const initialForm = {
        email: "",
        password: ""
    }
    const [form,setForm] = useState(initialForm)

    const change = e=>{
        const {value,name} = e.target;
        setForm({...form,[name]:value});
    }
    const enviar = async(e)=>{
      e.preventDefault()
      if(!logIn(form)){
        console.log("ErrorPage");
      }
    }
    
    const verificar = useCallback(()=>{
      if(auth) navigate.to('dashboard');
    },[auth,navigate])
  
  
    useEffect(() => {
      const ca = new AbortController(); let isActive = true;
      if (isActive) {
        verificar();
      }
      return () => {isActive = false;ca.abort();};
    }, [verificar]);

    
    return (
        <form onSubmit={enviar} className={[style.centercenter]} >
          <Box boxShadow={3} borderRadius={5} maxWidth={360} padding={2}>
            <Grid container spacing={3}>
            <Grid item xs={12}>
                <Stack justifyContent="center" alignItems="center" spacing={2}>
                  <Icon color="primary" fontSize="large">rocket_launch</Icon>
                  <Typography variant="h5">Ingresar</Typography>
                </Stack>
            </Grid>
            <Grid item xs={12}>

            </Grid>
              <Grid item xs={12}>
                <TextField fullWidth InputProps={{  startAdornment: (
                        <InputAdornment position="start">
                          <Icon color="disabled">perm_identity</Icon>
                        </InputAdornment>
                      ),}}  autoFocus required name="email" type="email" label="email" value={form.email} onChange={change}  />
              </Grid>
              <Grid item xs={12}>
                <TextField fullWidth InputProps={{  startAdornment: (
                        <InputAdornment position="start">
                          <Icon color="disabled">lock</Icon>
                        </InputAdornment>
                      ),}} required type="password" name="password" label="password" value={form.password} onChange={change}  />
              </Grid>

            <Grid item xs={12}>
                <Button variant="contained" size='large' fullWidth type="submit">
                    Ingresar
                </Button>
            </Grid>
            </Grid>
          </Box>
        </form>
    );
}

export default LoginForm;