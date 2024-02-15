import { defineConfig } from 'vite';
import path from 'path';

export default defineConfig({
  // Définissez le répertoire de base si nécessaire, sinon il prend par défaut le répertoire où se trouve vite.config.js
  root: path.resolve(__dirname, 'assets/Framework/src/js'),
  build: {
    // Spécifiez le répertoire de sortie pour le build
    outDir: path.resolve(__dirname, 'assets/Framework/src/dist/js'),
    // Supprimez les anciens fichiers dans le répertoire de sortie à chaque build
    emptyOutDir: true,
    manifest: true,
    // Configuration spécifique de Rollup pour définir les noms des fichiers de sortie
    rollupOptions: {
      // Spécifiez le point d'entrée personnalisé
      input: path.resolve(__dirname, 'assets/Framework/src/js/main.js'),
      output: {
        // Configurez le chemin et le nom de fichier de sortie
        entryFileNames: 'main_vite.js',
        // Ajustez si vous avez besoin de configurer d'autres types de fichiers (chunks, assets)
        chunkFileNames: '[name].[hash].js',
        assetFileNames: '[name].[hash].[ext]',
        // Il peut être nécessaire d'ajuster ces chemins en fonction de votre structure exacte et de vos besoins
      }
    }
  },
  // Assurez-vous que Vite ne va pas essayer de servir ou de charger le fichier main_vite.js comme module ES lors du développement
  // Ajustez selon vos besoins pour d'autres configurations spécifiques à votre projet
});
