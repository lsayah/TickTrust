import React from 'react';
import '../style/TicketList.css';

const TicketList = () => {
  // Exemple de données de tickets, tu les récupérerais probablement depuis une API
  const tickets = [
    { id: 1, title: 'Problème de connexion', service: 'IT', assignee: 'Joseph Staline', status: 'En attente', importance: 'high' },
    { id: 2, title: 'Erreur de paiement', service: 'Finance', assignee: 'P Dydy', status: 'En cours', importance: 'medium' },
    { id: 3, title: 'Bogue de l\'interface', service: 'Développement', assignee: 'Adolf Thiers', status: 'Résolu', importance: 'low' },
    { id: 4, title: 'Problème de connexion', service: 'Développement', assignee: 'Jean-Claude Van damme', status: 'Résolu', importance: 'low' },
    { id: 5, title: 'Bogue de l\'interface', service: 'Développement', assignee: 'Nikita Bellucci', status: 'Résolu', importance: 'medium' },
  ];

  const handleDetailsClick = (ticketId) => {
    // Logique pour afficher les détails du ticket
    console.log('Afficher les détails pour le ticket:', ticketId);
  };

  return (
    <div>
      <h2>Liste des Tickets</h2>
      <table className="ticket-list">
        <thead>
          <tr>
            <th></th>
            <th>Request Number</th>
            <th>Titre</th>
            <th>Service</th>
            <th>Assignée</th>
            <th>Statut</th>
            <th>Détails</th>
          </tr>
        </thead>
        <tbody>
          {tickets.map(ticket => (
            <tr key={ticket.id}>
              <td className={`importance ${ticket.importance}`}></td>
              <td>{ticket.id}</td>
              <td>{ticket.title}</td>
              <td>{ticket.service}</td>
              <td>{ticket.assignee}</td>
              <td>{ticket.status}</td>
              <td>
                <span className="details-link" onClick={() => handleDetailsClick(ticket.id)}>Voir Détails</span>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default TicketList;