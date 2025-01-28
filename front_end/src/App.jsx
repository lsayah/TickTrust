import React from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import DashBoard from "./pages/Dashboard";
import LateralMenu from "./components/LateralMenu";
import './style/App.css';


const App = () => {
  return (
    <Router>
    <div className="App">
      <LateralMenu />
      <div>
      
      </div>
      <div className="main-content">
        <Routes>
          <Route path="/" element={<DashBoard />} />

        </Routes>
      </div>
    </div>
  </Router>
  );
};

export default App;
