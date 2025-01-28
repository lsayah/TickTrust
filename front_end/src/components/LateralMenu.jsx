// filepath: /C:/Users/Amazi/Desktop/TickTrust/front_end/src/components/LateralMenu.jsx
import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faHome, faPlus, faList, faUser, faCog } from '@fortawesome/free-solid-svg-icons';
import '../style/LateralMenu.css';

const LateralMenu = () => {
  const [isOpen, setIsOpen] = useState(false);

  const handleMouseEnter = () => {
    setIsOpen(true);
  };

  const handleMouseLeave = () => {
    setIsOpen(false);
  };

  return (
    <aside
      className={`lateral-menu ${isOpen ? 'open' : 'closed'}`}
      onMouseEnter={handleMouseEnter}
      onMouseLeave={handleMouseLeave}
    >
      <nav>
        <ul>
          <li>
            <Link to="/">
              <FontAwesomeIcon icon={faHome} />
              {isOpen && <span>Accueil</span>}
            </Link>
          </li>
          <li>
            <Link to="/new-ticket">
              <FontAwesomeIcon icon={faPlus} />
              {isOpen && <span>Créer un Nouveau Ticket</span>}
            </Link>
          </li>
          <li>
            <Link to="/tickets">
              <FontAwesomeIcon icon={faList} />
              {isOpen && <span>Liste des Tickets</span>}
            </Link>
          </li>
          <li>
            <Link to="/profile">
              <FontAwesomeIcon icon={faUser} />
              {isOpen && <span>Profil</span>}
            </Link>
          </li>
          <li>
            <Link to="/settings">
              <FontAwesomeIcon icon={faCog} />
              {isOpen && <span>Paramètres</span>}
            </Link>
          </li>
        </ul>
      </nav>
    </aside>
  );
};

export default LateralMenu;