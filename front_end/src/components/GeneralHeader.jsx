import React from 'react';

const Header = () => {
  const employee = {
    firstName: 'John',
    lastName: 'Doe',
    photoUrl: 'https://via.placeholder.com/50',
    notifications: 3,
  };

  return (
    <header className="header">
      <div className="employee-info">
        <img src={employee.photoUrl} alt={`${employee.firstName} ${employee.lastName}`} className="employee-photo" />
        <div className="employee-name">
          {employee.firstName} {employee.lastName}
        </div>
      </div>
      <div className="notifications">
        <span className="notification-count">{employee.notifications}</span>
        <i className="notification-icon">🔔</i>
      </div>
    </header>
  );
};

export default Header;