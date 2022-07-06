
import React from "react";
import RoutesMain from "./Routes";
import AuthContext from './Contexts/AuthContext';
import { BrowserRouter } from "react-router-dom";

function App() {
  return (
    <AuthContext>
      <BrowserRouter>
        <RoutesMain />
      </BrowserRouter>
    </AuthContext>
  );
}

export default App;
