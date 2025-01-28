import React from 'react';
import '../style/EmployeesList.css';

const EmployeesList = () => {
  const employees = ['Jacque CHIRAC', 'Jul LOVNI', 'René', 'Bob Brown'];

  return (
    <div className="employees-list-container">
      <h2>Employees</h2>
      <select className="employees-dropdown">
        {employees.map((employee, index) => (
          <option key={index} value={employee}>
            {employee}
          </option>
        ))}
      </select>
    </div>
  );
};

export default EmployeesList;