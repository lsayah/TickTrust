import React from 'react';
import { Link } from 'react-router-dom';
import TicketList from '../components/TicketsList.jsx';

const HomePage = () => {
  return (
    <div>
      <header>
        <h1>Plateforme de Gestion de Tickets</h1>
        <nav>
          <ul>
            <li>
              <Link to="/">Accueil</Link>
            </li>
            <li>
              <Link to="/new-ticket">Créer un Nouveau Ticket</Link>
            </li>
          </ul>
        </nav>
      </header>
      <main>
        <TicketList />
      </main>
    </div>
  );
};

export default HomePage;