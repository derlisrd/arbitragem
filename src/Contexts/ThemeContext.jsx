import React from 'react'
import { createContext } from 'react'
import CssBaseline from '@mui/material/CssBaseline';
import { createTheme, ThemeProvider } from '@mui/material/styles';

const Context = createContext()

const ThemeContext = ({children}) => {
    const theme = createTheme({  
        typography: {
            fontSize: 14,
            fontWeightMedium:"bold",
            fontWeightRegular:"500",
            fontFamily:"Montserrat",
            caption:{
              fontSize:12,
            },
            body1:{
              fontSize:14
            },
            h5:{
              fontWeight:"bold"
            }
            
          },
    });
    const values = {}
  return (
    <Context.Provider value={values}>
        <ThemeProvider theme={theme}>
          <CssBaseline />
      {children}
      </ThemeProvider>
    </Context.Provider>
  )
}

export default ThemeContext
