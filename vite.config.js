import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel([
            'resources/js/bot.js',
        ]),
    ],
    optimizeDeps: {
        include: ['rxjs/operators'] // Inclua outras dependências aqui, se necessário
    }
});
