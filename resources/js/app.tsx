import React from 'react';
import ReactDOM from 'react-dom/client';
import '../css/app.css'; // Tailwind CSS

function App() {
  return (
    <div className="min-h-screen bg-background flex items-center justify-center">
      {/* Use the primary foreground so text contrasts the primary background */}
      <div className="bg-primary text-primary-foreground p-6 rounded">
        Tailwind Test
      </div>
    </div>
  );
}

const root = document.getElementById('app');
if (root) {
  ReactDOM.createRoot(root).render(
    <React.StrictMode>
      <App />
    </React.StrictMode>
  );
}