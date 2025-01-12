import '../css/app.css';
import './bootstrap';

import React, {StrictMode} from "react"
import {createInertiaApp} from '@inertiajs/react';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {createRoot} from 'react-dom/client';
import {AppLayout} from "./layouts"
import {Providers} from "./providers"
import {SearchProvider} from "@/context/search-context";

const appName = import.meta.env.VITE_APP_NAME || 'Shadcn Laravel Admin';

createInertiaApp({
  title: (title) => `${title} - ${appName}`,
  resolve: (name) =>
    resolvePageComponent(
      `./pages/${name}.tsx`,
      import.meta.glob('./pages/**/*.tsx'),
    ),
  setup({el, App, props}) {
    const root = createRoot(el);

    root.render(
      <StrictMode>
        <Providers>
          <SearchProvider>
            <AppLayout>
              <App {...props} />
            </AppLayout>
          </SearchProvider>
        </Providers>
      </StrictMode>
    )
  },
  progress: {
    color: '#4B5563',
  },
});
