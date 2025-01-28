import React from 'react';
import { Link } from 'react-router-dom';
import TicketList from '../components/TicketsList.jsx';
import MiniStats from '../components/MiniStats.jsx';
import Button from '../components/Button.jsx';

const DashBoard = () => {
  return (
    <div>
      <header>
        <h1>DashBoard</h1>
        
      </header>
      <main>
        <MiniStats />
        <TicketList />
        <Button />
       <EmployeesList />
      </main>
    </div>
  );
};

export default DashBoard;