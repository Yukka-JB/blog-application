import React from 'react';
import ReactDOM from 'react-dom/client';
import '../css/app.css'; // Tailwind CSS


import 'flowbite';


import 'flowbite/dist/flowbite.css';


async function mountAuth() {
  const el = document.getElementById('react-auth');
  if (!el) return;


  const { default: AuthApp } = await import('./pages/auth/AuthApp');
  ReactDOM.createRoot(el).render(
    <React.StrictMode>
      <AuthApp />
    </React.StrictMode>
  );
}

mountAuth();