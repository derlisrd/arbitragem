import { Box, Button, Grid, Icon, InputAdornment, Stack, TextField, Typography } from '@mui/material';
import React, { useState } from 'react'

function LoginForm() {
    const initialForm = {
        email: "",
        password: ""
    }
    const enviar = ()=>{

    }

    const change = e=>{
        const {value,name} = e.target;
        setForm({...form,[name]:value});
    }

    const [form,setForm] = useState(initialForm)
    return (
        <form onSubmit={enviar} >
          <Box boxShadow={3} borderRadius={5} maxWidth={360}>
            <Grid container spacing={2}>
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
                <Button type="submit">
                    Ingresar
                </Button>
            </Grid>
            </Grid>
          </Box>
        </form>
    );
}

export default LoginForm;