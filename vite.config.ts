import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
// Note: we intentionally do not import @vitejs/plugin-react here to avoid
// the React fast-refresh preamble mismatch that prevents modules from running.
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  server: {
    host: '127.0.0.1',
    port: 5173,
    origin: 'http://127.0.0.1:5173',
    cors: {
      origin: 'http://127.0.0.1:8000',
      credentials: true,
    },
    hmr: {
      host: '127.0.0.1',
    },
  },
  plugins: [
    laravel({
      input: ['resources/js/app.tsx', 'resources/css/app.css'],
      refresh: true,
    }),
    tailwindcss(),
  ],

  esbuild: {
    jsx: 'automatic',
  },
});