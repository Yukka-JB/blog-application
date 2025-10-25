import React from 'react';
import ReactDOM from 'react-dom/client';
import '../css/app.css'; // Tailwind CSS

// Ensure Flowbite JS runtime is available (enables interactive Flowbite components)
import 'flowbite';

// Import Flowbite CSS so Flowbite component classes are styled.
// This ensures Flowbite styles are bundled by Vite.
import 'flowbite/dist/flowbite.css';

// Lazy mount the AuthApp if the root element exists
async function mountAuth() {
  const el = document.getElementById('react-auth');
  if (!el) return;

  // dynamic import so other pages don't load the component
  const { default: AuthApp } = await import('./pages/auth/AuthApp');
  ReactDOM.createRoot(el).render(
    <React.StrictMode>
      <AuthApp />
    </React.StrictMode>
  );
}

mountAuth();