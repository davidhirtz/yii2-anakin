import * as esbuild from 'esbuild'
import autoprefixer from "autoprefixer";
import postcss from "postcss";
import {sassPlugin} from 'esbuild-sass-plugin'

// Use --watch flag to watch for changes and rebuild automatically.
const isWatch = process.argv.slice(2).includes('--watch');
let cssStartTime;

const context = await esbuild.context({
    entryPoints: [
        'resources/assets/src/css/tinymce/*',
        'resources/assets/src/css/*',
    ],
    minify: true,
    outdir: 'resources/assets/dist/css',
    plugins: [
        watchPlugin('styles'),
        sassPlugin({
            async transform(source) {
                const {css} = await postcss([autoprefixer]).process(source, {from: undefined});
                return css;
            }
        })
    ],
    sourcemap: true,
});

if (isWatch) {
    await context.watch();
} else {
    await context.rebuild();
    await context.dispose();
}