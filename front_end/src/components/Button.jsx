import React from 'react';
import '../style/Button.css';

const Button = () => {
  return (
    <div>
      <button className="AddTicketBtn">Add ticket</button>
      <button className="SendTicketBtn">Send Ticket</button>
      <button className="AddFileBtn">Add File</button>
    </div>
  );
};

export default Button;