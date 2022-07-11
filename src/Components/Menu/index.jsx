import React from 'react';
import { List, ListItem,Icon, ListItemButton, ListItemIcon, ListItemText} from "@mui/material";
import {lista} from './lista';
function Menu({open}) {
    return ( <List>
        {lista.map((elem, index) => (
          <ListItem key={index} disablePadding sx={{ display: 'block' }}>
            <ListItemButton
              sx={{
                minHeight: 48,
                justifyContent: open ? 'initial' : 'center',
                px: 2.5,
              }}
            >
              <ListItemIcon
                sx={{
                  minWidth: 0,
                  mr: open ? 3 : 'auto',
                  justifyContent: 'center',
                }}
              >
               <Icon>{elem.icon}</Icon>
              </ListItemIcon>
              <ListItemText primary={elem.text} sx={{ opacity: open ? 1 : 0 }} />
            </ListItemButton>
          </ListItem>
        ))}
      </List> );
}

export default Menu;