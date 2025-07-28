import eslintPluginImport from 'eslint-plugin-import';
import eslintPluginPrettier from 'eslint-plugin-prettier';
import eslintPluginPromise from 'eslint-plugin-promise';
import globals from 'globals';

export default [
    {
        ignores: [
            'dist/**',
            'node_modules/**',
            'public/**',
        ],
    },
    {
        languageOptions: {
            ecmaVersion: 2025,
            sourceType: 'module',
            globals: {
                ...globals.browser,
                ...globals.node,
            },
        },

        plugins: {
            import: eslintPluginImport,
            promise: eslintPluginPromise,
            prettier: eslintPluginPrettier,
        },

        rules: {
            'no-console': 'warn',
            'no-unused-vars': ['warn', { 'argsIgnorePattern': '^_' }],

            'import/order': [
                'error',
                {
                    groups: ['builtin', 'external', 'internal', 'parent', 'sibling', 'index'],
                    'newlines-between': 'always',
                },
            ],

            'indent': ['error', 4, {
                'SwitchCase': 1,
                'ignoredNodes': ['TemplateLiteral'],
            }],

            'prettier/prettier': [
                'error',
                {
                    printWidth: 100,
                    tabWidth: 4,
                    useTabs: false,
                    semi: true,
                    singleQuote: true,
                    trailingComma: 'all',
                    bracketSpacing: true,
                    arrowParens: 'avoid',
                    endOfLine: 'auto',
                },
            ],
        },
    },
];
