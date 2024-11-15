import React from 'react';

const Toast = ({ message, show, onClose }) => {
  return (
    <div
      className={`fixed max-w-xs w-full bg-blue-200 border border-blue-400 shadow-lg rounded-lg p-4 transition-transform transform ${
        show ? 'translate-y-0 opacity-100' : 'translate-y-4 opacity-0'
      }`}
    >
      <div className="flex justify-between items-center">
        <span className="text-gray-800">{message}</span>
        <button
          onClick={onClose}
          className="text-gray-500 hover:text-gray-700"
        >
          &times;
        </button>
      </div>
    </div>
  );
};

export default Toast;