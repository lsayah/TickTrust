// filepath: /C:/Users/Amazi/Desktop/TickTrust/front_end/src/components/MiniStats.jsx
import React from 'react';
import { Doughnut } from 'react-chartjs-2';
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js';
import '../style/MiniStats.css';

ChartJS.register(ArcElement, Tooltip, Legend);

const MiniStats = ({ totalTickets, assignedTickets, activeTickets, closedTickets }) => {
  const data = {
    labels: ['Tickets Effectués', 'Tickets Restants'],
    datasets: [
      {
        data: [closedTickets, totalTickets - closedTickets],
        backgroundColor: ['#36A2EB', '#FF6384'],
        hoverBackgroundColor: ['#36A2EB', '#FF6384'],
      },
    ],
  };

  return (
    <div className="mini-stats">
      <div className="chart-container">
        <Doughnut data={data} />
      </div>
      <div className="stats-container">
        <div className="stat-card">
          <h3>Total Tickets</h3>
          <p>{totalTickets}</p>
        </div>
        <div className="stat-card">
          <h3>Tickets Assignés</h3>
          <p>{assignedTickets}</p>
        </div>
        <div className="stat-card">
          <h3>Tickets Actifs</h3>
          <p>{activeTickets}</p>
        </div>
        <div className="stat-card">
          <h3>Tickets Fermés</h3>
          <p>{closedTickets}</p>
        </div>
      </div>
    </div>
  );
};

export default MiniStats;